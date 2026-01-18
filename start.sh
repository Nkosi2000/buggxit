#!/usr/bin/env bash
set -e

echo "=== Starting Buggxit Production Deployment ==="

# Debug: Show database connection info (without password)
echo "Database connection:"
echo "  Host: $DB_HOST"
echo "  Port: $DB_PORT"
echo "  Database: $DB_DATABASE"
echo "  Username: $DB_USERNAME"
echo "  SSL Mode: $DB_SSLMODE"

# Check if APP_KEY is set
if [ -z "$APP_KEY" ] || [ "$APP_KEY" == "base64:" ]; then
    echo "Generating new application key..."
    php artisan key:generate --force
fi

echo "Installing PHP dependencies..."
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

echo "Setting proper permissions..."
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache

# Wait for database and run migrations with retry
echo "Checking database connection..."
max_attempts=10
attempt=1

# Get actual database connection info before retry loop
echo "Checking actual database configuration..."
ACTUAL_DB_DRIVER=$(php artisan tinker --execute='try { echo config("database.default"); } catch (Exception $e) { echo "Not available yet"; }')
echo "Configured database driver: $ACTUAL_DB_DRIVER"

while [ $attempt -le $max_attempts ]; do
    echo "Attempt $attempt of $max_attempts to connect to database..."
    
    # Better check: try a simple query instead of migrate:status
    if php artisan tinker --execute='try { DB::connection()->getPdo(); echo "OK"; } catch (Exception $e) { exit(1); }' > /dev/null 2>&1; then
        echo "✅ Database connection successful and verified!"
        echo "Running database migrations..."
        
        # Check if there are pending migrations
        PENDING_MIGRATIONS=$(php artisan migrate:status | grep -c "No\|Pending" || true)
        if [ "$PENDING_MIGRATIONS" -eq 0 ]; then
            echo "No pending migrations found."
        else
            php artisan migrate --force
            echo "✅ Database migrations completed successfully."
        fi
        break
    else
        echo "❌ Database connection failed. Retrying in 5 seconds..."
        sleep 5
    fi
    attempt=$((attempt+1))
done

if [ $attempt -gt $max_attempts ]; then
    echo "❌ ERROR: Failed to connect to database after $max_attempts attempts"
    echo "Check your database credentials and network connectivity."
    echo "Continuing without database migrations..."
fi

echo "Clearing and caching configuration..."
php artisan config:clear && echo "✅ Config cleared"
php artisan config:cache && echo "✅ Config cached"
php artisan route:clear && echo "✅ Routes cleared"
php artisan route:cache && echo "✅ Routes cached"
php artisan view:clear && echo "✅ Views cleared"
php artisan view:cache && echo "✅ Views cached"
php artisan cache:clear && echo "✅ Application cache cleared"

# If using Vite, build assets
if [ -f "package.json" ]; then
    echo "Building frontend assets..."
    
    # Check Node.js version
    NODE_VERSION=$(node --version)
    NPM_VERSION=$(npm --version)
    echo "Node.js version: $NODE_VERSION"
    echo "npm version: $NPM_VERSION"
    
    # Check if Node.js meets Vite requirements (20.19+ or 22.12+)
    NODE_VERSION_NUM=$(node --version | tr -d 'v')
    NODE_MAJOR=$(echo $NODE_VERSION_NUM | cut -d'.' -f1)
    NODE_MINOR=$(echo $NODE_VERSION_NUM | cut -d'.' -f2)
    
    VITE_WARNING=false
    if [ "$NODE_MAJOR" -lt 20 ]; then
        VITE_WARNING=true
    elif [ "$NODE_MAJOR" -eq 20 ] && [ "$NODE_MINOR" -lt 19 ]; then
        VITE_WARNING=true
    elif [ "$NODE_MAJOR" -eq 22 ] && [ "$NODE_MINOR" -lt 12 ]; then
        VITE_WARNING=true
    fi
    
    if [ "$VITE_WARNING" = true ]; then
        echo "⚠️  WARNING: Node.js $NODE_VERSION_NUM detected. Vite requires Node.js 20.19+ or 22.12+."
        echo "The build may fail or produce unexpected results."
    else
        echo "✅ Node.js version meets Vite requirements."
    fi
    
    # Clean npm cache
    if npm cache clean --force > /dev/null 2>&1; then
        echo "✅ npm cache cleaned"
    fi
    
    # Install dependencies
    if npm ci --silent --no-audit --prefer-offline; then
        echo "✅ Dependencies installed"
    else
        echo "❌ Failed to install dependencies"
        exit 1
    fi
    
    # Build for production
    if npm run build --silent; then
        echo "✅ Frontend assets built successfully"
    else
        echo "❌ Frontend build failed"
        exit 1
    fi
    
    # Clean up
    npm cache clean --force > /dev/null 2>&1
    rm -rf ~/.npm /tmp/*
fi

echo "✅ Deployment complete! Starting Nginx/PHP-FPM..."

# Use Render's PORT or default to 80
LISTEN_PORT=${PORT:-80}
echo "Starting web server on port ${LISTEN_PORT}..."

# Update Nginx to listen on the correct port
if [ -f "/etc/nginx/sites-enabled/default" ]; then
    sed -i "s/listen 80;/listen ${LISTEN_PORT};/g" /etc/nginx/sites-enabled/default
    echo "✅ Nginx configured to listen on port ${LISTEN_PORT}"
else
    echo "⚠️  Default Nginx config not found at /etc/nginx/sites-enabled/default"
fi

# Check PHP-FPM configuration
echo "Checking PHP-FPM configuration..."
PHP_FPM_CONF=$(find /etc -name "www.conf" -type f 2>/dev/null | head -1)
if [ -n "$PHP_FPM_CONF" ]; then
    PHP_FPM_SOCKET=$(grep -h "^listen\s*=" "$PHP_FPM_CONF" | head -1 | sed 's/^listen\s*=\s*//')
    echo "PHP-FPM socket path: $PHP_FPM_SOCKET"
else
    echo "⚠️  PHP-FPM config not found, using defaults"
    PHP_FPM_SOCKET="/var/run/php-fpm.sock"
fi

# Start PHP-FPM
echo "Starting PHP-FPM..."
if php-fpm --daemonize; then
    sleep 2  # Give PHP-FPM time to start
    
    # Verify PHP-FPM is actually running
    if pgrep php-fpm > /dev/null; then
        echo "✅ PHP-FPM process is running"
        
        # Check if socket file exists
        if [ -S "$PHP_FPM_SOCKET" ]; then
            echo "✅ PHP-FPM socket created at $PHP_FPM_SOCKET"
        else
            echo "⚠️  PHP-FPM socket not found at $PHP_FPM_SOCKET"
            echo "Checking for alternative socket locations..."
            find /var/run -name "*.sock" 2>/dev/null || echo "No sockets found"
        fi
    else
        echo "❌ PHP-FPM failed to start - process not found"
        exit 1
    fi
else
    echo "❌ Failed to start PHP-FPM"
    exit 1
fi

# Verify Nginx configuration
echo "Verifying Nginx configuration..."
if nginx -t; then
    echo "✅ Nginx configuration test passed"
else
    echo "❌ Nginx configuration test failed"
    exit 1
fi

# Start Nginx in foreground
echo "Starting Nginx on port ${LISTEN_PORT}..."
echo "Nginx will run in foreground. Container is now serving requests."
nginx -g 'daemon off;'
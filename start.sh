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

# ----------------------------------------------------------------------
# CRITICAL FIX: Find the correct PHP-FPM socket for richarvey/nginx-php-fpm
# ----------------------------------------------------------------------

echo "Searching for PHP-FPM configuration in richarvey/nginx-php-fpm image..."

# This image uses a non-standard setup. Let's find what's available:
echo "Available PHP configurations:"
find /etc -name "*php*" -type f 2>/dev/null | grep -E "(fpm|php)" | head -10

# Try to find actual PHP-FPM socket or config
PHP_SOCKET=""
PHP_CONFIG=""

# Common locations in this image
POSSIBLE_PATHS=(
    "/var/run/php/php8.2-fpm.sock"
    "/var/run/php8-fpm.sock" 
    "/var/run/php-fpm.sock"
    "/tmp/php-fpm.sock"
    "/var/run/php7-fpm.sock"
)

for sock_path in "${POSSIBLE_PATHS[@]}"; do
    if [ -S "$sock_path" ]; then
        PHP_SOCKET="$sock_path"
        echo "✅ Found existing PHP socket at: $PHP_SOCKET"
        break
    fi
done

# If no socket exists, we need to start PHP-FPM with correct config
if [ -z "$PHP_SOCKET" ]; then
    echo "No existing socket found, will create one..."
    
    # Create directory for socket if it doesn't exist
    mkdir -p /var/run/php
    PHP_SOCKET="/var/run/php/php-fpm.sock"
    
    # Create a minimal PHP-FPM config if none exists
    if [ ! -f "/etc/php8/php-fpm.d/www.conf" ]; then
        echo "Creating PHP-FPM configuration..."
        cat > /etc/php8/php-fpm.d/www.conf << 'EOF'
[www]
user = www-data
group = www-data
listen = /var/run/php/php-fpm.sock
listen.owner = www-data
listen.group = www-data
pm = dynamic
pm.max_children = 5
pm.start_servers = 2
pm.min_spare_servers = 1
pm.max_spare_servers = 3
EOF
        echo "✅ Created PHP-FPM config at /etc/php8/php-fpm.d/www.conf"
    fi
fi

echo "Using PHP socket: $PHP_SOCKET"

# ----------------------------------------------------------------------
# Update Nginx configuration to use the correct socket
# ----------------------------------------------------------------------

echo "Updating Nginx configuration..."

# First, find Nginx config files
NGINX_CONF_DIR="/etc/nginx"
if [ -d "$NGINX_CONF_DIR" ]; then
    # Update main nginx.conf if it exists
    if [ -f "$NGINX_CONF_DIR/nginx.conf" ]; then
        echo "Found nginx.conf, checking for PHP configuration..."
        
        # Check if fastcgi_pass needs updating
        if grep -q "fastcgi_pass" "$NGINX_CONF_DIR/nginx.conf"; then
            sed -i "s|fastcgi_pass unix:[^;]*;|fastcgi_pass unix:$PHP_SOCKET;|g" "$NGINX_CONF_DIR/nginx.conf"
            echo "✅ Updated fastcgi_pass in nginx.conf"
        fi
    fi
    
    # Check sites-enabled directory
    if [ -d "$NGINX_CONF_DIR/sites-enabled" ]; then
        for site_conf in "$NGINX_CONF_DIR/sites-enabled"/*; do
            if [ -f "$site_conf" ]; then
                echo "Updating site config: $(basename $site_conf)"
                # Update port
                sed -i "s/listen 80;/listen ${LISTEN_PORT};/g" "$site_conf"
                # Update PHP socket
                sed -i "s|fastcgi_pass unix:[^;]*;|fastcgi_pass unix:$PHP_SOCKET;|g" "$site_conf"
            fi
        done
    else
        echo "⚠️  sites-enabled directory not found"
        # Check conf.d directory as alternative
        if [ -d "$NGINX_CONF_DIR/conf.d" ]; then
            for conf in "$NGINX_CONF_DIR/conf.d"/*; do
                if [ -f "$conf" ]; then
                    echo "Updating conf.d config: $(basename $conf)"
                    sed -i "s|fastcgi_pass unix:[^;]*;|fastcgi_pass unix:$PHP_SOCKET;|g" "$conf"
                fi
            done
        fi
    fi
fi

# ----------------------------------------------------------------------
# Start PHP-FPM with explicit socket configuration
# ----------------------------------------------------------------------

echo "Starting PHP-FPM..."
# Force PHP-FPM to use our socket
php-fpm --daemonize --fpm-config /etc/php8/php-fpm.conf

# Wait for PHP-FPM to start
sleep 3

# Verify PHP-FPM is running
if pgrep php-fpm > /dev/null; then
    echo "✅ PHP-FPM process is running (PID: $(pgrep php-fpm))"
    
    # Check if socket was created
    if [ -S "$PHP_SOCKET" ]; then
        echo "✅ PHP-FPM socket created successfully at $PHP_SOCKET"
        echo "Socket permissions:"
        ls -la "$PHP_SOCKET"
    else
        echo "⚠️  Socket not created. Checking alternatives..."
        # List all sockets
        find /var/run -name "*.sock" -type s 2>/dev/null
    fi
else
    echo "❌ PHP-FPM failed to start"
    # Try alternative start method
    echo "Trying alternative PHP-FPM start..."
    /usr/sbin/php-fpm8 --daemonize
    sleep 2
fi

# ----------------------------------------------------------------------
# Test Nginx configuration
# ----------------------------------------------------------------------

echo "Testing Nginx configuration..."
if nginx -t; then
    echo "✅ Nginx configuration test passed"
else
    echo "❌ Nginx configuration test failed"
    echo "Last 10 lines of error:"
    nginx -t 2>&1 | tail -10
    exit 1
fi

# ----------------------------------------------------------------------
# Start Nginx
# ----------------------------------------------------------------------

echo "Starting Nginx on port ${LISTEN_PORT}..."
echo "========================================"
echo "Application URL: http://localhost:${LISTEN_PORT}"
echo "External URL: https://buggxit.onrender.com"
echo "========================================"
echo "Nginx running in foreground. Container is live!"
nginx -g 'daemon off;'
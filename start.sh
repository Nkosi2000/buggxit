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

while [ $attempt -le $max_attempts ]; do
    echo "Attempt $attempt of $max_attempts to connect to database..."
    if php artisan migrate:status > /dev/null 2>&1; then
        echo "✅ Database connection successful!"
        echo "Running database migrations..."
        php artisan migrate --force
        break
    else
        echo "❌ Database connection failed. Retrying in 5 seconds..."
        sleep 5
    fi
    attempt=$((attempt+1))
done

if [ $attempt -gt $max_attempts ]; then
    echo "❌ ERROR: Failed to connect to database after $max_attempts attempts"
    echo "Continuing without database migrations..."
fi

echo "Clearing and caching configuration..."
php artisan config:clear
php artisan config:cache
php artisan route:clear
php artisan route:cache
php artisan view:clear
php artisan view:cache
php artisan cache:clear


# If using Vite, build assets
if [ -f "package.json" ]; then
    echo "Building frontend assets..."
    
    # Check Node.js version
    echo "Node.js version: $(node --version)"
    echo "npm version: $(npm --version)"
    
    # Check if Node.js meets Vite requirements (20.19+ or 22.12+)
    NODE_VERSION=$(node --version | tr -d 'v')
    NODE_MAJOR=$(echo $NODE_VERSION | cut -d'.' -f1)
    NODE_MINOR=$(echo $NODE_VERSION | cut -d'.' -f2)
    
    VITE_WARNING=false
    if [ "$NODE_MAJOR" -lt 20 ]; then
        VITE_WARNING=true
    elif [ "$NODE_MAJOR" -eq 20 ] && [ "$NODE_MINOR" -lt 19 ]; then
        VITE_WARNING=true
    elif [ "$NODE_MAJOR" -eq 22 ] && [ "$NODE_MINOR" -lt 12 ]; then
        VITE_WARNING=true
    fi
    
    if [ "$VITE_WARNING" = true ]; then
        echo "⚠️  WARNING: Node.js $NODE_VERSION detected. Vite requires Node.js 20.19+ or 22.12+."
        echo "The build may fail or produce unexpected results."
        echo "Consider updating your Dockerfile to install Node.js 20 or later."
    fi
    
    # Clean npm cache to avoid permission issues
    npm cache clean --force
    
    # Install dependencies (ci is better for production than install)
    npm ci --silent --no-audit --prefer-offline
    
    # Build for production (continue even with version warning)
    npm run build --silent
    
    # Clean up npm cache to reduce image size
    npm cache clean --force
    rm -rf ~/.npm /tmp/*
fi

echo "✅ Deployment complete! Starting Nginx/PHP-FPM..."

# The richarvey/nginx-php-fpm image uses supervisord, not my_init
# Check what init system is available and use the correct one

if [ -f "/usr/bin/supervisord" ]; then
    echo "Starting supervisord..."
    exec /usr/bin/supervisord -c /etc/supervisord.conf
elif [ -f "/start-web" ]; then
    # Some versions have a start-web script
    echo "Starting via start-web..."
    exec /start-web
elif [ -f "/start.sh" ] && [ "$(readlink -f /start.sh)" != "$(readlink -f /var/www/html/start.sh)" ]; then
    # If there's a different start.sh in root, use it
    echo "Starting via root start.sh..."
    exec /start.sh
else
    # Fallback: directly start nginx and php-fpm
    echo "Starting nginx and php-fpm directly..."
    nginx -g 'daemon off;' &
    exec php-fpm
fi
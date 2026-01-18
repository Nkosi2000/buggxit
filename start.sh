#!/usr/bin/env bash
set -e  # Exit on any error

echo "=== Starting Buggxit Production Deployment ==="

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

echo "Running database migrations..."
php artisan migrate --force

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
    npm ci --silent
    npm run build --silent
fi

echo "Deployment complete! Starting Nginx/PHP-FPM..."
exec /sbin/my_init

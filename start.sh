#!/usr/bin/env bash
set -e

echo "=== Running Laravel Deploy Script ==="

# Generate application key if not set
if [ -z "$APP_KEY" ] || [ "$APP_KEY" == "base64:" ]; then
    echo "Generating application key..."
    php artisan key:generate --force
fi

# Run database migrations
echo "Running migrations..."
php artisan migrate --force

# Clear and cache configuration for production
echo "Caching configuration..."
php artisan config:clear
php artisan config:cache
php artisan route:clear
php artisan route:cache
php artisan view:clear
php artisan view:cache

# Cache events and packages
php artisan event:cache
php artisan package:discover

# Set proper permissions
chmod -R 775 storage bootstrap/cache
chown -R nginx:nginx storage bootstrap/cache

echo "Deploy script finished."
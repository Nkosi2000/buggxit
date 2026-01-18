#!/usr/bin/env bash
set -e

echo "=== Running Laravel Deploy Script ==="

# Install Composer dependencies
echo "Running composer..."
composer install --no-dev --working-dir=/var/www/html

# Generate application key if not set
if [ -z "$APP_KEY" ] || [ "$APP_KEY" == "base64:" ]; then
    echo "Generating application key..."
    php artisan key:generate --force
fi

# Cache configuration for production
echo "Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Running migrations..."
php artisan migrate --force

echo "Deploy script finished."
#!/usr/bin/env bash

echo "Installing PHP dependencies..."
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

echo "Generating application key..."
php artisan key:generate --force

echo "Running database migrations..."
php artisan migrate --force

echo "Caching configuration..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Caching views..."
php artisan view:cache

echo "Deployment complete!"
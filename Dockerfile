# ============================================
# STAGE 1: Build assets with Node.js 20
# ============================================
FROM node:20-alpine AS node-build

WORKDIR /var/www/html

# Copy entire project for build context
COPY . .

# Install all dependencies and build
RUN npm ci && npm run build

# ============================================
# STAGE 2: PHP application with built assets
# ============================================
FROM php:8.3-fpm-alpine

# Install system dependencies and PHP extensions
RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    git \
    postgresql-dev \
    libpng-dev \
    libzip-dev \
    oniguruma-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd zip

WORKDIR /var/www/html

# Copy the application code
COPY . .

# Copy built assets from node-build stage
COPY --from=node-build /var/www/html/public/build ./public/build/

# Copy configuration files
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Composer dependencies
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Set proper permissions for Laravel
RUN mkdir -p storage/framework/{cache,sessions,views} bootstrap/cache \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
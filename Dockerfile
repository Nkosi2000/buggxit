# ============================================
# STAGE 1: Build assets with Node.js 20 (includes devDependencies)
# ============================================
FROM node:20-alpine AS node-build

WORKDIR /var/www/html

# Copy only package files first for optimal layer caching
COPY package*.json vite.config.js ./

# INSTALL ALL DEPENDENCIES, INCLUDING DEV, FOR THE BUILD
RUN npm ci

# Build the production assets (this command uses the installed 'vite')
RUN npm run build

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

# 1. Copy the application code
COPY . .

# 2. COPY THE BUILT ASSETS FROM THE node-build STAGE
# This is the critical step that brings in the compiled CSS/JS
COPY --from=node-build /var/www/html/public/build ./public/build/

# Copy configuration files
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Composer dependencies (no dev for production)
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Set proper permissions for Laravel
RUN mkdir -p storage/framework/{cache,sessions,views} bootstrap/cache \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
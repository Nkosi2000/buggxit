# ============================================
# STAGE 1: Build assets with Node.js 20
# ============================================
FROM node:20-alpine AS node-build

WORKDIR /var/www/html

# 1. Copy ONLY package files first (better caching)
COPY package*.json vite.config.js ./

# 2. Install dependencies (this creates node_modules)
RUN npm ci

# 3. Copy the rest of the application code
COPY . .

# 4. Verify the CSS file exists
RUN ls -la resources/css/ && cat resources/css/app.css

# 5. Now run the build
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

# Create necessary directories and fix permissions early
RUN mkdir -p /var/log/nginx /var/log/php \
    && chown -R www-data:www-data /var/log/nginx /var/log/php \
    && mkdir -p /var/tmp/nginx \
    && chown -R www-data:www-data /var/tmp/nginx

WORKDIR /var/www/html

# Copy the application code
COPY . .

# Copy built assets from node-build stage
COPY --from=node-build /var/www/html/public/build ./public/build/

# Copy configuration files
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/www.conf /usr/local/etc/php-fpm.d/www.conf

# Test Nginx configuration
RUN nginx -t || (echo "Nginx configuration test failed" && cat /etc/nginx/nginx.conf && exit 1)

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Composer dependencies
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Set proper permissions for Laravel
RUN mkdir -p storage/framework/{cache,sessions,views} bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
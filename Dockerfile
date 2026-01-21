# Use a PHP image with a specific, newer version of Node.js installed
FROM php:8.3-fpm-alpine

# Install system dependencies, PHP extensions, and Node.js 20
RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    git \
    postgresql-dev \
    libpng-dev \
    libzip-dev \
    oniguruma-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd zip \
    && apk add --no-cache nodejs npm --repository=http://dl-cdn.alpinelinux.org/alpine/v3.21/community

# Set working directory
WORKDIR /var/www/html

# Copy application code
COPY . .

# Copy configuration files
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Install Composer dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Install Node.js dependencies and build assets
RUN npm ci --only=production && npm run build

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port and start supervisor
EXPOSE 80
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
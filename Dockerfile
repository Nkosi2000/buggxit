FROM richarvey/nginx-php-fpm:3.1.6

# Set environment variables for the image
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV RUN_SCRIPTS 1

# Install Node.js, npm, and required PHP extensions
RUN apk add --no-cache \
    nodejs \
    npm \
    postgresql-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Copy application code
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Install dependencies and build
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader && \
    npm ci --only=production && \
    npm run build && \
    php artisan storage:link && \
    chown -R nginx:nginx /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Clean up
RUN rm -rf /var/www/html/node_modules && \
    rm -rf /root/.npm && \
    rm -rf /root/.composer

# Copy custom nginx configuration
COPY docker/nginx.conf /etc/nginx/sites-available/default.conf

# The image's default CMD will run /start.sh and then start Nginx/PHP-FPM
FROM richarvey/nginx-php-fpm:3.1.2

# Install Node.js and npm for Alpine Linux (both required)
RUN apk add --no-cache --update nodejs npm

# Set environment variables for production
ENV APP_ENV=production \
    APP_DEBUG=false

# Copy your application code into the container
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Install Composer dependencies (do this before copying start script for better layer caching)
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Copy and make start script executable
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Run deployment script on container start
CMD ["/start.sh"]
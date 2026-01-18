FROM richarvey/nginx-php-fpm:3.1.6

# Copy application code
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Set environment variables for the image
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public

# Install Node.js and npm for Vite build
RUN apk add --no-cache nodejs npm

# Install Composer dependencies and build frontend assets
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader && \
    npm ci && \
    npm run build

# Create a minimal .env file with non-secret defaults if it doesn't exist
# (Render's environment variables will override these at runtime)
RUN if [ ! -f .env ]; then \
        echo "APP_ENV=local" > .env; \
        echo "APP_DEBUG=true" >> .env; \
        echo "LOG_CHANNEL=stderr" >> .env; \
    fi

# Copy and set up the deploy script
COPY start.sh /start.sh
RUN chmod +x /start.sh

# The image's default CMD will run /start.sh and then start Nginx/PHP-FPM
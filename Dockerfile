FROM richarvey/nginx-php-fpm:3.1.2

# Install dependencies, download the official Node.js 20 LTS binaries, and clean up
RUN apk add --no-cache --update curl && \
    curl -fsSL https://unofficial-builds.nodejs.org/download/release/v20.19.0/node-v20.19.0-linux-x64-musl.tar.gz | tar -xz -C /usr/local --strip-components=1 && \
    ln -s /usr/local/bin/node /usr/bin/node && \
    ln -s /usr/local/bin/npm /usr/bin/npm && \
    ln -s /usr/local/bin/npx /usr/bin/npx && \
    apk del curl && \
    rm -rf /var/cache/apk/*

# Set environment variables for production
ENV APP_ENV=production \
    APP_DEBUG=false

# Expose port 80 (REQUIRED for Render.com)
EXPOSE 80

# Copy your application code into the container
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Install Composer dependencies
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
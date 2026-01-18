FROM richarvey/nginx-php-fpm:3.1.2

# Install Node.js and npm
RUN apk add --no-cache nodejs npm

# Set environment variables for production
ENV APP_ENV=production
ENV APP_DEBUG=false

# Copy your application code into the container
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Copy and make start script executable
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Run deployment script on container start
CMD ["/start.sh"]
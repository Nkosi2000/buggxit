FROM richarvey/nginx-php-fpm:3.1.2

# Copy your application code into the container
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Set environment variables for production
ENV APP_ENV=production
ENV APP_DEBUG=false

# Run deployment script on container start
CMD ["/start.sh"]
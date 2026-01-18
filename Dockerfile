FROM richarvey/nginx-php-fpm:3.1.2

# Install a compatible version of Node.js (v20 LTS is recommended)
# Use the 'nodejs-20' package for Alpine Linux
RUN apk add --no-cache --update nodejs 

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
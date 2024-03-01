# Use the official PHP image as base
FROM php:7.4-apache

# Copy the PHP script into the container
COPY index.php /var/www/html/

# Expose port 80 to allow external access
EXPOSE 80

FROM php:8.2-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set timezone
RUN echo "date.timezone=America/Guayaquil" > /usr/local/etc/php/conf.d/timezone.ini

EXPOSE 80

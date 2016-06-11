FROM php:7-apache
# Enable Apache Modules
RUN ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load
# Install additional packages
RUN apt-get update && apt-get install -y \
  git \
  zip \
  unzip
# Install composer globally
RUN php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/local/bin --filename=composer

# Copy only the files needed for production
COPY config/php.ini /usr/local/etc/php/
COPY config/apache2.conf /etc/apache2/
COPY ./public /var/www/app/public
COPY ./resources /var/www/app/resources
COPY ./src /var/www/app/src
COPY ./composer.json /var/www/app/composer.json
COPY ./composer.lock /var/www/app/composer.lock

WORKDIR /var/www/app

# Install composer dependencies
RUN composer install -o --no-dev --no-interaction

# Expose our server port.
EXPOSE 80
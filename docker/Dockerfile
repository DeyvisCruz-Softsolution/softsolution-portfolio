FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libzip-dev \
    libicu-dev \
    && docker-php-ext-install \
    intl \
    zip \
    pdo_mysql \
    opcache

COPY . /var/www/html
RUN composer install --optimize-autoloader --ignore-platform-req=ext-intl --ignore-platform-req=ext-zip

RUN chown -R www-data:www-data /var/www/html/storage

EXPOSE 80

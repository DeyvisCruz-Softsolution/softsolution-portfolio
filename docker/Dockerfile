# Usa PHP 8.2 con Apache (versión compatible con Laravel 11+)
FROM php:8.2-apache

# Instala extensiones PHP requeridas
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libicu-dev \
    && docker-php-ext-install \
    intl \
    zip \
    pdo_mysql \
    opcache

# Configura Apache para Laravel
RUN a2enmod rewrite
COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf

# Copia el proyecto
COPY . /var/www/html

# Permisos para storage
RUN chown -R www-data:www-data /var/www/html/storage

EXPOSE 80

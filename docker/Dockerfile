# Usa PHP 8.2 con Apache (versión compatible con Laravel 11+)
FROM php:8.2-apache

# Upgrade system packages to mitigate vulnerabilities
RUN apt-get update && apt-get upgrade -y && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instala extensiones PHP requeridas y actualiza paquetes para mitigar vulnerabilidades
RUN apt-get update && apt-get install -y --no-install-recommends \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    && docker-php-ext-install \
    intl \
    zip \
    pdo_mysql \
    opcache \
    && apt-get upgrade -y \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Configura Apache para Laravel
RUN a2enmod rewrite
COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf

# Copia el proyecto
COPY . /var/www/html

# Permisos para storage
RUN chown -R www-data:www-data /var/www/html/storage

EXPOSE 80

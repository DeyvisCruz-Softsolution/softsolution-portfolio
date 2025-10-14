# Imagen base PHP con Apache
FROM php:8.2-apache

# Instalar dependencias del sistema y extensiones PHP necesarias
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev libicu-dev default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql zip mbstring intl bcmath exif pcntl

# Instalar Composer desde imagen oficial
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Permisos antes de Composer
RUN mkdir -p storage bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Instalar dependencias PHP con Composer
RUN if [ -f "composer.json" ]; then \
      COMPOSER_MEMORY_LIMIT=-1 composer install --no-dev --prefer-dist --no-scripts --no-interaction; \
      composer dump-autoload -o; \
    fi

# Configuración Apache
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

EXPOSE 80
CMD ["apache2-foreground"]

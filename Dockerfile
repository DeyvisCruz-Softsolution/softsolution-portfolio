# Imagen base PHP con Apache
FROM php:8.2-apache

# Instalar dependencias del sistema y extensiones PHP necesarias
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev libicu-dev default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql zip mbstring

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto
COPY . .

# Establecer permisos correctos
RUN chown -R www-data:www-data storage bootstrap/cache

# Instalar dependencias de Laravel
RUN php -d memory_limit=-1 /usr/bin/composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction

# Copiar configuración personalizada de Apache
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Habilitar mod_rewrite para Laravel
RUN a2enmod rewrite

# Exponer puerto 80 para Apache
EXPOSE 80

# Iniciar Apache
CMD ["apache2-foreground"]

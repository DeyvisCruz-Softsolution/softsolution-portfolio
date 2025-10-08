# Imagen base PHP con Apache
FROM php:8.2-apache

# Instalar dependencias del sistema y extensiones PHP necesarias
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev libicu-dev default-mysql-client libpq-dev \
    && docker-php-ext-install \
        pdo pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd zip intl

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto
COPY . .

# Establecer permisos correctos antes de composer
RUN chown -R www-data:www-data storage bootstrap/cache

# Instalar dependencias de Laravel
RUN composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction

# Generar APP_KEY si no existe
RUN php artisan key:generate --force

# Exponer puerto para Apache
EXPOSE 80

# Iniciar Apache (migraciones se harán en pre-deploy)
CMD ["apache2-foreground"]

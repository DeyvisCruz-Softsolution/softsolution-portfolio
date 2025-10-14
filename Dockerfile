# Etapa 1: obtener Composer
FROM composer:2 AS composer_stage

# Etapa 2: imagen base PHP con Apache
FROM php:8.2-apache

# Instalar dependencias del sistema y extensiones PHP necesarias
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev libicu-dev default-mysql-client \
    nodejs npm \
    && docker-php-ext-install pdo pdo_mysql zip mbstring intl bcmath exif pcntl

# Copiar composer desde la primera etapa
COPY --from=composer_stage /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto
COPY . .

# Establecer permisos correctos
RUN mkdir -p storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Instalar dependencias de Laravel
RUN if [ -f "composer.json" ]; then \
      composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction; \
    fi

# Instalar dependencias frontend y compilar assets con Vite
RUN if [ -f "package.json" ]; then \
      npm install && npm run build; \
    fi

# Configuración de Apache
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

EXPOSE 80
CMD ["apache2-foreground"]

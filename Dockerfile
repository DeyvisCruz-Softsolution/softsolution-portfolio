# Etapa 1: obtener Composer
FROM composer:2 AS composer_stage

# Etapa 2: imagen base PHP con Apache
FROM php:8.2-apache

# Instalar dependencias del sistema y extensiones PHP necesarias
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev libicu-dev default-mysql-client \
    nodejs npm \
    && docker-php-ext-install pdo pdo_mysql zip mbstring intl bcmath exif pcntl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copiar composer desde la primera etapa
COPY --from=composer_stage /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto
COPY . .

# Crear y dar permisos a carpetas necesarias
RUN mkdir -p storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Instalar dependencias de Laravel (sin dependencias de desarrollo)
RUN if [ -f "composer.json" ]; then \
      composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction; \
    fi

# Instalar dependencias frontend y compilar assets con Vite
RUN if [ -f "package.json" ]; then \
      npm install && npm run build; \
    fi

# 🔥 Copiar los assets generados al lugar correcto dentro del contenedor
RUN mkdir -p /var/www/html/public/build \
    && cp -r public/build/* /var/www/html/public/build/ \
    && ls -la /var/www/html/public/build

# Copiar configuración de Apache
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

EXPOSE 80
CMD ["apache2-foreground"]

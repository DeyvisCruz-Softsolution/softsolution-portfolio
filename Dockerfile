# ==============================
# Etapa 1: Composer
# ==============================
FROM composer:2 AS composer_stage

# ==============================
# Etapa 2: PHP + Apache
# ==============================
FROM php:8.2-apache

# Dependencias y extensiones
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev libicu-dev default-mysql-client \
    nodejs npm \
    && docker-php-ext-install pdo pdo_mysql zip mbstring intl bcmath exif pcntl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer_stage /usr/bin/composer /usr/bin/composer

# Directorio de trabajo
WORKDIR /var/www/html

# Copiar proyecto
COPY . .

# Storage y bootstrap cache
RUN mkdir -p storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Composer install
RUN composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction

# Build frontend con Vite
RUN npm install && npm run build

# Mostrar contenido de build
RUN ls -la public/build && cat public/build/manifest.json

# Configuración Apache
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Puerto
EXPOSE 80

# Comando
CMD ["apache2-foreground"]

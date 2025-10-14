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
RUN composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction

# Instalar dependencias frontend y compilar assets con Vite
RUN npm install && npm run build

# ✅ Copiar build generado al lugar correcto (asegura manifest.json dentro de la imagen final)
RUN if [ -f "./public/build/manifest.json" ]; then \
      echo "✅ manifest.json encontrado, build copiado correctamente"; \
    else \
      echo "❌ ERROR: manifest.json no existe"; \
      exit 1; \
    fi

# Configuración de Apache
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Limpiar caches y asegurar permisos
RUN php artisan config:clear \
 && php artisan cache:clear \
 && php artisan route:clear \
 && php artisan view:clear \
 && chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R 775 storage bootstrap/cache

EXPOSE 80
CMD ["apache2-foreground"]

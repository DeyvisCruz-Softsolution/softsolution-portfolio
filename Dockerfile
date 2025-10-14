# =========================
# 🧱 Etapa 1: Composer
# =========================
FROM composer:2 AS composer_stage

# =========================
# 🧱 Etapa 2: PHP + Apache + Node
# =========================
FROM php:8.2-apache

# Instalar dependencias del sistema y extensiones PHP
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

# Copiar todos los archivos del proyecto
COPY . .

# Crear y dar permisos a carpetas necesarias
RUN mkdir -p storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# =========================
# 🎯 Instalar dependencias de Laravel
# =========================
RUN if [ -f "composer.json" ]; then \
      composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction; \
    fi

# =========================
# ⚡ Instalar dependencias Frontend y compilar Vite
# =========================
RUN if [ -f "package.json" ]; then \
      npm install && npm run build; \
    fi

# ✅ Corregido: mover el build al lugar correcto solo si existe
RUN if [ -d "./public/build" ]; then \
      echo "✅ Build generado correctamente en ./public/build"; \
    else \
      echo "❌ ERROR: No se encontró public/build después del build"; \
      exit 1; \
    fi

# =========================
# ⚙️ Configuración de Apache
# =========================
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

EXPOSE 80
CMD ["apache2-foreground"]

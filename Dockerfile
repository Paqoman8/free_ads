# ---------------------------------------------------------
# 1. Base image : PHP 8.2-FPM avec toutes les extensions nécessaires
# ---------------------------------------------------------
FROM php:8.4-fpm-bullseye

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    nginx \
    libonig-dev \
    libcurl4-openssl-dev \
    libpng-dev \
    libpq-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring gd xml

# ---------------------------------------------------------
# 2. Installer Composer
# ---------------------------------------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ---------------------------------------------------------
# 3. Préparer les dossiers Laravel
# ---------------------------------------------------------
WORKDIR /var/www/html

# Copier tout le code du projet
COPY . .

# Fix permissions for Laravel storage and cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Donner les bonnes permissions (important pour Render)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# RUN fallocate -l 2G /swapfile && \
#     chmod 600 /swapfile && \
#     mkswap /swapfile && \
#     swapon /swapfile

# ---------------------------------------------------------
# 4. Installer les dépendances PHP
# ---------------------------------------------------------
RUN composer install --no-dev --optimize-autoloader

RUN php artisan storage:link || true

# ---------------------------------------------------------
# 5. Build configuration Laravel
# ---------------------------------------------------------
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache || true

# ---------------------------------------------------------
# 6. Copier la configuration Nginx
# ---------------------------------------------------------
COPY ./docker/nginx.conf /etc/nginx/sites-available/default

# ---------------------------------------------------------
# 7. Script de démarrage (FPM + Nginx)
# ---------------------------------------------------------
COPY ./docker/start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 80

CMD ["/start.sh"]
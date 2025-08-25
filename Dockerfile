FROM php:8.2-fpm

# System dependencies
RUN apt-get update && apt-get install -y git unzip libpng-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# Composer install
RUN composer install --no-dev --optimize-autoloader

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose the port Render expects
ENV PORT=5000
EXPOSE 5000

# Start Laravel's built-in HTTP server
CMD php artisan serve --host=0.0.0.0 --port=$PORT

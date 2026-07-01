FROM node:20-alpine AS assets
WORKDIR /app
COPY package*.json /app/
RUN npm ci
COPY resources /app/resources
COPY vite.config.js /app/
COPY public /app/public
RUN npm run build

FROM php:8.2-fpm

RUN apt-get update && apt-get install -y git curl libpng-dev libonig-dev libxml2-dev zip unzip

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . /var/www

RUN composer install --no-interaction --optimize-autoloader --no-dev

COPY --from=assets /app/public/build /var/www/public/build

RUN php artisan storage:link || true
RUN php artisan optimize

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]

FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing application directory
COPY . /var/www

# Install dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Membuat folder uploads dan mengatur izin akses
RUN mkdir -p /var/www/public/uploads && \
    chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/public/uploads && \
    chmod -R 775 /var/www/storage /var/www/bootstrap/cache /var/www/public/uploads

# Salin konfigurasi nginx
COPY nginx.conf /etc/nginx/nginx.conf

EXPOSE 80

CMD ["sh", "-c", "php-fpm -D && php artisan migrate --force && php artisan config:cache && php artisan route:cache && php artisan view:cache && nginx -g 'daemon off;'"]
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    sqlite3 \
    libsqlite3-dev

# Install Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql pdo_sqlite mysqli mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev --ignore-platform-reqs || \
    composer create-project laravel/laravel tmp && cp -r tmp/* . && rm -rf tmp && \
    composer install --optimize-autoloader --no-dev --ignore-platform-reqs

# Install Node dependencies and build assets
RUN npm install && npm run build

# Create .env if it doesn't exist
RUN cp .env.example .env 2>/dev/null || echo "APP_NAME=Laravel" > .env

# Generate application key
RUN php artisan key:generate 2>/dev/null || echo "Key generation skipped"

# Set permissions
RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www/storage 2>/dev/null || mkdir -p /var/www/storage && chmod -R 755 /var/www/storage
RUN chmod -R 755 /var/www/bootstrap/cache 2>/dev/null || mkdir -p /var/www/bootstrap/cache && chmod -R 755 /var/www/bootstrap/cache

# Configure Apache for Laravel
RUN a2enmod rewrite
COPY apache-laravel.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80
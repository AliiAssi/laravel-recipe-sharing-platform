#!/bin/bash

# Start PHP-FPM in background
php-fpm -D

# Run Laravel migrations
php artisan migrate --force

# Optional: Seed database
php artisan db:seed --force

# Start Nginx
nginx -g "daemon off;"
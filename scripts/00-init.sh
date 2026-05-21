#!/usr/bin/env bash
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force
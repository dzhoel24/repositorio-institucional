#!/usr/bin/env bash

cd /var/www/html

echo "=== INICIANDO START.SH ==="

chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force

echo "=== INICIANDO SUPERVISORD ==="

/usr/bin/supervisord -n -c /etc/supervisord.conf
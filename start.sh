#!/usr/bin/env bash

echo "=== INICIANDO START.SH ==="

cd /var/www/html

# Permisos
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Limpiar y cachear
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force

echo "=== INICIANDO SERVIDOR PHP ==="

# Iniciar servidor PHP (fallback si nginx no funciona)
php artisan serve --host=0.0.0.0 --port=10000
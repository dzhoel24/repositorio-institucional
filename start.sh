#!/usr/bin/env bash

echo "=== INICIANDO START.SH ==="

cd /var/www/html

# Permisos
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# ✅ Limpiar TODO el caché
php artisan optimize:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# ✅ Migrar
php artisan migrate --force

echo "=== RUTAS REGISTRADAS ==="
php artisan route:list

echo "=== INICIANDO SERVIDOR PHP ==="
php artisan serve --host=0.0.0.0 --port=10000
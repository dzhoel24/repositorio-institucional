#!/usr/bin/env bash

echo "=== INICIANDO START.SH ==="

cd /var/www/html

# Permisos
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# ✅ Verificar que el archivo de rutas existe
ls -la routes/web.php

# ✅ Mostrar rutas registradas
php artisan route:list

# Limpiar y cachear
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force

echo "=== INICIANDO SERVIDOR PHP ==="

php artisan serve --host=0.0.0.0 --port=10000
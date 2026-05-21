#!/usr/bin/env bash

echo "=== INICIANDO START.SH ==="

cd /var/www/html

# Permisos
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# ✅ Habilitar depuración temporalmente
export APP_DEBUG=true

# Limpiar caché
php artisan optimize:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Migrar
php artisan migrate --force

echo "=== INICIANDO SERVIDOR PHP CON DEBUG ==="
php artisan serve --host=0.0.0.0 --port=10000
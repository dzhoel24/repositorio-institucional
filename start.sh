#!/usr/bin/env bash

echo "=== INICIANDO DESPLIEGUE ==="

# Instalar Composer si no existe
if ! command -v composer &> /dev/null; then
    echo "Instalando Composer..."
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
fi

echo "Instalando dependencias..."
composer install --no-dev --optimize-autoloader

echo "Cacheando configuraciones..."
php artisan config:cache

echo "Cacheando rutas..."
php artisan route:cache

echo "Ejecutando migraciones..."
php artisan migrate --force

echo "=== DESPLIEGUE COMPLETADO ==="

# Iniciar supervisord (que maneja PHP-FPM y Nginx)
/usr/bin/supervisord -n -c /etc/supervisord.conf
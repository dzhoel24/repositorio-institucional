#!/usr/bin/env bash

echo "=== INSTALANDO COMPOSER ==="
curl -sS https://getcomposer.org/installer | php
php composer.phar install --no-dev --optimize-autoloader

echo "=== CACHEANDO LARAVEL ==="
php artisan config:cache
php artisan route:cache

echo "=== MIGRACIONES ==="
php artisan migrate --force

echo "=== INICIANDO SERVIDOR ==="
/usr/bin/supervisord -n -c /etc/supervisord.conf
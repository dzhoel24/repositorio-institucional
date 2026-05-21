#!/usr/bin/env bash

echo "Ejecutando Composer..."
composer install --no-dev --optimize-autoloader

echo "Cacheando configuraciones..."
php artisan config:cache

echo "Cacheando rutas..."
php artisan route:cache

echo "Ejecutando migraciones..."
php artisan migrate --force

echo "Despliegue completado"
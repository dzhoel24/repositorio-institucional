#!/usr/bin/env bash

echo "=== INICIANDO DESPLIEGUE ==="
echo "Directorio actual: $(pwd)"

# Instalar Composer si no existe
if ! command -v composer &> /dev/null; then
    echo "Instalando Composer..."
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
fi

echo "Instalando dependencias de Composer..."
composer install --no-dev --optimize-autoloader --working-dir=/var/www/html

# Verificar que vendor/autoload.php se creó
if [ -f /var/www/html/vendor/autoload.php ]; then
    echo "✅ vendor/autoload.php creado correctamente"
else
    echo "❌ ERROR: vendor/autoload.php no se creó"
    exit 1
fi

echo "Cacheando configuraciones..."
php artisan config:cache

echo "Cacheando rutas..."
php artisan route:cache

echo "Ejecutando migraciones..."
php artisan migrate --force

echo "=== DESPLIEGUE COMPLETADO ==="

# Iniciar supervisord
/usr/bin/supervisord -n -c /etc/supervisord.conf
FROM richarvey/nginx-php-fpm:latest

COPY . .

ENV SKIP_COMPOSER 0
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

ENV COMPOSER_ALLOW_SUPERUSER 1

# Instalar Node.js
RUN apk add --update nodejs npm

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar dependencias
RUN cd /var/www/html && composer install --no-dev --optimize-autoloader

# ✅ Crear .env desde variables de entorno
RUN echo "APP_ENV=production" >> /var/www/html/.env
RUN echo "APP_DEBUG=false" >> /var/www/html/.env
RUN echo "LOG_CHANNEL=stderr" >> /var/www/html/.env
RUN echo "DB_CONNECTION=pgsql" >> /var/www/html/.env
RUN echo "DATABASE_URL=${DATABASE_URL}" >> /var/www/html/.env

# ✅ Generar APP_KEY
RUN cd /var/www/html && php artisan key:generate --force

# ✅ Cachear todo
RUN cd /var/www/html && php artisan config:cache
RUN cd /var/www/html && php artisan route:cache
RUN cd /var/www/html && php artisan view:cache

# Compilar assets
RUN cd /var/www/html && npm install && npm run build

# Permisos
RUN chmod -R 777 /var/www/html/storage
RUN chmod -R 777 /var/www/html/bootstrap/cache

EXPOSE 80

CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisord.conf"]
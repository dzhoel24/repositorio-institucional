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

# Compilar assets
RUN cd /var/www/html && npm install && npm run build

# ✅ Hacer ejecutable el start.sh
RUN chmod +x /var/www/html/start.sh

EXPOSE 80

CMD ["/var/www/html/start.sh"]
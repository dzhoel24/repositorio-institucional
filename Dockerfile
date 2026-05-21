FROM richarvey/nginx-php-fpm:latest

COPY . /var/www/html/

WORKDIR /var/www/html

RUN apk add --no-cache nodejs npm

RUN npm install && npm run build
RUN composer install --no-dev --optimize-autoloader

# Permisos de storage
RUN chown -R nginx:nginx /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

ENV SKIP_COMPOSER=1
ENV WEBROOT=/var/www/html/public
ENV PHP_ERRORS_STDERR=1
ENV RUN_SCRIPTS=1
ENV REAL_IP_HEADER=1
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN chmod +x /var/www/html/scripts/00-init.sh
FROM php:7.2-fpm
RUN docker-php-ext-install pdo pdo_mysql
WORKDIR /var/www
ADD . /var/www
RUN chown -R www-data:www-data /var/www
RUN chmod -R 775 /var/www

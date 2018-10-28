FROM php:7.2-fpm
RUN docker-php-ext-install pdo pdo_mysql
Un
RUN apt-get update -y && apt-get install -y openssl zip unzip git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo mbstring
COPY . /var/wwww
WORKDIR /var/wwww
RUN chown -R www-data:www-data /var/www
RUN chmod -R 775 /var/www

RUN composer install

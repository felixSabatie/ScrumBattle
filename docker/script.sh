#!/bin/sh
#generate the key
php artisan key:generate
#generate the key
php artisan migrate
# generate the authentification key
php artisan db:seed
php artisan passport:install
# run server
php artisan serve --host 0.0.0.0

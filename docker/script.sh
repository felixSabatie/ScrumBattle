#!/bin/sh
echo "ma bite"
php artisan key:generate
echo "ma bite est"
php artisan migrate
echo "ma bite est magique"
exec "$@"

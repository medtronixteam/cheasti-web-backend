#!/bin/bash
sleep 20

#echo "composer install"
composer install

echo "Running migrations ..."
php artisan migrate

echo "key generate"
php artisan key:generate

echo "migration ..."
php artisan db:seed

#echo "storage"
php artisan storage:link


echo "Starting server ..."
php artisan serve --host=0.0.0.0


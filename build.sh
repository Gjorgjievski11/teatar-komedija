#!/usr/bin/env bash

docker compose build
docker compose run --rm php-fpm composer install
docker compose run --rm php-fpm php artisan key:generate
docker compose run --rm php-fpm php artisan storage:link

docker compose up -d
docker compose run --rm php-fpm php artisan migrate
docker compose exec php-fpm php artisan config:clear
docker compose exec php-fpm php artisan cache:clear

docker run -v $(pwd):/app -w /app node npm install
docker run --rm -i -v $(pwd):/app -w /app node npm run build
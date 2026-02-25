#!/usr/bin/env bash
# exit on error
set -o errexit

composer install --no-dev --no-interaction --prefer-dist
npm install
npm run build

php artisan config:cache
php artisan route:cache
php artisan view:cache

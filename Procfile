web: php artisan serve --host=0.0.0.0 --port=$PORT
worker: php artisan queue:work
scheduler: while [ true ]; do php artisan schedule:run; sleep 60; done

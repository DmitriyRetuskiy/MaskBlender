#!/bin/sh

initialStuff() {
    php artisan key:generate; \
    php artisan config:clear; \
   php artisan clear-compiled; \
   php artisan optimize; \
   php artisan config:cache
}

cd /var/www/html

initialStuff

/usr/bin/supervisord -c /etc/supervisord.conf

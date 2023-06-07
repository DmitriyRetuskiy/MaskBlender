FROM php:8.1-fpm

RUN apt-get update && apt-get install -y nginx \
    curl \
    supervisor \
    libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
    && docker-php-ext-enable imagick

WORKDIR /var/www/html

COPY . .

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN cp deploy/docker/supervisor.conf /etc/supervisord.conf && \
    cp deploy/docker/nginx.conf /etc/nginx/sites-enabled/default && \
    chown -R www-data:www-data storage && \
    composer install

EXPOSE 80

RUN sed -i 's/\r$//' /var/www/html/deploy/docker/run.sh && \
   chmod +x /var/www/html/deploy/docker/run.sh

CMD ["/bin/sh", "-c", "/var/www/html/deploy/docker/run.sh"]

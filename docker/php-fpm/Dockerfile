FROM php:7.2-fpm

MAINTAINER Konstatinos Tsirkou <ktsirkou@gmail.com>

RUN apt-get update && \
    apt-get install -y libpng-dev libjpeg-dev libpq-dev zip unzip sudo wget sqlite3 libsqlite3-dev && \
    rm -rf /var/lib/apt/lists/*

RUN pecl install apcu

RUN docker-php-ext-install pdo pdo_mysql mysqli gd mbstring opcache zip pcntl && \
    docker-php-ext-enable apcu

COPY timezone.ini /usr/local/etc/php/conf.d/

RUN usermod -u 1000 www-data

RUN mkdir -p /www && \
    chown -R www-data /www

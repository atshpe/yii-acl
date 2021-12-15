FROM php:7.4.26-fpm

RUN apt update && apt upgrade -y
RUN apt install -y \
    openssl \
    libssl-dev \
    pkg-config \
    libpcre3-dev \
    libpq-dev \
    zlib1g \
    zlib1g-dev \
    libmemcached-dev \
    curl \
    libcurl4-openssl-dev \
    libicu-dev \
    libpng-dev

RUN docker-php-ext-install gd
RUN docker-php-ext-enable gd

EXPOSE 9000

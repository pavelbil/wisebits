FROM php:7.4-cli
WORKDIR /src/app
RUN apt-get update && apt-get install -y git && docker-php-ext-install pdo_mysql
RUN pecl install xdebug
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version
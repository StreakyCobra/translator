FROM php:5

RUN docker-php-ext-install pdo pdo_mysql

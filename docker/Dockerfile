FROM php:8.1-apache

RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && apt-get install -y libmariadb-dev \
    && docker-php-ext-install pdo pdo_mysql

COPY ./php/php81/php.ini /usr/local/etc/php/

RUN a2enmod rewrite

RUN service apache2 restart

EXPOSE 80

CMD ["apache2-foreground"]
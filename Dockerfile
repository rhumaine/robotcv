FROM #{azure.registry.url}#/php80-fpm:1.0.0

ENV COMPOSER_ALLOW_SUPERUSER=1 

WORKDIR /app
COPY . /app

RUN apt-get update \
     && apt-get install -y libzip-dev \
     && apt-get update -yqq \
     && apt-get install libjpeg-dev libpng-dev -yqq \
     && docker-php-ext-install zip gd \
     && docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies
RUN composer install

EXPOSE 8000
CMD php -S 0.0.0.0:8000 -t public
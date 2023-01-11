FROM #{azure.registry.url}#/php74-fpm:1.0.0

ENV COMPOSER_ALLOW_SUPERUSER=1 

WORKDIR /app
COPY . /app

RUN apt-get update \
     && apt-get install -y libzip-dev \
     && docker-php-ext-install zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies
RUN composer install

EXPOSE 8000
CMD php -S 0.0.0.0:8000 -t public
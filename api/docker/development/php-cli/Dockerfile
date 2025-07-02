FROM php:8.2-cli-alpine

RUN apk add --no-cache libpq-dev bash coreutils git linux-headers \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && apk del git linux-headers

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

## Копируем только файлы, необходимые для composer install
#COPY composer.json composer.lock ./
#
## Устанавливаем зависимости Composer
#RUN composer install --no-interaction --no-scripts --no-autoloader --optimize-autoloader
#
## Генерируем автозагрузку
#RUN composer dump-autoload --optimize
#
#ENV COMPOSER_ALLOW_SUPERUSER 1

WORKDIR /app

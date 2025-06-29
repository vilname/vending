FROM php:8.2-fpm-alpine

WORKDIR /app

RUN apk add --no-cache libpq-dev bash coreutils git linux-headers \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && apk del git linux-headers

#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
#
## Копируем только файлы, необходимые для composer install
#COPY composer.json composer.lock ./
#
## Устанавливаем зависимости Composer
#RUN composer install --no-interaction --no-scripts --no-autoloader --optimize-autoloader

# Копируем остальные файлы проекта
COPY ./common/php/conf.d /usr/local/etc/php/conf.d
COPY ./common/php/php-fpm.d /usr/local/etc/php-fpm.d
COPY ./development/php/conf.d /usr/local/etc/php/conf.d
COPY ./development/php-fpm/conf.d /usr/local/etc/php/conf.d

## Генерируем автозагрузку
#RUN composer dump-autoload --optimize

# Устанавливаем правильные права
RUN chown -R www-data:www-data /app

# Указываем пользователя
USER www-data

EXPOSE 9000
CMD ["php-fpm"]
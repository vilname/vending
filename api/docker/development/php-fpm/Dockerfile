FROM php:8.2-fpm-alpine

WORKDIR /app

RUN apk update && apk add \
    build-base \
    postgresql-dev \
    libzip-dev \
    zip \
    unzip \
    git

RUN docker-php-ext-install pdo pdo_pgsql zip

# Копируем остальные файлы проекта
COPY ./common/php/conf.d /usr/local/etc/php/conf.d
COPY ./common/php/php-fpm.d /usr/local/etc/php-fpm.d
COPY ./development/php/conf.d /usr/local/etc/php/conf.d
COPY ./development/php-fpm/conf.d /usr/local/etc/php/conf.d

# Устанавливаем правильные права
RUN chown -R www-data:www-data /app

# Указываем пользователя
USER www-data

EXPOSE 9000
CMD ["php-fpm"]
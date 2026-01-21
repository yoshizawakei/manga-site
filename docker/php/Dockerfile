# AlpineベースのPHP 7.4イメージを指定
FROM php:7.4-fpm-alpine

# php.iniのコピー
COPY php.ini /usr/local/etc/php/

# Alpineでは apt ではなく apk を使用
# 依存ライブラリの名称もAlpine用に変更
RUN apk update && apk add --no-cache \
  mysql-client \
  libzip-dev \
  zlib-dev \
  unzip \
  && docker-php-ext-install pdo_mysql zip

# Composerのインストール（マルチステージビルドを使うのが現在の主流で軽量です）
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
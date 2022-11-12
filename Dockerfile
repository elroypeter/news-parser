FROM php:7.4.3-fpm

RUN apt update \
    && apt install -y zlib1g-dev g++ git supervisor libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

# add amqp extension
RUN apt install -y \
    librabbitmq-dev \
    libssh-dev \
    && docker-php-ext-install \
    bcmath \
    sockets \
    && pecl install amqp \
    && docker-php-ext-enable amqp

WORKDIR /var/www/news_parser

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

RUN git config --global user.email "my@projects@67" \ 
    && git config --global user.name "davis67"



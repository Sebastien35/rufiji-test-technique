# Stage 1: Build mhsendmail
FROM golang:1.20 AS builder

RUN go install github.com/mailhog/mhsendmail@latest

# Stage 2: Build the PHP Apache image
FROM php:7.3-apache

# Copy php.ini
COPY php.ini /usr/local/etc/php/php.ini

# Workaround for write permission on write to MacOS X volumes
RUN usermod -u 1000 www-data

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install dependencies
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        openssl \
        libmemcached-dev \
        libmariadbclient-dev-compat \
        default-libmysqlclient-dev \
        libicu-dev \
        libpq-dev \
        libssh2-1-dev \
        wkhtmltopdf \
        libzip-dev \
        cron \
        curl \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install mysqli \
    && docker-php-ext-enable mysqli \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install pdo_pgsql \
    && apt-get update \
    && DEBIAN_FRONTEND=noninteractive apt-get install -y libmemcached-dev \
    && rm -rf /var/lib/apt/lists/* \
    && MEMCACHED="`mktemp -d`" \
    && curl -skL https://github.com/php-memcached-dev/php-memcached/archive/master.tar.gz | tar zxf - --strip-components 1 -C $MEMCACHED \
    && docker-php-ext-configure $MEMCACHED \
    && docker-php-ext-install $MEMCACHED \
    && rm -rf $MEMCACHED \
    && mkdir -p /usr/src/php/ext/redis \
    && curl -L https://github.com/phpredis/phpredis/archive/5.1.1.tar.gz | tar xvz -C /usr/src/php/ext/redis --strip 1 \
    && echo 'redis' >> /usr/src/php-available-exts \
    && docker-php-ext-install redis \
    && yes | pecl install ssh2-1.2 \
    && docker-php-ext-enable ssh2 \
    && docker-php-ext-install zip

# Install additional dependencies
RUN apt-get update && \
    apt-get install --no-install-recommends --assume-yes --quiet ca-certificates curl git && \
    rm -rf /var/lib/apt/lists/*

# Copy mhsendmail from the builder stage
COPY --from=builder /go/bin/mhsendmail /usr/bin/mhsendmail

# Install other PHP extensions
RUN apt-get update -y \
  && apt-get install -y \
    libxml2-dev \
  && apt-get clean -y \
  && docker-php-ext-install soap

# Set timezone
ENV TZ=Europe/Paris
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Install Xdebug
RUN curl -fsSL 'https://xdebug.org/files/xdebug-2.9.0.tgz' -o xdebug.tar.gz \
    && mkdir -p xdebug \
    && tar -xf xdebug.tar.gz -C xdebug --strip-components=1 \
    && rm xdebug.tar.gz \
    && ( \
    cd xdebug \
    && phpize \
    && ./configure --enable-xdebug \
    && make -j$(nproc) \
    && make install \
    ) \
    && rm -r xdebug \
    && docker-php-ext-enable xdebug

# Install nano editor
RUN apt-get install -y nano

# Enable SSL in Apache
RUN a2enmod ssl

# Restart Apache
RUN service apache2 restart

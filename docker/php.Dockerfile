FROM php:8.2-fpm-alpine

ENV PHPMYADMIN_PATH="/usr/share/phpMyAdmin"

ADD ./docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf

RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel

RUN mkdir -p /var/www/html

ADD ./src/ /var/www/html

RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN chown -R laravel:laravel /var/www/html

# Install and Configure phpMyAdmin
RUN \
    mkdir -p ${PHPMYADMIN_PATH} && \
    cd ${PHPMYADMIN_PATH} && \
    curl -sL https://www.phpmyadmin.net/downloads/phpMyAdmin-latest-all-languages.tar.gz -o phpMyAdmin-latest.tar.gz && \
    tar -xf phpMyAdmin-latest.tar.gz && rm phpMyAdmin-latest.tar.gz && \
    mv phpMyAdmin-*-all-languages/* ${PHPMYADMIN_PATH} && \
    rm -rf phpMyAdmin-*-all-languages && \
    cp ${PHPMYADMIN_PATH}/config.sample.inc.php ${PHPMYADMIN_PATH}/config.inc.php && \
    sed -i "s/localhost/${MYSQL_HOST}:${MYSQL_PORT}/g" ${PHPMYADMIN_PATH}/config.inc.php

RUN chmod -R 0766 ${PHPMYADMIN_PATH}

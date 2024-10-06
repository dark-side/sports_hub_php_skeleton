FROM php:8.2-fpm-alpine

ENV PHPMYADMIN_PATH="/usr/share/phpMyAdmin"

COPY ./docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf

RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel && \
    mkdir -p /var/www/html && \
    docker-php-ext-install pdo pdo_mysql mysqli && \
    chown -R laravel:laravel /var/www/html


#RUN PHPMYADMIN_VERSION=5.2.1 && \
# Install libbz2-dev and zlib1g-dev packages to support *.sql.bz2 and *.sql.zip compressed files during imports
#    apt-get update && \
#    apt-get install -y --no-install-recommends libbz2-dev zlib1g-dev && \
#    apt-get clean && \
#    rm -rf /var/lib/apt/lists/* && \
# Install PHP Extensions
#    docker-php-ext-install bz2 mbstring mysqli zip && \
    mkdir -p ${PHPMYADMIN_PATH} && \
    cd ${PHPMYADMIN_PATH} && \
# Download and extract phpMyAdmin
    curl https://files.phpmyadmin.net/phpMyAdmin/${PHPMYADMIN_VERSION}/phpMyAdmin-${PHPMYADMIN_VERSION}-all-languages.tar.gz | tar --extract --gunzip --file - --strip-components 1 && \
    rm -rf examples && \
    rm -rf setup && \
    rm -rf sql

#RUN \
#    mkdir -p ${PHPMYADMIN_PATH} && \
#    cd ${PHPMYADMIN_PATH} && \
#    curl -sL https://www.phpmyadmin.net/downloads/phpMyAdmin-latest-all-languages.tar.gz -o phpMyAdmin-latest.tar.gz
#    tar -xf phpMyAdmin-latest.tar.gz && rm phpMyAdmin-latest.tar.gz && \
#    mv phpMyAdmin-*-all-languages/* ${PHPMYADMIN_PATH} && \
#    rm -rf phpMyAdmin-*-all-languages && \
#    cp ${PHPMYADMIN_PATH}/config.sample.inc.php ${PHPMYADMIN_PATH}/config.inc.php && \
#    sed -i "s/localhost/${MYSQL_HOST}:${MYSQL_PORT}/g" ${PHPMYADMIN_PATH}/config.inc.php


RUN chmod -R 0766 ${PHPMYADMIN_PATH}

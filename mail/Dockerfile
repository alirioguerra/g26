FROM php:8.0-fpm
RUN apt-get update
RUN apt-get install -y autoconf pkg-config git make libc-dev vim

RUN curl -sS https://getcomposer.org/installer | php \ 
    && mv composer.phar /usr/local/bin/ \
    && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

WORKDIR /home/alirio_phpmailer

ENTRYPOINT [ "php", "-S", "0.0.0.0:8080", "-t", "/home/alirio_phpmailer" ]
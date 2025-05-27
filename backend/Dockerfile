FROM php:7.3-cli

RUN apt-get update && apt-get install -y unzip git curl protobuf-compiler

WORKDIR /app
COPY . .

RUN curl -sS https://getcomposer.org/installer | php && \
    php composer.phar install

EXPOSE 9000
CMD ["php", "server.php"]
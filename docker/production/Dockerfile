FROM php:8.4-fpm-alpine

WORKDIR /var/www

ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=America/Recife

# Installing essential packages
RUN apk update && apk upgrade && apk add --no-cache zlib libpng libzip imagemagick ffmpeg \
    librsvg libwebp libxpm libjpeg-turbo tzdata nginx supervisor vim nodejs npm zip unzip

# Configuring Timezone
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime

# Installation of tools and temporary packages just for build
RUN apk add --no-cache --virtual .temp-deps $PHPIZE_DEPS zlib-dev libpng-dev libzip-dev \
    imagemagick-dev ffmpeg-dev librsvg-dev libwebp-dev libxpm-dev libjpeg-turbo-dev

# ==================================================================================================
# ATTENTION: This script should be removed after a new version of imagick is released with the fixes
# for PHP 8.4 regarding the `php_strtolower` function. =============================================
# ==================================================================================================
RUN pecl download imagick-3.7.0 \
    && tar -xzf imagick-*.tgz \
    && cd imagick-* \
    && phpize \
    && ./configure CPPFLAGS='-Dphp_strtolower=zend_str_tolower' \
    && make -j$(nproc) \
    && make install \
    && cd .. \
    && rm -rf imagick-*
# ==================================================================================================
# End of temporary script. =========================================================================
# ==================================================================================================

# Installing and enabling PHP extensions
RUN pecl install redis && \
    docker-php-ext-configure gd --with-jpeg --with-webp --with-xpm && \
    docker-php-ext-install gd zip pdo_mysql && \
    docker-php-ext-enable redis imagick

# Copying and using php.ini optimized for production
RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Installing Composer
RUN curl -sLS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

# Section for copying extra configuration files and directories
RUN rm -rf ./*
COPY ./app /var/www/
COPY nginx.conf /etc/nginx/nginx.conf
COPY php.ini /usr/local/etc/php/conf.d/99-custom.ini
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Fine adjustments for proper functioning in a development environment
RUN mkdir -p /var/log/supervisor && \
    chown -R www-data:www-data /var/www && \
    chmod -R 755 /var/www/storage && \
    chmod 644 /etc/nginx/nginx.conf

# Cleaning up the image
RUN apk del .temp-deps

EXPOSE 80

ENTRYPOINT ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

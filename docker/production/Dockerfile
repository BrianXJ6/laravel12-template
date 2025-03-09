FROM php:8.4-fpm-bookworm

WORKDIR /var/www

ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=America/Recife

# Configuração do timezone
RUN apt-get update -y && apt-get upgrade -y && apt-get install -y --no-install-recommends tzdata && \
    echo $TZ > /etc/timezone && \
    ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && \
    dpkg-reconfigure --frontend noninteractive tzdata && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalação de pacotes essenciais
RUN apt-get update -y && apt-get install -y --no-install-recommends \
    gnupg curl ca-certificates zip unzip supervisor libpng-dev librsvg2-bin ffmpeg \
    imagemagick libmagickwand-dev libcurl4-openssl-dev libzip-dev nginx \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Instalando e habilitando extensões do PHP
RUN pecl install imagick redis \
    && docker-php-ext-install gd zip pdo_mysql \
    && docker-php-ext-enable imagick redis \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Instalação do Composer
RUN curl -sLS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

# Instalação do Nodejs e NPM
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get update -y && apt-get install -y --no-install-recommends nodejs && npm install -g npm \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# LIMPEZA
RUN apt-get purge -y --auto-remove libpng-dev gnupg curl \
    libmagickwand-dev libcurl4-openssl-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Copiando arquivos de configurações e inicialização do projeto
COPY nginx.conf /etc/nginx/nginx.conf
COPY start-container /usr/local/bin/start-container
COPY php.ini /usr/local/etc/php/conf.d/99-custom.ini
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
RUN chmod +x /usr/local/bin/start-container

EXPOSE 80

ENTRYPOINT ["start-container"]

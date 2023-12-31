FROM php:8.2.0-apache
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pgsql pdo pdo_pgsql

# RUN libpng-dev

# RUN apt-get install -y \ zlib1g-dev 

# RUN docker-php-ext-install mbstring

# RUN docker-php-ext-install zip

# RUN docker-php-ext-install gd

RUN apt-get install -y \
    libwebp-dev \
    libjpeg62-turbo-dev \
    libpng-dev libxpm-dev \
    libfreetype6-dev

# RUN docker-php-ext-configure gd \
#     --with-gd \
#     --with-webp-dir \
#     --with-jpeg-dir \
#     --with-png-dir \
#     --with-zlib-dir \
#     --with-xpm-dir \
#     --with-freetype-dir \
#     --enable-gd-native-ttf

# RUN docker-php-ext-install gd

RUN set -e; \
    docker-php-ext-configure gd --with-jpeg --with-webp --with-freetype; \
    docker-php-ext-install -j$(nproc) gd

RUN apt-get install poppler-utils -y
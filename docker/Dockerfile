FROM php:8.4-cli-bookworm
RUN apt-get update && apt-get install -y --no-install-recommends git unzip librsvg2-bin fonts-dejavu-core libpng-dev libjpeg62-turbo-dev libfreetype6-dev libonig-dev libzip-dev libxml2-dev libicu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j2 gd mbstring zip dom xml xmlwriter intl \
    && rm -rf /var/lib/apt/lists/*
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN useradd --create-home --uid 1000 developer
WORKDIR /var/www/html
USER developer
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]

# PHP 7.4 + Apache + Xdebug + Composer install automático
FROM php:7.4.30-apache

ENV TZ=America/Sao_Paulo

# Dependências do sistema
RUN echo $TZ > /etc/timezone && \
    apt-get update && apt-get install -y tzdata zip unzip git \
    libpng-dev libjpeg-dev libfreetype6-dev libonig-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd mbstring pdo pdo_mysql tokenizer json && \
    a2enmod rewrite

# --------------------------------------------------------------------
# 🧩 Instala o Xdebug
# --------------------------------------------------------------------
RUN pecl install xdebug-3.1.6 && docker-php-ext-enable xdebug

# --------------------------------------------------------------------
# 🧩 Copia o php.ini de desenvolvimento para o PHP reconhecer as configs
# --------------------------------------------------------------------
RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

# --------------------------------------------------------------------
# ⚙️ Configuração do Xdebug (3.x)
# --------------------------------------------------------------------
RUN echo "zend_extension=xdebug" > /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=172.17.0.1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.log=/tmp/xdebug.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.log_level=7" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini


# Instala Composer
COPY --from=composer:2.2 /usr/bin/composer /usr/bin/composer

# Copia o projeto
WORKDIR /var/www/html
COPY . .

# Instala dependências do Laravel automaticamente
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Permissões do Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Apache config
COPY ./docker/apache/vhost.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80
# Gera a APP_KEY automaticamente se não existir
RUN php artisan key:generate --ansi || true

# Cria o link simbólico do storage automaticamente
RUN php artisan storage:link || true

CMD ["apache2-foreground"]

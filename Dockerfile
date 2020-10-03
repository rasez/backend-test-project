# Pull base image
FROM ubuntu:16.04

RUN apt-get update -y && apt-get install -y software-properties-common python-software-properties && \
     LC_ALL=C.UTF-8 add-apt-repository -y ppa:ondrej/php && apt-get update -y && \
     apt-get install -y php7.2-fpm  php7.2-cli php7.2-common php7.2-mbstring php7.2-gd php7.2-mysql php7.2-soap php7.2-redis \
     php7.2-intl php7.2-xml php7.2-zip php7.2-fpm php7.2-mongo php7.2-curl php7.2-bcmath curl nginx git --fix-missing

#Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
        php composer-setup.php --install-dir=bin --filename=composer && php -r "unlink('composer-setup.php');"

# Copy entrypoint
COPY entrypoint.sh /

# composer install
COPY ["composer.json", "composer.lock", "/var/www/"]
RUN  cd /var/www && composer install --no-autoloader --no-scripts

# Copy project files
COPY . /var/www

# Run composer commands
RUN cd /var/www && composer install && \
        chown -R www-data. /var/www && chmod 777 -R /var/www/storage && chmod 777 -R /var/www/bootstrap/cache && chmod +x /entrypoint.sh

# Define working directory.
WORKDIR /var/www

ENTRYPOINT ["/entrypoint.sh"]
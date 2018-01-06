FROM php:7.0.26-cli

LABEL maintainer="Serghei Iakovlev <serghei@phalconphp.com>"
LABEL version="1.0.0"

ENV PHALCON_VERSION=3.3.0 \
    DEBIAN_FRONTEND=noninteractive \
    COMPOSER_HOME=/root/.composer \
    COMPOSER_ALLOW_SUPERUSER=1 \
    PATH=/root/.composer/vendor/bin:$PATH \
    TERM=xterm

WORKDIR /tmp

RUN echo exit 101 > /usr/sbin/policy-rc.d \
    && chmod +x /usr/sbin/policy-rc.d \
    && echo "force-unsafe-io" > /etc/dpkg/dpkg.cfg.d/02apt-speedup \
    && echo "Acquire::http {No-Cache=True;};" > /etc/apt/apt.conf.d/no-cache \
    && apt-get update \
    && apt-get upgrade -y -q \
    && apt-get install -y -q --no-install-recommends apt-utils software-properties-common

RUN apt-get install -y -q --no-install-recommends \
        build-essential \
        git \
        grc \
        less \
        libcurl3-dev \
        libicu-dev \
        libpcre3-dev \
        libpq-dev \
        libsqlite3-dev \
        libssl-dev \
        libxml2-dev \
        locales \
        mysql-client \
        postgresql-client \
        sqlite3 \
        vim \
        wget \
        zlib1g-dev

RUN docker-php-ext-configure intl 1>/dev/null \
    && docker-php-ext-install intl 1>/dev/null \
    && docker-php-ext-configure mysqli --with-mysqli=mysqlnd 1>/dev/null \
    && docker-php-ext-install mysqli 1>/dev/null \
    && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd 1>/dev/null \
    && docker-php-ext-install pdo_mysql 1>/dev/null \
    && docker-php-ext-configure pgsql --with-pgsql=/usr/local/pgsql 1>/dev/null \
    && docker-php-ext-install pgsql pdo_pgsql zip 1>/dev/null \
    && docker-php-ext-enable opcache \
    && php -m

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin/ --filename=composer \
    && rm composer-setup.php \
    && composer --version

RUN composer global require --no-ansi --prefer-dist --no-interaction --no-suggest "fxp/composer-asset-plugin:~1.4"

RUN curl -sSLO https://codeload.github.com/phalcon/cphalcon/tar.gz/v$PHALCON_VERSION \
	&& tar xzf v$PHALCON_VERSION  \
	&& cd cphalcon-$PHALCON_VERSION/build \
	&& ./install --phpize /usr/local/bin/phpize --php-config /usr/local/bin/php-config 1>/dev/null \
	&& echo "extension=`php-config --extension-dir`/phalcon.so" > $PHP_INI_DIR/conf.d/docker-php-ext-phalcon.ini \
    && php --ri phalcon

RUN apt-get autoremove -y \
	&& apt-get autoclean -y \
	&& apt-get clean -y \
    && rm -rf \
    	/var/lib/apt/lists/* \
    	/tmp/* \
    	/var/tmp/* \
    	/etc/php5 \
    	/etc/php/5* \
    	/usr/lib/php/20121212 \
    	/usr/lib/php/20131226 \
    	/var/log \
    	/var/cache

WORKDIR /app
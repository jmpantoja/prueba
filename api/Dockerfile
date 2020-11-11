# the different stages of this Dockerfile are meant to be built into separate images
# https://docs.docker.com/develop/develop-images/multistage-build/#stop-at-a-specific-build-stage
# https://docs.docker.com/compose/compose-file/#target


# https://docs.docker.com/engine/reference/builder/#understand-how-arg-and-from-interact
ARG PHP_VERSION=7.4
ARG APCU_VERSION=5.1.16
ARG OPENRESTY_VERSION=1.17.8.2
ARG VARNISH_VERSION=6.5

# build for production
#ARG APP_ENV=prod

FROM php:${PHP_VERSION}-fpm-buster AS api_platform_php

RUN useradd -m -o -u 1000 docker;

ENV TZ=Europe/Madrid
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN set -eux;
RUN mkdir -p /usr/share/man/man1

RUN apt update \
	&& apt install -y --fix-missing --no-install-recommends \
		$PHPIZE_DEPS \
		software-properties-common \
		libicu-dev \
		libfcgi-bin \
		libzip-dev  \
		zlib1g-dev  \
		apt-utils \
		acl \
		pdftk \
		git \
		libssl-dev \
		wget \
		gnupg2 \
		unzip \
		libmagickwand-dev \
		rclone \
		cron \
	&& docker-php-ext-install -j$(nproc) \
       		intl \
       		mysqli \
       		pdo \
       		pdo_mysql \
       		zip \
       		bcmath \
	&& apt clean \
	;

RUN wget https://github.com/wkhtmltopdf/wkhtmltopdf/releases/download/0.12.5/wkhtmltox_0.12.5-1.buster_amd64.deb \
	&& apt install -y ./wkhtmltox_0.12.5-1.buster_amd64.deb \
	&& rm ./wkhtmltox_0.12.5-1.buster_amd64.deb

RUN pecl install \
#	apcu-5.1.16 \
	imagick \
	raphf \
	propro \
	xdebug \
	&& printf "\n" | \
	docker-php-ext-enable imagick \
	raphf \
	propro \
	xdebug \
	&& pecl clear-cache \
    ;



# Install Blackfire CLI tool and PHP Probe
RUN wget -q -O - https://packages.blackfire.io/gpg.key | apt-key add -
RUN echo "deb http://packages.blackfire.io/debian any main" | tee /etc/apt/sources.list.d/blackfire.list
RUN apt-get update && apt-get install -y blackfire-agent blackfire-php


RUN mkdir -p /usr/local/etc/php/conf.d/disabled
RUN rm /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
COPY docker/php/conf.d/docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/disabled/docker-php-ext-xdebug.ini


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN ln -s $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini
COPY docker/php/conf.d/api-platform.prod.ini $PHP_INI_DIR/conf.d/api-platform.ini

RUN set -eux; \
	{ \
		echo '[www]'; \
		echo 'ping.path = /ping'; \
	} | tee /usr/local/etc/php-fpm.d/docker-healthcheck.conf

# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER=1
# install Symfony Flex globally to speed up download of Composer packages (parallelized prefetching)
RUN set -eux; \
	composer global require "symfony/flex" --prefer-dist --no-progress --no-suggest --classmap-authoritative; \
	composer clear-cache
ENV PATH="${PATH}:/root/.composer/vendor/bin"

WORKDIR /srv/api

COPY docker/php/docker-healthcheck.sh /usr/local/bin/docker-healthcheck
RUN chmod +x /usr/local/bin/docker-healthcheck

HEALTHCHECK --interval=10s --timeout=3s --retries=3 CMD ["docker-healthcheck"]

COPY docker/php/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

ENTRYPOINT ["docker-entrypoint"]
CMD ["php-fpm"]


FROM api_platform_php as api_platform_php_prod
# build for production
ARG APP_ENV=prod

# prevent the reinstallation of vendors at every changes in the source code
COPY composer.json composer.lock symfony.lock ./
RUN set -eux; \
	composer install --prefer-dist --no-dev --no-scripts --no-progress --no-suggest; \
	composer clear-cache

# do not use .env files in production
COPY .env ./
#RUN composer dump-env prod; \
#	rm .env

# copy only specifically what we need
COPY bin bin/
COPY config config/
COPY migrations migrations/
COPY public public/
COPY src src/

RUN set -eux; \
	mkdir -p var/cache var/log; \
	composer dump-autoload --classmap-authoritative --no-dev; \
	composer run-script --no-dev post-install-cmd; \
	chmod +x bin/console; sync
VOLUME /srv/api/var



# "nginx" stage
# depends on the "php" stage above
# The OpenResty distribution of NGINX is only needed for Kubernetes compatiblity (dynamic upstream resolution)
FROM openresty/openresty:${OPENRESTY_VERSION}-alpine AS api_platform_nginx

RUN echo -e "env UPSTREAM;\n$(cat /usr/local/openresty/nginx/conf/nginx.conf)" > /usr/local/openresty/nginx/conf/nginx.conf
COPY docker/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf

WORKDIR /srv/api/public

COPY public /srv/api/public/


# "varnish" stage
# does not depend on any of the above stages, but placed here to keep everything in one Dockerfile
FROM varnish:${VARNISH_VERSION} AS api_platform_varnish

ENV BACKEND=api
ENV UPSTREAM=php

COPY docker/varnish/conf/default.tmpl /usr/local/etc/varnish/default.tmpl

RUN set -eux; \
	apt-get update; \
	apt-get install -y gettext-base; \
	apt-get clean; \
	rm -rf /var/lib/apt/lists/*

COPY docker/varnish/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

ENTRYPOINT ["docker-entrypoint"]

CMD ["varnishd", "-F", "-f", "/etc/varnish/default.vcl", "-p", "http_resp_hdr_len=65536", "-p", "http_resp_size=98304"]

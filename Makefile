dev:
	docker-compose -f docker-compose.yml -f docker/docker-compose.dev.yml up -d

down:
	docker-compose down

build:
	docker-compose -f docker/docker-compose.build.yml pull --ignore-pull-failures
	docker-compose -f docker/docker-compose.build.yml build --pull

push:
	docker-compose -f docker/docker-compose.build.yml push

admin-restart:
	docker-compose restart admin

xdebug-disabled:
	docker-compose exec php mv /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/disabled/docker-php-ext-xdebug.ini
	docker-compose exec php pkill -o -USR2 php-fpm
	#docker-compose exec php /etc/init.d/blackfire-agent restart

xdebug-enabled:
	docker-compose exec php mv /usr/local/etc/php/conf.d/disabled/docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
	docker-compose exec php pkill -o -USR2 php-fpm
	#docker-compose exec php /etc/init.d/blackfire-agent restart

varnish-purge:
	docker-compose exec cache-proxy varnishadm "ban req.url ~ /"

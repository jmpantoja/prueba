dev:
	docker-compose -f docker-compose.yml -f docker/docker-compose.dev.yml up -d --remove-orphans

pro:
	docker-compose -f docker-compose.yml -f docker/docker-compose.pro.yml up -d --remove-orphans

down:
	docker-compose -f docker-compose.yml  -f docker/docker-compose.dev.yml -f docker/docker-compose.pro.yml down --remove-orphans

restart:
	docker-compose -f docker-compose.yml -f docker/docker-compose.dev.yml restart

build:
	docker-compose -f docker/docker-compose.build.yml pull --ignore-pull-failures
	docker-compose -f docker/docker-compose.build.yml build --pull

push:
	docker-compose -f docker/docker-compose.build.yml push

ps:
	docker-compose ps

nginx-reload:
	docker-compose exec api  nginx -s reload -c /usr/local/openresty/nginx/conf/nginx.conf

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

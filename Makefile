dev:
	docker-compose -f docker-compose.yml -f docker/docker-compose.dev.yml up -d
#	docker-compose up -d

down:
	docker-compose down

build:
	docker-compose -f docker/docker-compose.build.yml pull --ignore-pull-failures
	docker-compose -f docker/docker-compose.build.yml build --pull

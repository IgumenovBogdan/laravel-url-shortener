build:
	docker-compose up -d --build
	docker-compose run --rm php-cli composer install
	cp .env.example .env
	docker-compose run --rm php-fpm php artisan key:generate
	chmod -R 777 storage && chmod -R 777 bootstrap/cache

up:
	docker-compose up -d

down:
	docker-compose down

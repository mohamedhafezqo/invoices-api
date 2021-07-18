build:
	docker-compose up -d --build
	docker exec php-container composer install
	make create-db
	make migrate
#	make fixture

create-db:
	docker exec php-container php bin/console doctrine:database:create --if-not-exists

migrate:
	docker exec php-container php bin/console doctrine:migrations:migrate

fixture:
	docker exec php-container php bin/console doctrine:fixtures:load --append

bash:
	docker exec -it php-container  bash

test:
	docker exec php-container php bin/phpunit

down:
	docker-compose down

COMPOSE_FILE := docker-compose.yml
COMPOSE_CMD := docker compose --file=$(COMPOSE_FILE)

help:	## shows help
	@echo "Usage: make [target]"
	@echo ""
	@echo "Targets:"
	@echo ""
	@awk 'BEGIN {FS = ":.*##"; printf "\033[36m"} /^[a-zA-Z_-]+:.*?##/ { printf "  %-30s %s\n", $$1, $$2 }' $(MAKEFILE_LIST) | sort
	@echo ""

.PHONY: help

setting-env:	## creates .env file if not exists
	@if [ ! -f .env ]; then cp .env.example .env; fi

setting-echo-server:	## echo host url use in env file
	@echo "http://$(shell grep COMPOSE_PROJECT_NETWORK .env | cut -d '=' -f2).2"

docker-pull:	## pulls docker images
	$(MAKE) -s setting-env
	$(COMPOSE_CMD) pull

docker-build:	## builds docker images
	$(MAKE) -s setting-env
	$(COMPOSE_CMD) build

docker-up:	## starts docker containers
	$(MAKE) -s setting-env
	$(COMPOSE_CMD) up -d
	$(MAKE) -s setting-echo-server

docker-start:	## starts docker containers
	$(COMPOSE_CMD) start

docker-stop:	## stops docker containers
	$(COMPOSE_CMD) stop

docker-down:	## stops docker containers
	$(COMPOSE_CMD) down --volumes --remove-orphans

docker-restart:	## restarts docker containers
	$(COMPOSE_CMD) restart
	$(MAKE) -s setting-echo-server

docker-logs:	## shows docker logs
	$(COMPOSE_CMD) logs -f

docker-ps:	## shows docker processes
	$(COMPOSE_CMD) ps


php-bash:	## enters php container
	$(COMPOSE_CMD) exec -it php-fpm bash

php-composer-install:	## installs composer dependencies
	$(COMPOSE_CMD) exec php-fpm composer install

php-composer-update:	## updates composer dependencies
	$(COMPOSE_CMD) exec php-fpm composer update

php-composer-dump-autoload:	## dumps composer autoload
	$(COMPOSE_CMD) exec php-fpm composer dump-autoload

php-migrate:	## runs migrations
	$(COMPOSE_CMD) exec php-fpm php artisan migrate

php-migrate-fresh-seed:	## runs migrations fresh
	$(COMPOSE_CMD) exec php-fpm php artisan migrate:fresh --seed

php-seed:	## runs seeders
	$(COMPOSE_CMD) exec php-fpm php artisan db:seed

php-tinker:	## enters php tinker
	$(COMPOSE_CMD) exec -it php-fpm php artisan tinker

php-up:	## starts php container
	$(COMPOSE_CMD) up -d php-fpm
	$(MAKE) -s php-composer-install
	$(MAKE) -s php-migrate-fresh-seed

php-stop:	## stops php container
	$(COMPOSE_CMD) stop php

php-artisan:	## runs artisan command
	$(COMPOSE_CMD) exec php-fpm php artisan $(filter-out $@,$(MAKECMDGOALS))

php-config-clear:	## clears config cache
	$(COMPOSE_CMD) exec php-fpm php artisan config:clear

p-run:	docker-up php-composer-update php-migrate setting-echo-server## runs to start project

CONTAINER_BACK=app_tray

all: help

docker-install: docker-build docker-up docker-composer-install docker-migrate docker-clear

docker-up: ## Inicia o container
	docker compose up -d

docker-down: ## Para e remove containers
	docker compose down

docker-bash: docker-up ## Inicia uma sessao bash
	docker exec -it $(CONTAINER_BACK) /bin/bash

docker-build: ## Constroi os containers
	docker compose build

docker-composer-install: docker-up ## Instala as dependencias do composer
	docker exec $(CONTAINER_BACK) composer install --no-interaction --no-scripts  && chmod -R 777 bootstrap &&  php artisan key:generate

docker-test: docker-up docker-clear ## Executa os testes da apicacao sem cobertura. Use a opcao 'FILTER' para rodar um teste especifico
ifdef FILTER
	docker exec -t $(CONTAINER_BACK) php artisan test --filter="$(FILTER)"
else
	docker exec -t $(CONTAINER_BACK) php artisan test
endif

docker-logs: docker-up ## Visualiza os logs do container
	docker compose logs --follow

docker-clear: docker-up ## Limpa os caches do laravel
	docker exec $(CONTAINER_BACK) /bin/bash -c "php artisan optimize:clear" && chmod -R 777 storage && chmod -R 777 bootstrap

docker-coverage: docker-up docker-clear ## Executa os testes com cobertura
	docker exec -t $(CONTAINER_BACK) php artisan test --coverage

help: ## Mostra o menu de ajuda
	@grep -E '^[a-zA-Z0-9_-]+:.*?## .*$$' $(firstword $(MAKEFILE_LIST)) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}'

docker-migrate: ## Executa a migracao do banco
	docker exec $(CONTAINER_BACK) /bin/bash -c "php artisan migrate --seed"

.PHONY: help setup up down restart logs shell composer yarn cache-clear migration-diff migration-migrate

help: ## Show this help message
	@echo 'Usage: make [target]'
	@echo ''
	@echo 'Targets:'
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "  %-15s %s\n", $$1, $$2}' $(MAKEFILE_LIST)

setup: ## Initial setup - build containers and run setup script
	./docker/scripts/setup.sh

up: ## Start all containers
	docker-compose up -d

down: ## Stop all containers
	docker-compose down

restart: ## Restart all containers
	docker-compose restart

logs: ## Show logs for all containers
	docker-compose logs -f

logs-app: ## Show logs for app container only
	docker-compose logs -f app

shell: ## Access the application container shell
	docker-compose exec app bash

composer: ## Install/update Composer dependencies
	docker-compose exec app composer install

yarn: ## Install/update Node dependencies
	docker-compose exec app yarn install

build-assets: ## Build frontend assets
	docker-compose exec app yarn build

watch-assets: ## Watch and rebuild assets on change
	docker-compose exec app yarn watch

cache-clear: ## Clear Symfony cache
	docker-compose exec app php bin/console cache:clear

migration-diff: ## Generate a new migration
	docker-compose exec app php bin/console doctrine:migrations:diff

migration-migrate: ## Run pending migrations
	docker-compose exec app php bin/console doctrine:migrations:migrate --no-interaction

test: ## Run tests
	docker-compose exec app php bin/phpunit

db-reset: ## Reset database (WARNING: will delete all data)
	docker-compose exec app php bin/console doctrine:database:drop --force --if-exists
	docker-compose exec app php bin/console doctrine:database:create
	docker-compose exec app php bin/console doctrine:migrations:migrate --no-interaction

db-import: ## Import SQL dump (requires munich.sql file)
	@if [ ! -f munich.sql ]; then echo "Error: munich.sql file not found"; exit 1; fi
	@echo "Fixing SQL file format..."
	@chmod +x fix_sql.sh && ./fix_sql.sh
	@echo "Copying SQL file to container..."
	docker-compose cp munich_fixed.sql database:/tmp/munich_fixed.sql
	@echo "Importing database..."
	docker-compose exec database mysql -u user -ppassword munich_backend -e "source /tmp/munich_fixed.sql"
	@echo "Database import completed!"

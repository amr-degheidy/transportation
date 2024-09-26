.DEFAULT_GOAL = help

# Variables
SAIL = ./vendor/bin/sail
PHP = $(SAIL) php
ARTISAN = $(SAIL) artisan
COMPOSER = $(SAIL) composer
NPM = $(SAIL) npm

sail-cmd: ## for sail commands
	@echo 'Run Sail Command : ' . $(filter-out $@,$(MAKECMDGOALS))
	$(SAIL) $(filter-out $@,$(MAKECMDGOALS))

composer-cmd: ## for composer commands
	@echo 'Run Composer Command : ' . $(filter-out $@,$(MAKECMDGOALS))
	$(COMPOSER) $(filter-out $@,$(MAKECMDGOALS))

npm-cmd: ## for npm commands
	@echo 'Run NPM Command : ' . $(filter-out $@,$(MAKECMDGOALS))
	$(NPM) $(filter-out $@,$(MAKECMDGOALS))

artisan-cmd: ## for artisan commands
	@echo 'Run Artisan Command : '. $(filter-out $@,$(MAKECMDGOALS))
	$(ARTISAN) $(filter-out $@,$(MAKECMDGOALS))

help:
	@grep -E '^[a-z.A-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

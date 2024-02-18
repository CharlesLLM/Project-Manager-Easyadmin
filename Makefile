CONSOLE=php bin/console

.PHONY: start up vendor folders db db-diff fixtures cc stop

start: up db cc

up:
	symfony serve -d --port=8000

stop:
	symfony server:stop

vendor:
	composer install

db:
	$(CONSOLE) doctrine:database:drop --if-exists --force
	$(CONSOLE) doctrine:database:create --if-not-exists
	$(CONSOLE) doctrine:schema:update --force --complete
	$(CONSOLE) doctrine:fixtures:load -n

fixtures:
	$(CONSOLE) doctrine:fixtures:load -n

cc:
	$(CONSOLE) cache:clear --no-warmup
	$(CONSOLE) cache:warmup

folders:
	mkdir -p public/img/projects

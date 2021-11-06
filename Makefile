.PHONY: tests
tests:
	php bin/console cache:clear --env=test
	symfony console doctrine:database:drop --if-exists -f --env=test
	symfony console doctrine:database:create --env=test
	symfony console doctrine:schema:update -f --env=test
	symfony console doctrine:fixtures:load -n --env=test
	symfony php bin/phpunit --testdox --coverage-html coverage

.PHONY: test-CI
test-CI:
	symfony php bin/phpunit --testdox
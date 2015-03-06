.PHONY: test testdocs

test:
	phpunit

testdocs:
	rm -rf ./build/tests
	phpunit --coverage-html build/tests --testdox-html build/tests/testdox.html

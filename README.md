# PHPUnit Training Project - TDD

> Simple project to use TDD

[![Build Status](https://travis-ci.org/antfig/phpunit-tdd-training.svg?branch=master)](https://travis-ci.org/antfig/phpunit-tdd-training)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/bb5ea132dd474a66a1650505e89a3799)](https://www.codacy.com/app/antfig/phpunit-tdd-training?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=antfig/phpunit-tdd-training&amp;utm_campaign=Badge_Grade)
[![codecov](https://codecov.io/gh/antfig/phpunit-tdd-training/branch/master/graph/badge.svg)](https://codecov.io/gh/antfig/phpunit-tdd-training)

## Exercise

### Auction
- A user has a name and an email
- The email must be unique for all users
- An auction has a description, an start date, an end data, a seller, a starting price
- A user cannot bid on his/her own auction

### Rules of the game
- Pair programing
- Test-driven (TDD)
- Useful --testdox output
- 100% code coverage
- No database
- No HTML
- No Server
- Use value objects
- There are hidden / implicit requirements


## How to use

- Clone this repo and enter it
- Install the **dependencies** (https://getcomposer.org/download/)
```
composer install
```

- Run the tests

```
vendor/bin/phpunit --colors
```

- See Coverage: (Open index.html in coverage folder)

```
vendor/bin/phpunit --coverage-html coverage
```

- See TestDox

```
vendor/bin/phpunit --testdox
```
or in html format
```
vendor/bin/phpunit --testdox-html dox.html
```

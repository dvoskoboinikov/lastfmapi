# Last.fm Popular Artists

It's a small application built on [Slim](http://www.slimframework.com) (PHP micro-framework) that uses Last.fm API to get information about the most popular artists in various countries.

## Installation

Please use [Composer](https://getcomposer.org/) to install Last.fm Popular Artists in few seconds.

```bash
$ composer install
```

## Tests

The application includes unit and static tests. To run proper testsuit use next commands.

For unit tests (note that [PHPUnit](https://phpunit.de) will be installed during the application installation):

```bash
$ ./vendor/bin/phpunit
```

For static tests:

```bash
$ ./vendor/bin/phpcs
```

## Roadmap

* Implement API requests caching using Memcached to improve application performance.
* Add autocomplete feature to input fields (country e.g.) to improve user experience.
* Implement proper API errors handling to improve user and developer experience.

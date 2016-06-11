# Name Finder

[![Build Status](https://travis-ci.org/jmagrippis/name-finder.svg?branch=master)](https://travis-ci.org/jmagrippis/name-finder)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](./LICENSE)

A simple app to demonstrate [Slim] and some php fundamentals.

## Setup

### With Docker

1. Make sure you have [Docker] installed.
2. Clone the repository.
3. `cd` to the repository's root directory.
4. Build the container with a name of your choice. You could try:
```
docker build -t name-finder .
```
5. Run the container you just built with a running name and a port binding of your choice. You could try:
```
docker run -it -p 8080:80 --rm --name running-name-finder name-finder
```

### Without Docker

1. Make sure you have [php7] installed on your dev environment.
2. Make sure [Composer] is installed as well.
3. Clone the repository.
4. `cd` to the root directory, run `composer install -o`.
5. Serve the public folder using your favourite server. For php's own built-in web server, you would run something like:
```
php -S localhost:8080 -t public
```

## Usage

All the current functionality of this simple app is contained within a single route, so curl `api/v1/users/search/[match]` or visit it from your favourite browser!

The exact address depends on how you decided to serve the app's public folder during the Setup section, for the common defaults displayed above you would want 
to hit something like:

```
http://localhost:8080/api/v1/users/search/john
http://localhost:8080/api/v1/users/search/Kat
http://localhost:8080/api/v1/users/search/MA?dupes // shows duplicates
http://localhost:8080/api/v1/users/search/penelope?dupes=true // also shows duplicates
http://localhost:8080/api/v1/users/search/penelope?dupes=false // explicitly does not show duplicates
```

## Testing

Built using BDD, you may run the modest test suite with `vendor/bin/phpspec run`. Make sure you have `composer install -o`d the dev dependencies as well!

Provided you have the server running on localhost:8080, you may also run the [Codeception] suite with `vendor/bin/codecept run`.


## Tech used

- [Composer] for care-free dependency management.

- [Slim] for lightning-fast routing and general app scaffolding.

- [Phpspec] for BDD-style unit-testing.

- [Codeception] For acceptance testing of the API endpoints.

- [Travis CI] for Continuous Integration.

- [Docker] for consistent environments and easy deployment.

[Slim]: http://www.slimframework.com/ "A micro framework for PHP"
[Composer]: https://getcomposer.org/ "Dependency Manager for PHP"
[phpspec]: http://www.phpspec.net/en/stable/ "A php toolset to drive emergent design by specification"
[Travis CI]: https://travis-ci.org/ "Test and Deploy with Confidence"
[Docker]: https://www.docker.com/ "Build, Ship, Run"
[Codeception]: http://codeception.com/ "Elegant and Efficient Testing for PHP"
[php7]: http://lmgtfy.com/?q=install+php7 "It has been out for quite a while now"

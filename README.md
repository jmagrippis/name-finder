# Name Finder

A simple app to demonstrate [Slim] and some php fundamentals.

## Usage

1. Make sure you have [php7] installed on your dev environment.
2. Make sure [Composer] is installed as well.
3. Clone the repository.
4. `cd` to the root directory, run `composer install -o`.
5. Serve the public folder using your favourite server. For php's own built-in web server, you would run something like:
```
php -S localhost:8080 -t public
```
6. Curl or visit `api/v1/users/search/[match]` on your favourite browser! The exact address depends on how you decided to serve that public folder, 
for the above you would want to hit something like:
```
http://localhost:8080/api/v1/users/search/john
http://localhost:8080/api/v1/users/search/Kat
http://localhost:8080/api/v1/users/search/MA?dupes // shows duplicates
http://localhost:8080/api/v1/users/search/penelope?dupes=true // also shows duplicates
http://localhost:8080/api/v1/users/search/penelope?dupes=false // explicitly does not show duplicates
```
7. ???
8. Profit!

## Testing

Built using BDD, you may run the modest test suite with `vendor/bin/phpspec run`.

## Tech used

- [Composer] for care-free dependency management.

- [Slim] for lightning-fast routing and general app scaffolding.

- [phpspec] for BDD-style unit-testing.

- [Travis CI] for Continuous Integration.

## Wishlist

- Proper Dependency Injection.
- Docker integration.

[Slim]: http://www.slimframework.com/ "A micro framework for PHP"
[Composer]: https://getcomposer.org/ "Dependency Manager for PHP"
[phpspec]: http://www.phpspec.net/en/stable/ "A php toolset to drive emergent design by specification"
[Travis CI]: https://travis-ci.org/ "Test and Deploy with Confidence"
[php7]: http://lmgtfy.com/?q=install+php7 "It has been out for quite a while now"
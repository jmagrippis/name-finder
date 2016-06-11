<?php
use NameFinder\Readers;
use NameFinder\Repositories\UsersFile as UsersRepository;

require '../vendor/autoload.php';

$container = new \Slim\Container;

$container['usersService'] = function ($c) {
    return new UsersRepository(
        new Readers\File(__DIR__ . '/../resources/users.txt')
    );
};

$app = new \Slim\App($container);
$usersRepository = '';
$app->group('/api/v1', function () {
    $this->get('/users/search/{match}', '\NameFinder\Controllers\Users:search');
});
$app->run();
<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Http\Response as Response;

require '../vendor/autoload.php';

$usersRepository = new \NameFinder\Repositories\UsersFile(
    new \NameFinder\Readers\File(__DIR__ . '/../resources/users.txt')
);
$app = new \Slim\App;
$app->group('/api/v1', function () use ($usersRepository) {
    $this->get('/users/search/{match}', function (Request $request, Response $response) use ($usersRepository) {
        $params = $request->getQueryParams();
        $showDupes = array_key_exists('dupes', $params) && $params['dupes'] != '0' && $params['dupes'] != 'false';
        return $response->withJson([
            'users' => $usersRepository->getMatching($request->getAttribute('match'), $showDupes)
        ]);
    });
});
$app->run();
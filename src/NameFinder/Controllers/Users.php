<?php

namespace NameFinder\Controllers;

use Interop\Container\ContainerInterface;
use \Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Http\Response;

class Users
{
    /** @var ContainerInterface */
    protected $ci;

    /**
     * Users constructor.
     * 
     * @param ContainerInterface $ci
     */
    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;
    }

    /**
     * Uses the request parameters to fetch matching Users from the Service.
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function search(Request $request, Response $response): Response
    {
        $usersRepository = $this->ci->get('usersService');
        $params = $request->getQueryParams();
        $showDupes = array_key_exists('dupes', $params) && $params['dupes'] != '0' && $params['dupes'] != 'false';

        return $response->withJson([
            'users' => $usersRepository->getMatching($request->getAttribute('match'), $showDupes)
        ]);
    }
}

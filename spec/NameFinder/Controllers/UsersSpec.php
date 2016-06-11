<?php

namespace spec\NameFinder\Controllers;

use Interop\Container\ContainerInterface;
use NameFinder\Controllers\Users;
use NameFinder\Repositories\UsersInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use \Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Response;

class UsersSpec extends ObjectBehavior
{
    function it_is_initializable(ContainerInterface $ci)
    {
        $this->beConstructedWith($ci);
        $this->shouldHaveType(Users::class);
    }

    function it_returns_a_response_with_the_users_matching_the_search_string(
        ContainerInterface $ci,
        UsersInterface $usersRepo,
        ServerRequestInterface $request,
        Response $response
    ) {
        $usersRepo->getMatching('Tim', false)->willReturn([
            'Tim Bream',
            'Tim Tester',
            'Timmy Tester'
        ]);

        $ci->get('usersService')->willReturn($usersRepo);
        $this->beConstructedWith($ci);

        $request->getAttribute('match')->willReturn('Tim');
        $request->getQueryParams()->willReturn([]);

        $response->withJson([
            'users' => [
                'Tim Bream',
                'Tim Tester',
                'Timmy Tester'
            ]
        ])->willReturn($response);

        $this->search($request, $response)->shouldEqual($response);
    }

    function it_returns_a_response_with_duplicates_when_the_dupes_param_exists(
        ContainerInterface $ci,
        UsersInterface $usersRepo,
        ServerRequestInterface $request,
        Response $response
    ) {
        $usersRepo->getMatching('Tim', true)->willReturn([
            'Tim Bream',
            'Tim Tester',
            'Timmy Tester'
        ]);

        $ci->get('usersService')->willReturn($usersRepo);
        $this->beConstructedWith($ci);

        $request->getAttribute('match')->willReturn('Tim');
        $request->getQueryParams()->willReturn([
            'dupes' => 'true'
        ]);

        $response->withJson([
            'users' => [
                'Tim Bream',
                'Tim Tester',
                'Timmy Tester'
            ]
        ])->willReturn($response);

        $this->search($request, $response)->shouldEqual($response);
    }

    function it_returns_a_response_without_dupes_if_that_param_exists_but_is_set_to_false_or_0(
        ContainerInterface $ci,
        UsersInterface $usersRepo,
        ServerRequestInterface $request,
        Response $response
    ) {
        $usersRepo->getMatching('Tim', false)->willReturn([
            'Tim Bream',
            'Tim Tester',
            'Timmy Tester'
        ]);

        $ci->get('usersService')->willReturn($usersRepo);
        $this->beConstructedWith($ci);

        $request->getAttribute('match')->willReturn('Tim');
        $request->getQueryParams()->willReturn(
            [
                'dupes' => 'false'
            ],
            [
                'dupes' => '0'
            ]);

        $response->withJson([
            'users' => [
                'Tim Bream',
                'Tim Tester',
                'Timmy Tester'
            ]
        ])->willReturn($response);

        $this->search($request, $response)->shouldEqual($response);
        $this->search($request, $response)->shouldEqual($response);
    }
}

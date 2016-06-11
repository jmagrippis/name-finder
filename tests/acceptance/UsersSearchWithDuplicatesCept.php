<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('get users named Penelope ');
$I->lookForwardTo('calculating how many people have the same name');

$I->haveHttpHeader('Content-Type', 'application/json');
$I->sendGet('/api/v1/users/search/penelope?dupes');

$I->seeResponseCodeIs(200);
$I->seeResponseContainsJson(
    [
        'users' => [
            [
                'first_name' => 'Penelope',
                'full_name' => 'Penelope Alsop',
                'last_name' => 'Alsop'
            ],
            [
                'first_name' => 'Penelope',
                'full_name' => 'Penelope Alsop',
                'last_name' => 'Alsop'
            ]
        ]
    ]
);

$I->sendGet('/api/v1/users/search/penelope');

$I->seeResponseCodeIs(200);
$I->dontSeeResponseContainsJson(
    [
        'users' => [
            [
                'first_name' => 'Penelope',
                'full_name' => 'Penelope Alsop',
                'last_name' => 'Alsop'
            ],
            [
                'first_name' => 'Penelope',
                'full_name' => 'Penelope Alsop',
                'last_name' => 'Alsop'
            ]
        ]
    ]
);
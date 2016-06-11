<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('get users named Tim');
$I->lookForwardTo('get an array of users whose name contains "tim"');

$I->haveHttpHeader('Content-Type', 'application/json');
$I->sendGet('/api/v1/users/search/tim');

$I->seeResponseCodeIs(200);
$I->seeResponseContainsJson(
    [
        'users' => [
            [
                'first_name' => 'Tim',
                'full_name' => 'Tim Abraham',
                'last_name' => 'Abraham'
            ]
        ]
    ]
);
<?php

namespace spec\NameFinder\Models;

use NameFinder\Models\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(User::class);
    }

    function it_assigns_its_properties_on_construction()
    {
        $this->beConstructedWith(['first_name' => 'Timmy']);
        $this->getProperties()->shouldBe(['first_name' => 'Timmy']);
    }

    function it_does_not_mass_assign_non_fillable_properties()
    {
        $this->beConstructedWith([
            'first_name' => 'Timmy',
            'last_name' => 'Tester',
            'apiKey' => 'secret'
        ]);
        $this->getProperties()->shouldBe([
            'first_name' => 'Timmy',
            'last_name' => 'Tester'
        ]);
    }
}

<?php

namespace spec\NameFinder\Repositories;

use NameFinder\Readers\ReaderInterface;
use NameFinder\Repositories\{
    UsersFile, UsersInterface
};
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UsersFileSpec extends ObjectBehavior
{
    function let(ReaderInterface $reader)
    {
        $reader->toArray()->willReturn([
            'Timmy Tester',
            'Elena Example',
            'Hyphened Last-Names',
            'Mike More',
            'Larry Less'
        ]);
        $this->beConstructedWith($reader);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UsersFile::class);
        $this->shouldImplement(UsersInterface::class);
    }

    function it_returns_an_array_of_all_users()
    {
        $this->getAll()->shouldHaveCount(5);
    }
}

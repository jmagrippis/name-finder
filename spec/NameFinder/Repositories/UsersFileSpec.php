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
    function it_is_initializable(ReaderInterface $reader)
    {
        $this->beConstructedWith($reader);

        $this->shouldHaveType(UsersFile::class);
        $this->shouldImplement(UsersInterface::class);
    }

    function it_returns_an_array_of_all_users(ReaderInterface $reader)
    {

        $reader->loadAll()->willReturn($reader);
        $reader->getLoaded()->willReturn([
            'Timmy Tester',
            'Elena Example',
            'Hyphened Last-Names',
            'Mike More',
            'Larry Less'
        ]);
        $this->beConstructedWith($reader);

        $this->getAll()->shouldHaveCount(5);
        $reader->loadAll()->shouldHaveBeenCalled();
    }

    function it_returns_the_array_sorted_by_last_name_and_first_name(ReaderInterface $reader)
    {
        $reader->loadAll()->willReturn($reader);
        $reader->getLoaded()->willReturn([
            'Timmy Tester',
            'Elena Example',
            'Hyphened Last-Names',
            'Mike More',
            'Xander Banter',
            'Larry Less',
            'Larking Less'
        ]);
        $this->beConstructedWith($reader);

        $expectedOrder = [
            'Xander Banter',
            'Elena Example',
            'Hyphened Last-Names',
            'Larking Less',
            'Larry Less',
            'Mike More',
            'Timmy Tester'
        ];

        $results = $this->getAll();
        foreach ($expectedOrder as $key => $fullName) {
            $results[$key]->getFullName()->shouldEqual($fullName);
        }
        $reader->loadAll()->shouldHaveBeenCalled();
    }

    function it_returns_an_array_of_matching_users(ReaderInterface $reader)
    {

        $reader->loadWhere('es')->willReturn($reader);
        $reader->getLoaded()->willReturn([
            'Timmy Tester',
            'Larry Less'
        ]);
        $this->beConstructedWith($reader);

        $this->getMatching('es')->shouldHaveCount(2);
        $reader->loadWhere('es')->shouldHaveBeenCalled();
    }

    function it_returns_the_array_of_matching_users_sorted(ReaderInterface $reader)
    {
        $reader->loadWhere('es')->willReturn($reader);
        $reader->getLoaded()->willReturn([
            'Timmy Tester',
            'Larry Less',
            'Larking Less'
        ]);
        $this->beConstructedWith($reader);

        $expectedOrder = [
            'Larking Less',
            'Larry Less',
            'Timmy Tester'
        ];

        $results = $this->getMatching('es');
        foreach ($expectedOrder as $key => $fullName) {
            $results[$key]->getFullName()->shouldEqual($fullName);
        }
        $reader->loadWhere('es')->shouldHaveBeenCalled();
    }

    function it_does_not_return_duplicates_by_default(ReaderInterface $reader)
    {
        $reader->loadAll()->willReturn($reader);
        $reader->getLoaded()->willReturn([
            'Timmy Tester',
            'Elena Example',
            'Timmy Tester',
            'Hyphened Last-Names',
            'Mike More',
            'Mike More',
            'Xander Banter',
            'Larry Less',
            'Larking Less',
            'Xander Banter'
        ]);
        $this->beConstructedWith($reader);

        $expectedOrder = [
            'Xander Banter',
            'Elena Example',
            'Hyphened Last-Names',
            'Larking Less',
            'Larry Less',
            'Mike More',
            'Timmy Tester'
        ];

        $results = $this->getAll();
        $results->shouldHaveCount(7);
        foreach ($expectedOrder as $key => $fullName) {
            $results[$key]->getFullName()->shouldEqual($fullName);
        }
        $reader->loadAll()->shouldHaveBeenCalled();
    }

    function it_returns_duplicates_if_asked(ReaderInterface $reader)
    {
        $reader->loadAll()->willReturn($reader);
        $reader->getLoaded()->willReturn([
            'Timmy Tester',
            'Elena Example',
            'Timmy Tester',
            'Hyphened Last-Names',
            'Mike More',
            'Mike More',
            'Xander Banter',
            'Larry Less',
            'Larking Less',
            'Xander Banter'
        ]);
        $this->beConstructedWith($reader);

        $expectedOrder = [
            'Xander Banter',
            'Xander Banter',
            'Elena Example',
            'Hyphened Last-Names',
            'Larking Less',
            'Larry Less',
            'Mike More',
            'Mike More',
            'Timmy Tester',
            'Timmy Tester'
        ];

        $results = $this->getAll(true);
        $results->shouldHaveCount(10);
        foreach ($expectedOrder as $key => $fullName) {
            $results[$key]->getFullName()->shouldEqual($fullName);
        }
        $reader->loadAll()->shouldHaveBeenCalled();
    }
}

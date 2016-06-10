<?php

namespace spec\NameFinder\Readers;

use NameFinder\Readers\{File, ReaderInterface};
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FileSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(__DIR__ . '/../../resources/users.txt');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(File::class);
        $this->shouldImplement(ReaderInterface::class);
    }

    function it_throws_an_exception_when_constructed_with_an_invalid_filename()
    {
        $this->beConstructedWith('non-existent-file.txt');
        $this
            ->shouldThrow(new \InvalidArgumentException('Not a usable file: non-existent-file.txt'))
            ->duringInstantiation();
    }

    function it_loads_the_whole_given_file_and_returns_itself()
    {
        $this->loadAll()->shouldHaveType(File::class);
        $this->loadAll()->getLoaded()->shouldEqual([
            'Timmy Tester',
            'Elena Example',
            'Hyphened Last-Names',
            'Mike More',
            'Larry Less',
            'Pesky Spaces',
            'More Spaces',
            'After Empty'
        ]);
    }

    function it_loads_strings_matching_the_given_parameter_and_returns_itself()
    {
        $this->loadWhere('Mike')->shouldHaveType(File::class);
        $this->loadWhere('Mike')->getLoaded()->shouldEqual([
            'Mike More'
        ]);

        $this->loadWhere('Spaces')->getLoaded()->shouldEqual([
            'Pesky Spaces',
            'More Spaces'
        ]);

        $this->loadWhere('pty')->getLoaded()->shouldEqual([
            'After Empty'
        ]);
    }

    function it_loads_strings_matching_the_given_parameter_regardless_of_casing_and_returns_itself()
    {
        $this->loadWhere('mike')->shouldHaveType(File::class);
        $this->loadWhere('mike')->getLoaded()->shouldEqual([
            'Mike More'
        ]);

        $this->loadWhere('sPaCes')->getLoaded()->shouldEqual([
            'Pesky Spaces',
            'More Spaces'
        ]);

        $this->loadWhere('PTY')->getLoaded()->shouldEqual([
            'After Empty'
        ]);
    }
}

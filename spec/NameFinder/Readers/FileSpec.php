<?php

namespace spec\NameFinder\Readers;

use NameFinder\Readers\{File, ReaderInterface};
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FileSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(File::class);
        $this->shouldImplement(ReaderInterface::class);
    }
}

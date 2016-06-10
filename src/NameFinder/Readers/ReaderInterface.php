<?php

namespace NameFinder\Readers;


interface ReaderInterface
{
    /**
     * Returns an array from the read input
     *
     * @return array
     */
    public function toArray(): array;
}
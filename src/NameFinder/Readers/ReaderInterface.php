<?php

namespace NameFinder\Readers;


interface ReaderInterface
{
    /**
     * Returns a new instance of itself, with its file loaded.
     *
     * @return ReaderInterface
     */
    public function loadAll(): ReaderInterface;

    /**
     * Returns a new instance of itself, with the lines matching the given parameter loaded.
     *
     * @param string $match
     * @return ReaderInterface
     */
    public function loadWhere(string $match): ReaderInterface;

    /**
     * Returns the loaded lines.
     *
     * @return array
     */
    public function getLoaded(): array;
}
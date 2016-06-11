<?php

namespace NameFinder\Repositories;

use NameFinder\Models\User;

interface UsersInterface
{
    /**
     * Gets all User entities in the repository, filtering duplicates depending on the optional parameter.
     *
     * @param bool $dupes
     * @return User[]
     */
    public function getAll(bool $dupes = false): array;

    /**
     * Gets all User entities containing the given string, filtering dupes depending on the optional parameter.
     *
     * @param string $match
     * @param bool $dupes
     * @return User[]
     */
    public function getMatching(string $match, bool $dupes = false): array;
}

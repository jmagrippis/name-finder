<?php

namespace NameFinder\Repositories;

interface UsersInterface
{
    /**
     * Gets all entities in the repository.
     *
     * @return array
     */
    public function getAll(): array;
}

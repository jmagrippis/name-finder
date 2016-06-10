<?php

namespace NameFinder\Repositories;

use NameFinder\Models\User;
use NameFinder\Readers\ReaderInterface;

class UsersFile implements UsersInterface
{
    protected $reader;

    /**
     * UsersFile constructor.
     *
     * @param ReaderInterface $reader
     */
    public function __construct(ReaderInterface $reader)
    {
        $this->reader = $reader;
    }

    /**
     * Gets all User entities in the repository.
     *
     * @return User[]
     */
    public function getAll(): array
    {
        return array_map(function ($userData): User {
            return new User([
                'first_name' => substr($userData, 0, strpos($userData, ' ')),
                'full_name' => $userData,
                'last_name' => substr($userData, strpos($userData, ' ') + 1)
            ]);
        }, $this->reader->toArray());
    }
}

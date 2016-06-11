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
     * Gets all User entities in the repository, filtering duplicates depending on the optional parameter.
     *
     * @param bool $dupes
     * @return User[]
     */
    public function getAll(bool $dupes = false): array
    {
        return $this->getMatching('', $dupes);
    }

    /**
     * Gets all User entities containing the given string, filtering dupes depending on the optional parameter.
     *
     * @param string $match
     * @param bool $dupes
     * @return User[]
     */
    public function getMatching(string $match, bool $dupes = false): array
    {
        $reader = $match ? $this->reader->loadWhere($match) : $this->reader->loadAll();
        $users = $this->mapUsers($reader->getLoaded());

        usort($users, function (User $a, User $b): int {
            return strcasecmp(
                $a->getLastName() . $a->getFirstName(),
                $b->getLastName() . $b->getFirstName()
            );
        });

        if (!$dupes) {
            $users = $this->removeDuplicates($users);
        }

        return $users;
    }

    /**
     * Maps each element in the array of strings to a User Model and returns the results.
     *
     * @param string[] $userStrings
     * @return User[]
     */
    protected function mapUsers(array $userStrings)
    {
        return array_map(function ($userString): User {
            return new User([
                'first_name' => substr($userString, 0, strpos($userString, ' ')),
                'full_name' => $userString,
                'last_name' => substr($userString, strpos($userString, ' ') + 1)
            ]);
        }, $userStrings);
    }

    /**
     * Removes duplicate Users from the given array and returns it.
     *
     * @param User[] $users
     * @return User[]
     */
    protected function removeDuplicates(array $users)
    {
        $fullNames = [];
        return array_values(array_filter($users, function (User $user) use (&$fullNames) {
            if (!isset($fullNames[$user->getFullName()])) {
                $fullNames[$user->getFullName()] = true;
                return true;
            }
            return false;
        }));
    }
}

<?php

namespace kstirkou\OAT\Entity;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use JsonSerializable;

/**
 * Class UserCollection
 *
 * @package kstisrkou\OAT\Entity
 */
class UserCollection implements IteratorAggregate, Countable, JsonSerializable
{
    /**
     * @var User[]
     */
    protected $users = [];

    /**
     * @param User $user
     *
     * @return UserCollection
     */
    public function add(User $user): self
    {
        $this->users[$user->getLogin()] = $user;
        return $this;
    }

    /**
     * @param array $users
     *
     * @return UserCollection
     */
    public function setUsers(array $users): self
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @return array
     */
    public function getAllUsers(): array
    {
        return $this->users;
    }

    /**
     * @param string $id
     *
     * @return User|null
     */
    public function getById(string $id): ?User
    {
        foreach ($this->users as $user)
        {
            if ($id === $user->getLogin())
            {
                return $user;
            }
        }

        return null;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->users);
    }

    public function count()
    {
        return count($this->users);
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return $this->users;
    }
}
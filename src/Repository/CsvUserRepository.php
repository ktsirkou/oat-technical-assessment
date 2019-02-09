<?php declare(strict_types=1);

namespace kstirkou\OAT\Repository;

use kstirkou\OAT\Entity\User;
use kstirkou\OAT\Exception\InvalidArgumentException;

/**
 * Class JsonUserRepository
 *
 * @package kstirkou\OAT\Repository
 */
class CsvUserRepository extends AbstractUserRepository
{
    /**
     * @inheritdoc
     *
     * @throws InvalidArgumentException
     */
    public function findAllBy(int $limit, int $offset, string $name = null): array
    {
        $allUsers    = $this->users->getAllUsers();
        $usersCount  = count($allUsers);
        $offset      = ($offset <=0) ? 0 : $offset;
        if ($offset >= $usersCount)
        {
            throw new InvalidArgumentException('offset provided is bigger than total number of users', 400);
        }

        $returnUsers = array_slice($allUsers, $offset, $limit);

        if (!empty($name))
        {
            /** @var User $user */
            foreach ($returnUsers as $index => $user)
            {
                if (!((strpos($user->getLastName(), $name) !== false) || (strpos($user->getFirstName(), $name) !== false)))
                {
                    unset($returnUsers[$index]);
                }
            }

            $returnUsers = array_values($returnUsers);
        }

        return $returnUsers;
    }

    /**
     * @inheritdoc
     */
    public function findBy(string $loginId): ?User
    {
        return $this->users->getById($loginId);
    }
}
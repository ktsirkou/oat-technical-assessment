<?php declare(strict_types=1);

namespace kstirkou\OAT\Repository;

use kstirkou\OAT\Entity\User;

/**
 * Interface UserRepositoryInterface
 *
 * @package kstirkou\OAT\Repository
 */
interface UserRepositoryInterface
{
    /**
     * Get users.
     *
     * @param int         $limit
     * @param int         $offset
     * @param string|null $name
     *
     * @return User[]
     */
   public function findAllBy(int $limit, int $offset, string $name = null): array;

    /**
     * Get single user by loginId.
     *
     * @param string $loginId
     *
     * @return User
     */
   public function findBy(string $loginId): ?User;
}
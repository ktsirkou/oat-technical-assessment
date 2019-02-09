<?php declare(strict_types=1);

namespace kstirkou\OAT\Repository;

use kstirkou\OAT\Entity\User;

/**
 * Class JsonUserRepository
 *
 * @package kstirkou\OAT\Repository
 */
class CsvUserRepository extends AbstractUserRepository
{
    /**
     * @inheritdoc
     */
    public function findAllBy(int $limit, int $offset, string $name = null): array
    {
        // TODO: Implement findAllBy() method.
    }

    /**
     * @inheritdoc
     */
    public function findBy(string $loginId): ?User
    {
        // TODO: Implement getUserBy() method.
    }

}
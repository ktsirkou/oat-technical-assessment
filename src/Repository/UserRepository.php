<?php declare(strict_types=1);

namespace kstirkou\OAT\Repository;

use kstirkou\OAT\Entity\User;
use kstirkou\OAT\Entity\UserCollection;
use kstirkou\OAT\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class UserRepository
 *
 * @package kstirkou\OAT\Repository
 */
class UserRepository implements UserRepositoryInterface
{
    /**
     * @var UserCollection
     */
    protected $users;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * UserRepository constructor.
     *
     * @param SerializerInterface $serializer
     * @param string $resourceDir
     * @param string $resourceFileName
     * @param string $resourceType
     */
    public function __construct(SerializerInterface $serializer, string $resourceDir,  string $resourceFileName, string $resourceType)
    {
        $this->serializer = $serializer;

        $this->loadData($resourceDir, $resourceFileName, $resourceType);
    }

    /**
     * Load data from the resources
     *
     * @param string $resourceDir
     * @param string $resourceFileName
     * @param string $resourceType
     */
    public function loadData(string $resourceDir,  string $resourceFileName, string $resourceType)
    {

        $data        = file_get_contents(__DIR__. $resourceDir . $resourceFileName . '.' . $resourceType);
        $this->users = $this->serializer->deserialize($data, UserCollection::class, $resourceType);
    }

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
            throw new InvalidArgumentException('offset provided is bigger than total number of users');
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
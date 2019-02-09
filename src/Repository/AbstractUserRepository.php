<?php declare(strict_types=1);

namespace kstirkou\OAT\Repository;

use kstirkou\OAT\Entity\UserCollection;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class AbstractUserRepository
 *
 * @package kstirkou\OAT\Repository
 */
abstract class AbstractUserRepository implements UserRepositoryInterface
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
     * AbstractUserRepository constructor.
     *
     * @param SerializerInterface $serializer
     * @param string $resourceType
     */
    public function __construct(SerializerInterface $serializer, string $resourceType)
    {
        $this->serializer = $serializer;

        $this->loadData($resourceType);
    }

    /**
     * Load data from the resources
     *
     * @param string $resourceType
     */
    public function loadData(string $resourceType)
    {
        $data = file_get_contents(__DIR__ . '/../../resources/testtakers.' . $resourceType);
        $this->users = $this->serializer->deserialize($data, UserCollection::class, $resourceType);
    }
}
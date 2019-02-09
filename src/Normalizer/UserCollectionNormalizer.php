<?php declare(strict_types=1);

namespace kstirkou\OAT\Normalizer;

use kstirkou\OAT\Entity\User;
use kstirkou\OAT\Entity\UserCollection;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * Class UserCollectionNormalizer
 *
 * @package kstirkou\OAT\Normalizer
 */
class UserCollectionNormalizer implements NormalizerInterface, DenormalizerInterface
{
    private $normalizer;

    public function __construct(ObjectNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    /**
     * @inheritdoc
     */
    public function normalize($data, $format = null, array $context = [])
    {
        $userArray = [];
        /** @var User $user */
        foreach ($data as $user) {
            $userArray[] = [
                'login'     => $user->getLogin(),
                'title'     => $user->getTitle(),
                'firstname' => $user->getFirstName(),
                'lastname'  => $user->getLastName(),
                'gender'    => $user->getGender(),
                'email'     => $user->getEmail(),
                'picture'   => $user->getPictures(),
                'address'   => $user->getAddress(),
            ];
        }
        return $userArray;
    }

    /**
     * @inheritdoc
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof UserCollection;
    }

    /**
     * @inheritdoc
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $usersList      = [];
        $userCollection = new UserCollection();
        foreach ($data as $user) {
            $usersList[] = new User(
                $user['login'],
                $user['password'],
                $user['title'],
                $user['lastname'],
                $user['firstname'],
                $user['gender'],
                $user['email'],
                $user['picture'],
                $user['address']
            );
        }
        return $userCollection->setUsers($usersList);
    }

    /**
     * @inheritdoc
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type == UserCollection::class;
    }
}
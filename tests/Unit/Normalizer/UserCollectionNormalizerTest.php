<?php declare(strict_types=1);

namespace kstirkou\OAT\Test\Unit\Normalizer;

use kstirkou\OAT\Entity\User;
use kstirkou\OAT\Entity\UserCollection;
use kstirkou\OAT\Normalizer\UserCollectionNormalizer;
use PHPUnit\Framework\TestCase;

/**
 * Class UserCollectionNormalizerTest
 *
 * @package kstirkou\OAT\Test\Unit\Normalizer
 */
class UserCollectionNormalizerTest extends TestCase
{
    /** @var UserCollectionNormalizer */
   private $normalizer;

   public function setUp(): void
   {
       $this->normalizer = new UserCollectionNormalizer();

       parent::setUp();
   }

    /**
     * @covers \kstirkou\OAT\Normalizer\UserCollectionNormalizer::normalize
     * @covers \kstirkou\OAT\Entity\User::__construct
     * @covers \kstirkou\OAT\Entity\UserCollection::setUsers
     */
   public function testSuccessNormalization()
   {
       $user = new User(
           'testId',
            'paswww',
           'Mr',
           'test',
           'doe',
           'john@example.com',
           'male',
           'cdnUrl',
           'street number 23'
       );

       $userCollection = new UserCollection();
       $userCollection->setUsers([$user]);

       $normalizedUsers = $this->normalizer->normalize($userCollection);

       //Password should no be on the return fields
       $this->assertFalse(array_key_exists('password', $normalizedUsers[0]));

       $this->assertEquals('testId', $normalizedUsers[0]['login']);
       $this->assertEquals('Mr', $normalizedUsers[0]['title']);
       $this->assertEquals('test', $normalizedUsers[0]['firstname']);
       $this->assertEquals('doe', $normalizedUsers[0]['lastname']);
       $this->assertEquals('john@example.com', $normalizedUsers[0]['email']);
       $this->assertEquals('male', $normalizedUsers[0]['gender']);
       $this->assertEquals('cdnUrl', $normalizedUsers[0]['picture']);
       $this->assertEquals('street number 23', $normalizedUsers[0]['address']);
   }

    /**
     * @covers \kstirkou\OAT\Normalizer\UserCollectionNormalizer::denormalize
     */
   public function testSuccessDenormalization()
   {
       $userData = <<<EOF
[
  {
    "login":"testId",
    "password":"paswww",
    "title":"Mr",
    "lastname":"test",
    "firstname":"doe",
    "gender":"male",
    "email":"john@example.com",
    "picture":"cdnUrl",
    "address":"street number 23"
  }
]
EOF;
       $userCollection = $this->normalizer->denormalize(json_decode($userData, true), UserCollection::class);

       $this->assertInstanceOf(UserCollection::class, $userCollection);
   }
}
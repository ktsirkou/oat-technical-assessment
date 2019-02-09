<?php declare(strict_types=1);

namespace kstirkou\OAT\Test\Unit\Entity;

use kstirkou\OAT\Entity\User;
use kstirkou\OAT\Entity\UserCollection;
use PHPUnit\Framework\TestCase;

class UserCollectionTest extends TestCase
{
    /**
     * @var UserCollection
     */
    private $userCollection;

    public function setUp(): void
    {
        $this->userCollection = new UserCollection();

        parent::setUp();
    }

    /**
     * @covers \kstirkou\OAT\Entity\UserCollection::setUsers
     * @covers \kstirkou\OAT\Entity\UserCollection::getById
     * @covers \kstirkou\OAT\Entity\User::__construct
     */
    public function testSetAndFindUsers()
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

        $this->userCollection = new UserCollection();
        $this->userCollection->setUsers([$user]);

       $inserteUser = $this->userCollection->getById('testId');

       $this->assertInstanceOf(User::class, $inserteUser);
       $this->assertSame($user, $inserteUser);
    }

    /**
     * @covers \kstirkou\OAT\Entity\UserCollection::setUsers
     * @covers \kstirkou\OAT\Entity\UserCollection::getAllUsers
     * @covers \kstirkou\OAT\Entity\User::__construct
     */
    public function testGetAllUsers()
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

        $user2 = new User(
            'testId2',
            'paswww2',
            'Mr2',
            'tes2t',
            'doe2',
            'john22@example.com',
            'male2',
            'cdnUrl2',
            'street number 232'
        );

        $this->userCollection = new UserCollection();
        $this->userCollection->setUsers([$user, $user2]);

        $userArray = $this->userCollection->getAllUsers();

        $this->assertEquals(2, count($userArray));
    }
}
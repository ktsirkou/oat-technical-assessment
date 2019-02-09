<?php declare(strict_types=1);

namespace kstirkou\OAT\Test\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class UserControllerTest
 *
 * @package kstirkou\OAT\Test\Functional\Controller
 */
class UserControllerTest extends WebTestCase
{
    /**
     * @covers \kstirkou\OAT\Controller\UserController::getUser
     * @covers \kstirkou\OAT\Service\UserService::getUser
     */
    public function testGetUserNotFound()
    {
        $client = static::createClient();

        $client->request('GET', '/v1/users/dummyUser');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    /**
     * @covers \kstirkou\OAT\Controller\UserController::getUser
     * @covers \kstirkou\OAT\Service\UserService::getUser
     */
    public function testGetUser()
    {
        $client = static::createClient();

        $client->request('GET', 'v1/users/grahamallison');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * @covers \kstirkou\OAT\Controller\UserController::getUsers
     * @covers \kstirkou\OAT\Service\UserService::getUsers
     */
    public function testGetUsersAllWithDefaultQueryParams()
    {
        $client = static::createClient();

        $client->request('GET', 'v1/users');
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $responseData = json_decode($response->getContent(), true);

        $this->assertEquals(100, count($responseData));
    }

    /**
     * @covers \kstirkou\OAT\Controller\UserController::getUsers
     * @covers \kstirkou\OAT\Service\UserService::getUsers
     */
    public function testGetAllUsersWithValidOffset()
    {
        $client = static::createClient();

        $client->request('GET', 'v1/users?offset=50');
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $responseData = json_decode($response->getContent(), true);

        $this->assertEquals(50, count($responseData));
    }

    /**
     * @covers \kstirkou\OAT\Controller\UserController::getUsers
     * @covers \kstirkou\OAT\Service\UserService::getUsers
     */
    public function testGetAllUsersWithInValidOffset()
    {
        $client = static::createClient();

        $client->request('GET', 'v1/users?offset=446');
        $response = $client->getResponse();
        $this->assertEquals(400, $response->getStatusCode());
        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals('offset provided is bigger than total number of users', $responseData['message']);
    }

    /**
     * @covers \kstirkou\OAT\Controller\UserController::getUsers
     * @covers \kstirkou\OAT\Service\UserService::getUsers
     */
    public function testGetAllUsersWithLimitParam()
    {
        $client = static::createClient();

        $client->request('GET', 'v1/users?limit=2');
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $responseData = json_decode($response->getContent(), true);

        $this->assertEquals(2, count($responseData));
    }

    /**
     * @covers \kstirkou\OAT\Controller\UserController::getUsers
     * @covers \kstirkou\OAT\Service\UserService::getUsers
     */
    public function testGetAllUsersWithNameParamFilteringNotFound()
    {
        $client = static::createClient();

        $client->request('GET', 'v1/users?name=test123');
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $responseData = json_decode($response->getContent(), true);

        $this->assertEquals(0, count($responseData));
    }

    /**
     * @covers \kstirkou\OAT\Controller\UserController::getUsers
     * @covers \kstirkou\OAT\Service\UserService::getUsers
     */
    public function testGetAllUsersWithNameParamFilteringFound()
    {
        $client = static::createClient();

        $client->request('GET', 'v1/users?name=kim');
        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $responseData = json_decode($response->getContent(), true);

        $this->assertEquals(2, count($responseData));
    }

    /**
     * @covers \kstirkou\OAT\Controller\UserController::getUsers
     * @covers \kstirkou\OAT\Service\UserService::getUsers
     */
    public function testGetAllWithInvalidRegexLimitParam()
    {
        $client = static::createClient();

        $client->request('GET', 'v1/users?limit=test');
        $response = $client->getResponse();
        $this->assertEquals(400, $response->getStatusCode());

        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals("Parameter \"limit\" of value \"test\" violated a constraint \"Parameter 'limit' value, does not match requirements '\\d+'\"", $responseData['message']);
    }

    /**
     * @covers \kstirkou\OAT\Controller\UserController::getUsers
     * @covers \kstirkou\OAT\Service\UserService::getUsers
     */
    public function testGetAllWithInvalidRegexNameParam()
    {
        $client = static::createClient();

        $client->request('GET', 'v1/users?name=test!!');
        $response = $client->getResponse();
        $this->assertEquals(400, $response->getStatusCode());

        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals("Parameter \"name\" of value \"test!!\" violated a constraint \"Parameter 'name' value, does not match requirements '[a-zA-z0-9]+'\"", $responseData['message']);
    }
}
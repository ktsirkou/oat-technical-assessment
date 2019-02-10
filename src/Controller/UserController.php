<?php declare(strict_types=1);

namespace kstirkou\OAT\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\View\View;
use kstirkou\OAT\Entity\User;
use kstirkou\OAT\Service\UserService;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserController
 *
 * @package kstirkou\OAT\Controller
 */
class UserController extends AbstractFOSRestController
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * UserController
     *
     * @param $userService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Return a user
     *
     * @Get("/v1/users/{userId}")
     *
     * @param string $userId
     * @return View
     */
    public function getSingleUser(string $userId): View
    {
        $user = $this->userService->getUser($userId);

        return View::create($user, Response::HTTP_OK);
    }

    /**
     * Return a user
     * @QueryParam(name="limit", description="limit of users returned", requirements="\d+", default=100, nullable=true, strict=true)
     * @QueryParam(name="offset", description="starting index on gettin the users", requirements="\d+", default=0, nullable=true, strict=true)
     * @QueryParam(name="name", description="filter on firstname laster", requirements="[a-zA-z0-9]+", nullable=true, strict=true)
     * @Get("/v1/users")
     *
     * @param int    $limit
     * @param int    $offset
     * @param string $name
     *
     * @return View
     */
    public function getUsers($limit = null, $offset = null , $name = null): View
    {;
        $userList = $this->userService->getUsers((int)$limit, (int)$offset, $name);

        return View::create($userList, Response::HTTP_OK);
    }
}
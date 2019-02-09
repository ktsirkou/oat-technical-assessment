<?php declare(strict_types=1);

namespace kstirkou\OAT\Service;

use kstirkou\OAT\Entity\User;
use kstirkou\OAT\Repository\AbstractUserRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserService
{
    /**
     * @var AbstractUserRepository
     */

    protected $userRepository;
    /**
     * UserService constructor.
     *
     * @param AbstractUserRepository $userRepository
     */
    public function __construct(AbstractUserRepository $userRepository){
        $this->userRepository = $userRepository;
    }
    /**
     * @param string $loginId
     * @return User
     *
     * @throws NotFoundHttpException
     */
    public function getUser(string $loginId): User
    {
        $user = $this->userRepository->findBy($loginId);
        if (!$user) {
            throw new NotFoundHttpException('User with loginId '.$loginId.' does not exist!');
        }

        return $user;
    }

    /**
     * @param int         $limit
     * @param int         $offset
     * @param string|null $name
     *
     * @return array
     */
    public function getUsers(int $limit, int $offset, string $name = null):array
    {
        return $this->userRepository->findAllBy($limit, $offset, $name);
    }
}
<?php //declare(strict_types=1);
//
//namespace kstirkou\OAT\Test\Unit\Service;
//
//use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
//
//class UserServiceTest extends WebTestCase
//{
//    private function getUsers()
//    {
//        self::bootKernel();
//
//        // returns the real and unchanged service container
//        $container = self::$kernel->getContainer();
//
//        // gets the special container that allows fetching private services
//        $container = self::$container;
//
//        $user = self::$container->get('AbstractUserRepository')->getRepository(User::class)->findOneByEmail('...');
//        $this->assertTrue(self::$container->get('security.password_encoder')->isPasswordValid($user, '...');
//        // ...
//    }
//}
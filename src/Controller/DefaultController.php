<?php declare(strict_types=1);

namespace kstirkou\OAT\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class UserController
 *
 * @package kstirkou\OAT\Controller
 */
class DefaultController extends AbstractFOSRestController
{

    public function index(): View
    {
        return View::create('Welcome to oat api, please user v1 routing!', Response::HTTP_OK);
    }
}
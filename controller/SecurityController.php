<?php

namespace PulpFiction\controller;

use PulpFiction\core\BaseController\Controller;
use PulpFiction\model\User;
use PulpFiction\services\IService\UserServiceInterface;

class SecurityController extends Controller
{
    /**
     * @var UserServiceInterface $userService
     */
    public $userService;

    /**
     * User constructor.
     * @param UserServiceInterface $userService
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
        parent::__construct();
    }

    public function login()
    {

    }

    public function register()
    {
        $user = new User();
        return $this->render('/user/create', compact('user'));
    }

    public function logout()
    {

    }
}
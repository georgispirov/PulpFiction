<?php

namespace PulpFiction\controller;

use PulpFiction\core\BaseController\web\Controller;
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
        if ($this->getRequest()->isPostRequest()) {
            print_r($_POST);
        }
        return $this->render('/user/create');
    }

    public function logout()
    {

    }
}
<?php

namespace PulpFiction\controller;

use PulpFiction\core\BaseController\web\Controller;
use PulpFiction\models\UsersDTO;
use PulpFiction\services\UserService;

class SecurityController extends Controller
{
    /**
     * @var UserService $userService
     */
    public $userService;

    /**
     * User constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        parent::__construct();
    }

    public function login()
    {

    }

    public function register()
    {
//        $user = new UsersDTO();
        if ($this->getRequest()->isPostRequest()) {
            print_r($_POST);
        }
        return $this->render('/user/create');
    }

    public function logout()
    {

    }
}
<?php

namespace PulpFiction\controller;

use PulpFiction\core\BaseController\web\Controller;
use PulpFiction\model\Users;
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
        $model = Users::findAllAsArray();
        var_dump($model);
        if ($this->getRequest()->isPostRequest()) {
            print_r($_POST);
        }
        return $this->render('/user/registration', compact('model'));
    }

    public function logout()
    {

    }
}
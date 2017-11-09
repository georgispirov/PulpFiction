<?php

namespace softuni\controller;

use softuni\core\Controller;
use softuni\core\HttpHandler\Request;
use softuni\core\service\User\UserService;
use softuni\model\User;

class UsersController extends Controller
{
    public function edit(int $id)
    {

    }

    public function register()
    {
        $this->render('user/create');
        $params = 'username|first_name|password|re_password';
        $request = new Request();
        if ($this->inPost($params, $_POST) === true && $request->isPostRequest()) {
            $confirmPassword = $_POST['re_password'];
            $user = new User();
            $user = $user->loadData($_POST);
            UserService::register($user, $confirmPassword);
        }
    }

    public function login()
    {

    }
}
<?php

namespace softuni\controller;

use PulpFiction\core\Controller;
use PulpFiction\core\HttpHandler\Request;
use PulpFiction\core\service\User\UserService;
use PulpFiction\model\User;

class UsersController extends Controller
{
    /**
     * @var UserService
     */
    private $_userService;

    public function edit(int $id)
    {
        $user = null;
        if (($user = User::findByID($id)) instanceof User) {
            return $this->render('user/edit', compact('user'));
        }
        return false;
    }

    public function register()
    {
        $user = new User(); /* @var User $user */
        $request = new Request(); /* @var Request $request */
        $this->_userService = new UserService();
        $params = $this->_userService->getClassAttributeNames($user, 'id');
        if ($this->inPost('create_user', $_POST) && $request->isPostAjaxRequest()) {
            $post = $this->getPostDataFromForm($_POST['create_user']);
            if ($this->inPost($params, $post) === true) {
                $user = $user->loadData($post);
                if ($this->_userService->register($user) === true) {
                    $message = 'You have successfully created the user with username: ' . $user->getUsername();
                    echo json_encode($message);
                }
                $this->_userService->displayErrors($user);
                return $this->redirect('users/register');
            }
        }
        return $this->render('user/create');
    }

    public function login()
    {

    }
}
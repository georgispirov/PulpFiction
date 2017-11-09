<?php

namespace softuni\core\service\User;

use softuni\core\services\User\UserServiceInterface;
use softuni\model\User;

class UserService implements UserServiceInterface
{
    public static function register(User $user, $confirmPassword)
    {
        if ($confirmPassword !== $user->getPassword()) {
            return false;
        }

        $user->create($user);
    }

    public function login(string $username, string $password): bool
    {

    }

    public function editProfile(User $user): bool
    {
        return $user->update($user);
    }

    public function viewAll(): \Generator
    {

    }

    public function isLogged(): bool
    {

    }

    public function getCurrentUser(): User
    {

    }
}
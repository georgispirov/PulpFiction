<?php

namespace softuni\core\services\User;

use softuni\model\User;

interface UserServiceInterface
{
    public static function register(User $user, $confirmPassword);

    public function login(string $username, string $password): bool;

    public function editProfile(User $user): bool;

    public function viewAll(): \Generator;

    public function isLogged(): bool;

    public function getCurrentUser(): User;
}
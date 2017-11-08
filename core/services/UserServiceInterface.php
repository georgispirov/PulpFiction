<?php

namespace softuni\core\services;

use softuni\core\Model;

interface UserServiceInterface
{
    public function register(Model $user, $confirmPassword): bool;

    public function login(string $username, string $password): bool;

    public function editProfile(int $id, Model $user): bool;

    public function viewAll(): \Generator;

    public function isLogged(): bool;

    public function getCurrentUser(): Model;
}
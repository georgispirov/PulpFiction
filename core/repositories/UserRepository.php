<?php

namespace softuni\core\repositories;

use softuni\model\User;

interface UserRepository
{
    public function update(User $user): bool;

    public function create(User $user): bool;

    public function delete(User $user): bool;
}
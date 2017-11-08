<?php

namespace softuni\core\repositories;

use softuni\core\Model;

interface UserRepositoryInterface
{
    public function update(Model $user): bool;

    public function insert(Model $user): bool;

    public function delete(Model $user): bool;
}
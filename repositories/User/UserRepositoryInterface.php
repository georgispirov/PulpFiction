<?php

namespace PulpFiction\core\Repositories;

interface UserRepositoryInterface
{
    public function update($user): bool;

    public function create($user): bool;

    public function delete($user): bool;
}
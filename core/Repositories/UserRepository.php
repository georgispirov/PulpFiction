<?php

namespace PulpFiction\core\Repositories;

interface UserRepository
{
    public function update($user): bool;

    public function create($user): bool;

    public function delete($user): bool;
}
<?php

namespace PulpFiction\repositories\User;

interface UserRepositoryInterface
{
    public function update($user): bool;

    public function create($user): bool;

    public function delete($user): bool;
}
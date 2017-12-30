<?php

namespace PulpFiction\core\validators;

use PulpFiction\model\User;

interface UserValidator
{
    public function validatePassword(User $user): bool;

    public function validateConfirmPassword(User $user): bool;

    public function comparePasswords(User $user);

    public function validateUsername(User $user): bool;
}

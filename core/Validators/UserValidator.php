<?php

namespace PulpFiction\core\Validators;

interface UserValidator
{
    public function validatePassword($user): bool;

    public function validateConfirmPassword($user): bool;

    public function comparePasswords($user);

    public function validateUsername($user): bool;
}

<?php

namespace PulpFiction\services;

use PulpFiction\models\UsersDTO\UsersDTO;
use PulpFiction\repositories\UserRepository;
use ReflectionObject;

class UserService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    const ERROR_EXISTING_USER          = 'User with this username already exists!'   . PHP_EOL;
    const ERROR_EMPTY_PASSWORD         = 'Password cannot be blank!'                 . PHP_EOL;
    const ERROR_EMPTY_CONFIRM_PASSWORD = 'Confirm Password cannot be blank!'         . PHP_EOL;
    const ERROR_PASSWORDS_MISMATCHED   = 'Password and Confirm Password mismatched!' . PHP_EOL;
    const ERROR_EMPTY_USERNAME         = 'Username cannot be blank!'                 . PHP_EOL;

    public function register(UsersDTO $user)
    {

    }

    public function login(string $username, string $password): bool
    {

        return false;
    }

    public function editProfile(UsersDTO $user): bool
    {

    }

    public function viewAll(): \TableGenerator
    {

    }

    public function isLogged(): bool
    {

    }

    public function getCurrentUser(): UsersDTO
    {

    }

    public function validatePassword(UsersDTO $user): bool
    {
        if ($user->getPassword() === null) {
            $user->addError(self::ERROR_EMPTY_PASSWORD);
            return false;
        }
        return true;
    }

    public function validateConfirmPassword(User $user): bool
    {
        if ($user->getRePassword() === null) {
            $user->addError(self::ERROR_EMPTY_CONFIRM_PASSWORD);
            return false;
        }
        return true;
    }

    public function comparePasswords(User $user)
    {
        if ($user->getPassword() !== $user->getRePassword()) {
            $user->addError(self::ERROR_PASSWORDS_MISMATCHED);
            return false;
        }
        return true;
    }

    public function validateUsername(User $user): bool
    {
        if ($user->getUsername() === null) {
            $user->addError(self::ERROR_EMPTY_USERNAME);
            return false;
        }
        return true;
    }

    public function getClassAttributeNames(User $user, string $exclude = null): string
    {
        $reflection = new ReflectionObject($user);
        $properties = array_keys($reflection->getDefaultProperties());
        if (isset($exclude)) {
            $key = array_search($exclude, $properties);
            unset($properties[$key]);
        }
        return implode('|', $properties);
    }

    public function displayErrors(User $user)
    {
        if ($user->hasErrors()) {
            foreach ($user->getErrors() as $error) {
                echo json_encode($error);
            }
        }
    }
}
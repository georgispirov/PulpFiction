<?php

namespace PulpFiction\services;

use PulpFiction\repositories\User\UserRepositoryInterface;
use PulpFiction\services\IService\UserServiceInterface;
use ReflectionObject;
use PulpFiction\model\User;

class UserService implements UserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * UserService constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    const ERROR_EXISTING_USER          = 'User with this username already exists!'   . PHP_EOL;
    const ERROR_EMPTY_PASSWORD         = 'Password cannot be blank!'                 . PHP_EOL;
    const ERROR_EMPTY_CONFIRM_PASSWORD = 'Confirm Password cannot be blank!'         . PHP_EOL;
    const ERROR_PASSWORDS_MISMATCHED   = 'Password and Confirm Password mismatched!' . PHP_EOL;
    const ERROR_EMPTY_USERNAME         = 'Username cannot be blank!'                 . PHP_EOL;

    /**
     * @param User $user
     * @return bool
     */
    public function register(User $user)
    {

    }

    public function login(string $username, string $password): bool
    {

        return false;
    }

    public function editProfile(User $user): bool
    {

    }

    public function viewAll(): \Generator
    {

    }

    public function isLogged(): bool
    {

    }

    public function getCurrentUser(): User
    {

    }

    public function validatePassword(User $user): bool
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
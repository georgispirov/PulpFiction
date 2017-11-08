<?php

namespace softuni\model;

use softuni\core\Model;
use softuni\core\queries\QueryInterface;
use softuni\core\services\UserServiceInterface;

class User extends Model implements UserServiceInterface
{
    /**
     * @var int $id
     */
    public $id;

    /**
     * @var string $username
     */
    public $username;

    /**
     * @var string $email
     */
    public $email;

    /**
     * @var string $first_name
     */
    public $first_name;

    /**
     * @var string $last_name
     */
    public $last_name;

    public static function findAll(): array
    {
        return self::find()->where([])->all();
    }

    /**
     * @param int $id
     * @return boolean|Model
     */
    public static function findByID(int $id)
    {
        return self::find()->where(['id' => $id])->one();
    }

    /**
     * @param string $username
     * @return bool|Model
     */
    public static function findOneByUsername(string $username)
    {
        return self::find()->where(['username' => $username])->one();
    }

    public static function find(): QueryInterface
    {
        return new \softuni\core\queries\UserQuery(get_called_class());
    }

    public function register(Model $user, $confirmPassword): bool
    {

    }

    public function login(string $username, string $password): bool
    {

    }

    public function editProfile(int $id, Model $user): bool
    {

    }

    public function viewAll(): \Generator
    {

    }

    public function isLogged(): bool
    {

    }

    public function getCurrentUser(): Model
    {

    }
}
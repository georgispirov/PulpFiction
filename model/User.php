<?php

namespace softuni\model;

use softuni\core\Model;
use softuni\core\queries\QueryInterface;
use softuni\core\repositories\UserRepository;
use softuni\DatabaseConnection\ResultSetInterface;

class User extends Model implements UserRepository
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
     * @var string $first_name
     */
    public $first_name;

    /**
     * @var string $password
     */
    public $password;

    /**
     * @var string $re_password
     */
    public $re_password;

    public static function findAll(): array
    {
        return self::find()->where([])->all();
    }

    /**
     * @param int $id
     * @return boolean|User
     */
    public static function findByID(int $id)
    {
        return self::find()->where(['id' => $id])->one();
    }

    /**
     * @param string $username
     * @return bool|User
     */
    public static function findOneByUsername(string $username)
    {
        return self::find()->where(['username' => $username])->one();
    }

    public static function find(): QueryInterface
    {
        return new \softuni\core\queries\UserQuery(get_called_class());
    }

    public function update(User $user): bool
    {

    }

    public function create(User $user): bool
    {
        $sql = 'INSERT INTO 
                user (first_name, username, password, re_password) 
                VALUES (:first_name, :username, :password, :re_password)';

        $params = [
            ':first_name'  => $user->getFirstName(),
            ':username'    => $user->getUsername(),
            ':password'    => $user->getPassword(),
            ':re_password' => $user->getRePassword()
        ];

        $query = $this->getDb()
                      ->query($sql)
                      ->execute($params);

        if ($query instanceof ResultSetInterface) {
            return true;
        }
        return false;
    }

    public function delete(User $user): bool
    {

    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getRePassword(): string
    {
        return $this->re_password;
    }
}
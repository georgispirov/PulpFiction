<?php

namespace softuni\core;

use softuni\core\queries\QueryInterface;

abstract class Model
{
	abstract public static function find(): QueryInterface;

	abstract public static function findAll(): array;

    /**
     * @param int $id
     * @return boolean|Model
     */
	abstract public static function findByID(int $id);

    /**
     * @param string $username
     * @return boolean|Model
     */
	abstract public static function findOneByUsername(string $username);

	public static function className(): string
    {
        return get_called_class();
    }

    public static function tableName(): string
    {
        $className = self::className();
        $exploded = explode('\\', $className);
        return strtolower(end($exploded));
    }
}
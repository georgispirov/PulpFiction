<?php

namespace softuni\core;

use ReflectionClass;
use softuni\core\queries\QueryInterface;
use softuni\DatabaseConnection\DatabaseInterface;

abstract class Model
{
    protected function getDb()
    {
        if (Application::getDb() instanceof DatabaseInterface) {
            return Application::getDb();
        }
    }

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

    public function loadData(array $post)
    {
        $class = new ReflectionClass(get_called_class());
        $className = $class->getName();
        $model = new $className();
        foreach ($post as $name => $value) {
            if ($class->hasProperty($name)) {
                $property = $class->getProperty($name);
                $property->setAccessible(true);
                $property->setValue($model, $value);
            }
        }
        return $model;
    }
}
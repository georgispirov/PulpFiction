<?php

namespace softuni\core;

use ReflectionClass;
use softuni\core\queries\QueryInterface;
use softuni\DatabaseConnection\DatabaseInterface;

abstract class Model
{
    private $_errors;

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

    public function hasErrors(): bool
    {
        if (!empty($this->_errors)) {
            return true;
        }
        return false;
    }

    public function addErrors(array $errors): bool
    {
        if (is_array($errors) && !empty($errors)) {
            foreach ($errors as $error) {
                $this->_errors[] = $error;
                return true;
            }
        }
        return false;
    }

    public function addError(string $error): bool
    {
        if (!empty($error)) {
            $this->_errors[] = $error;
            return true;
        }
        return false;
    }

    public function getErrors(): array
    {
        return $this->_errors;
    }
}
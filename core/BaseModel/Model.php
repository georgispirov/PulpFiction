<?php

namespace PulpFiction\core\BaseModel;

use PulpFiction\core\App\Application;
use ReflectionClass;
use PulpFiction\DatabaseConnection\DatabaseInterface;

abstract class Model
{
    /**
     * @var array $_errors
     */
    private $_errors;

    /**
     * @return null|DatabaseInterface
     */
    protected function getDb()
    {
        if (Application::getDb() instanceof DatabaseInterface) {
            return Application::getDb();
        }
        return null;
    }

    /**
     * @return string
     */
	public static function className(): string
    {
        return get_called_class();
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        $className = self::className();
        $exploded = explode('\\', $className);
        return strtolower(end($exploded));
    }

    /**
     * @param array $post
     * @return mixed
     */
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

    /**
     * @return bool
     */
    public function hasErrors(): bool
    {
        if ( !empty($this->_errors) ) {
            return true;
        }
        return false;
    }

    /**
     * @param array $errors
     * @return bool
     */
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

    /**
     * @param string $error
     * @return bool
     */
    public function addError(string $error): bool
    {
        if ( !empty($error) ) {
            $this->_errors[] = $error;
            return true;
        }
        return false;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->_errors;
    }
}
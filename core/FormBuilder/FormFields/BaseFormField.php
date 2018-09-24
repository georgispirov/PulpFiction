<?php

namespace PulpFiction\core\FormBuilder\FormFields;

use ActiveRecord\Model;
use ReflectionClass;

abstract class BaseFormField
{
    /**
     * @var string $_formName
     */
    protected $_formName;

    /**
     * @param Model $model
     * @return string
     */
    protected function getModelFormPrefix(Model $model)
    {
        return (new ReflectionClass($model))->getShortName();
    }
}

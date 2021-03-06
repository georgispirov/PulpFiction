<?php

namespace PulpFiction\core\FormBuilder\FormFields;

use PulpFiction\core\ActiveRecord\ActiveRecord;
use ReflectionClass;

abstract class BaseFormField
{
    /**
     * @var string $_formName
     */
    protected $_formName;

    /**
     * @var string $_attribute
     */
    protected $_attribute;

    /**
     * @param ActiveRecord $model
     * @return string
     */
    protected function getModelFormPrefix(ActiveRecord $model)
    {
        return (new ReflectionClass($model))->getShortName();
    }
}

<?php

namespace PulpFiction\core\FormBuilder\FormFields;

use PulpFiction\model\base\BaseDTO;
use ReflectionClass;

abstract class BaseFormField
{
    /**
     * @var string $_formName
     */
    protected $_formName;

    /**
     * @param BaseDTO $model
     * @return string
     */
    protected function getModelFormPrefix(BaseDTO $model)
    {
        return (new ReflectionClass($model))->getShortName();
    }
}

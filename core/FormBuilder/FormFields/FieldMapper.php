<?php

namespace PulpFiction\core\FormBuilder\FormFields;

use PulpFiction\core\ActiveRecord\ActiveRecord;

class FieldMapper
{
    /**
     * @var ActiveRecord $_model
     */
    private $_model;

    /**
     * @var string $_attribute
     */
    private $_attribute;

    /**
     * FieldMapper constructor.
     * @param ActiveRecord $model
     * @param string $attribute
     */
    public function __construct(ActiveRecord $model,
                                string $attribute)
    {
        $this->_model = $model;
        $this->_attribute = $attribute;
    }

    public function dropDownList(array $items,
                                 string $selected)
    {
        return new DropDownList($items, $selected, $this->_model);
    }
}
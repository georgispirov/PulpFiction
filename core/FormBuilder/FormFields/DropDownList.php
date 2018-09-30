<?php

namespace PulpFiction\core\FormBuilder\FormFields;

use PulpFiction\core\ActiveRecord\ActiveRecord;

class DropDownList extends BaseFormField
{
    /**
     * @var array $_items
     */
    private $_items;

    /**
     * DropDownList constructor.
     * @param array $items
     * @param string $selected
     * @param ActiveRecord $model
     * @param string $attribute
     */
    public function __construct(array $items,
                                string $selected = '',
                                ActiveRecord $model,
                                string $attribute)
    {
        $this->_formName = $this->getModelFormPrefix($model);
        $this->_items    = $items;
        $this->_attribute = $attribute;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $items = '';

        foreach ($this->generateSelectTag($this->_items, $this->_formName) as $item) {
            $items .= $item;
        }

        $modelFieldAttribute = $this->_formName . '[' . $this->_attribute . ']';
        return '<select name=' . $modelFieldAttribute . '>' . $items . '</select>';
    }

    private function generateSelectTag(array $items,
                                       string $formName)
    {
        foreach ($items as $item) {
            yield <<<HTML
            <option id="{$item['id']}" value="{$item['value']}">{$item['value']}</option>
HTML;
        }
    }
}
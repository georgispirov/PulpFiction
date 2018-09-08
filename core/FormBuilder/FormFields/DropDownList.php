<?php

namespace PulpFiction\core\FormBuilder\FormFields;

use PulpFiction\model\base\BaseDTO;

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
     * @param BaseDTO $model
     */
    public function __construct(array $items,
                                string $selected = '',
                                BaseDTO $model)
    {
        $this->_formName = $this->getModelFormPrefix($model);
        $this->_items    = $items;
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

        return "<select>{$items}</select>";
    }

    private function generateSelectTag(array $items,
                                       string $formName)
    {
        foreach ($items as $item) {
            yield <<<HTML
            <option id="{$item['id']}" name="{$formName}[{$item['value']}]" value="{$item['value']}">{$item['value']}</option>
HTML;
        }
    }
}
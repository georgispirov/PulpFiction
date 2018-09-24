<?php

namespace PulpFiction\core\FormBuilder;

use ActiveRecord\Model;
use PulpFiction\core\FormBuilder\FormFields\DropDownList;
use PulpFiction\core\PulpFiction;

class FormBuilder
{
    /**
     * @param array $options
     * @return FormBuilder
     */
    public static function beginForm(array $options = [])
    {
        $controller = PulpFiction::$app->getController();
        $method = $options['method'] ?? 'POST';
        $action = $options['action'] ?? $controller->getCurrentUrl();

        echo '<form action="' . $action . '" method="' . $method . '"/>';

        return new self();
    }

    public function textField()
    {
        return new TextField();
    }

    /**
     * @param Model $model
     * @param array $items
     * @param string $selected
     * @return DropDownList
     */
    public function dropDownList(Model $model,
                                 array $items,
                                 string $selected = '')
    {
        return new DropDownList($items,
                                $selected,
                                $model);
    }
    
    public static function endForm()
    {
        return '</form>';
    }
}
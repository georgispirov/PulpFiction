<?php

namespace PulpFiction\core\FormBuilder;

use PulpFiction\core\ActiveRecord\ActiveRecord;
use PulpFiction\core\FormBuilder\FormFields\FieldMapper;
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

    public static function endForm()
    {
        return '</form>';
    }

    public function field(ActiveRecord $model,
                          string $attribute)
    {
        return new FieldMapper($model, $attribute);
    }
}
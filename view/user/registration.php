<?php

/**
 * @var Model $model
 */

use PulpFiction\core\FormBuilder\FormBuilder;
use ActiveRecord\Model;

$form = FormBuilder::beginForm();

echo $form->dropDownList($model, [
    ['id' => 1, 'value' => 'George'],
    ['id' => 2, 'value' => 'Sp'],
], '');
var_dump($model->to_array());
FormBuilder::endForm();
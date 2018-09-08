<?php

/**
 * @var BaseDTO $model
 */

use PulpFiction\core\FormBuilder\FormBuilder;
use PulpFiction\model\base\BaseDTO;

$form = FormBuilder::beginForm();

echo $form->dropDownList($model, [
    ['id' => 1, 'value' => 'George'],
    ['id' => 2, 'value' => 'Sp'],
], '');

FormBuilder::endForm();
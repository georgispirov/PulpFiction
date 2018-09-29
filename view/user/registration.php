<?php

/**
 * @var ActiveRecord $model
 */

use PulpFiction\core\ActiveRecord\ActiveRecord;
use PulpFiction\core\FormBuilder\FormBuilder;
use PulpFiction\model\City;

$form = FormBuilder::beginForm();

$cities = City::findAllAsArray();

var_dump($cities);

echo $form->field($model, '')->dropDownList();

FormBuilder::endForm();
<?php

/**
 * @var ActiveRecord $model
 */

use PulpFiction\core\ActiveRecord\ActiveRecord;
use PulpFiction\core\FormBuilder\FormBuilder;
use PulpFiction\core\Helpers\ArrayHelper;
use PulpFiction\model\City;

$form = FormBuilder::beginForm();

$cities = ArrayHelper::buildHashMapForDropDownList(City::findAllAsArray(), 'id', 'name');

echo $form->field($model, 'city_id')->dropDownList($cities);

FormBuilder::endForm();
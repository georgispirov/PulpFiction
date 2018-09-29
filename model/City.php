<?php

namespace PulpFiction\model;

use PulpFiction\core\ActiveRecord\ActiveRecord;

class City extends ActiveRecord
{
    public static $table_name = 'city';

    /**
    * @var int $id 
    */
    public $id;

    /**
    * @var  $name 
    */
    public $name;

} 
?>
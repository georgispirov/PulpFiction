<?php

namespace PulpFiction\model;

use PulpFiction\core\ActiveRecord\ActiveRecord;

class Users extends ActiveRecord
{
    /**
    * @var int $id 
    */
    public $id;

    /**
    * @var  $username 
    */
    public $username;

    /**
    * @var  $first_name 
    */
    public $first_name;

    /**
    * @var  $last_name 
    */
    public $last_name;

    /**
    * @var  $email 
    */
    public $email;

    /**
    * @var  $created_at 
    */
    public $created_at;

    /**
    * @var  $updated_at 
    */
    public $updated_at;

    /**
    * @var  $gender_id 
    */
    public $gender_id;

} 
?>
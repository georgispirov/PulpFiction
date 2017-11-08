<?php

require_once '../vendor/autoload.php';
$db = \softuni\DatabaseConnection\Database::getConnection();
$application = new \softuni\core\Application($db);
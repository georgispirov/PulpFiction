<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../vendor/autoload.php';
$db = \softuni\DatabaseConnection\Database::getConnection();
$application = new \softuni\core\Application($db);
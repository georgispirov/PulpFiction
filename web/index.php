<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../vendor/autoload.php';

$db = \PulpFiction\DatabaseConnection\Database::getConnection();
$dispatcher  = new \PulpFiction\core\Dispatch\Dispatcher();
$response    = new \PulpFiction\core\Response\Response();
$application = new \PulpFiction\core\App\Application($db, $dispatcher, $response);
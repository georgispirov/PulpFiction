<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../vendor/autoload.php';

$db = \PulpFiction\DatabaseConnection\Database::getConnection();
$template    = new \PulpFiction\core\Template\Template();
$dispatcher  = new \PulpFiction\core\Dispatch\Dispatcher();
$response    = new \PulpFiction\core\Response\Response();
$request     = new \PulpFiction\core\HttpHandler\Request();
$application = new \PulpFiction\core\App\Application($db, $dispatcher, $response, $template, $request);
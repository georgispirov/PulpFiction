<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../vendor/autoload.php';
(new \PulpFiction\core\PulpFiction())->bootstrap();
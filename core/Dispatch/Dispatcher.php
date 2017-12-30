<?php

namespace PulpFiction\core\Dispatch;

use PulpFiction\core\App\ApplicationInterface;
use ReflectionClass;

class Dispatcher implements DispatcherInterface
{
    public function loadController(ApplicationInterface $application, string $controller)
    {
        $file_name = dirname(dirname(__DIR__)) . '/PulpFiction/controller/' . ucfirst($controller) . 'Controller.php';
        $fullPath = '\\PulpFiction\\controller\\' . ucfirst($controller) . 'Controller';
        if (file_exists($file_name)) {
            $className = (new ReflectionClass($fullPath))->getName();
            $controller = new $className();
            return true;
        }
        return false;
    }

    public function loadAction(ApplicationInterface $application, string $action)
    {

    }

    public function run(array $callable, array $args): bool
    {
        return call_user_func_array([
            $callable['controller'],
            $callable['action']
        ], $args);
    }
}
<?php

namespace PulpFiction\core\Dispatch;

use PulpFiction\core\App\ApplicationInterface;
use ReflectionClass;

class Dispatcher implements DispatcherInterface
{
    public function loadController(ApplicationInterface $application,
                                   string $controller)
    {
        $file_name = dirname(dirname(__DIR__)) . '/controller/' . ucfirst($controller) . 'Controller.php';
        $fullPath = '\\PulpFiction\\controller\\' . ucfirst($controller) . 'Controller';
        if (file_exists($file_name)) {
            $className = (new ReflectionClass($fullPath))->getName();
            $application->setController(new $className());
            return $application;
        }

        return null;
    }

    public function loadAction(ApplicationInterface $application,
                               string $action)
    {
        if (method_exists($application->getController(), $action)) {
            $application->setAction($action);
            return $application;
        }

        return null;
    }

    public function run(array $callable,
                        array $args)
    {
        call_user_func_array([$callable['controller'], $callable['action']], $args);
    }
}
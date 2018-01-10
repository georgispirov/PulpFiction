<?php

namespace PulpFiction\core\Dispatch;

use PulpFiction\core\App\ApplicationInterface;
use ReflectionClass;
use ReflectionMethod;

class Dispatcher implements DispatcherInterface
{
    /**
     * @param ApplicationInterface $application
     * @param string $controller
     * @return null|ApplicationInterface
     */
    public function loadController(ApplicationInterface $application,
                                   string $controller)
    {
        $file = dirname(dirname(__DIR__)) . '/controller/' . ucfirst($controller) . 'Controller.php';
        $fullyQualifiedClassName = '\\PulpFiction\\controller\\' . ucfirst($controller) . 'Controller';

        if ( !file_exists($file) && !class_exists($fullyQualifiedClassName) ) {
            return null;
        }

        $controllerReflectionClass = new ReflectionClass($fullyQualifiedClassName);
        $classService    = $serviceFolder = null;

        foreach ($controllerReflectionClass->getProperties() as $property) {
            if (false !== strpos($property->getName(), 'Service')) {
                $classService  = "\\PulpFiction\\services\\" . ucfirst($property->getName());
            }
        }

        if (null === $classService) {
            $application->setController($controllerReflectionClass->newInstance());
            return $application;
        }

        $serviceReflection = new ReflectionClass($classService);

        $application->setController($controllerReflectionClass->newInstanceArgs([
                                                $serviceReflection->newInstanceWithoutConstructor()
                                            ])
                                   );

        return $application;
    }

    /**
     * @param ApplicationInterface $application
     * @param string $action
     * @return null|ApplicationInterface
     */
    public function loadAction(ApplicationInterface $application,
                               string $action)
    {
        if (method_exists($application->getController(), $action)) {
            $application->setAction($action);
            return $application;
        }

        return null;
    }

    /**
     * @param ApplicationInterface $application
     * @return mixed
     */
    public function run(ApplicationInterface $application)
    {
        $reflectionMethod = new ReflectionMethod($application->getController(), $application->getAction());

        if ( $reflectionMethod->getNumberOfRequiredParameters() > sizeof($application->getRouteArguments()) ) {
            return $this->setNotFoundPage($application);
        }

        return call_user_func_array([
                            $application->getController(),
                            $application->getAction()
                         ], $application->getRouteArguments());
    }

    /**
     * @param ApplicationInterface $application
     * @return mixed
     */
    public function setNotFoundPage(ApplicationInterface $application)
    {
        return $application->getController()->render('home/not_found');
    }
}
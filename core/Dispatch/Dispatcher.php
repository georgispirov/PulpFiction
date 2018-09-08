<?php

namespace PulpFiction\core\Dispatch;

use InvalidArgumentException;
use PulpFiction\core\App\ApplicationInterface;
use PulpFiction\core\BaseController;
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
        $controllerFile = dirname(dirname(__DIR__)) . '/controller/' . ucfirst($controller) . 'Controller.php';
        $fullyQualifiedClassName = '\\PulpFiction\\controller\\' . ucfirst($controller) . 'Controller';

        if ( !file_exists($controllerFile) && !class_exists($fullyQualifiedClassName) ) {
            return null;
        }

        $controllerReflectionClass = new ReflectionClass($fullyQualifiedClassName);
        /* @var BaseController $controllerClass */
        $controllerClass = $this->autoloadDIContainer($controllerReflectionClass);

        $application->setController($controllerClass);

        return $application;
    }

    private function autoloadDIContainer(ReflectionClass $class)
    {
        $DIServiceContainerClasses = [];
        $DIRepositoryContainerClasses = [];

        if ( empty($class->getConstructor()->getParameters()) ) {
            return $class->newInstance();
        }

        foreach ($class->getConstructor()->getParameters() as $controllerParams) {
            $serviceReflection = new ReflectionClass($controllerParams->getClass()->getName());

            if ( !$serviceReflection || !$serviceReflection->getConstructor() ) {
                $DIServiceContainerClasses[] = $serviceReflection->newInstance();
                continue;
            }

            foreach ($serviceReflection->getConstructor()->getParameters() as $serviceParams) {
                $repositoryClass = $serviceParams->getClass()->getName();
                $DIRepositoryContainerClasses[] = new $repositoryClass();
            }

            $DIServiceContainerClasses[] = $serviceReflection->newInstanceArgs($DIRepositoryContainerClasses);
        }

        return $class->newInstanceArgs($DIServiceContainerClasses);
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

    /**
     * @param ApplicationInterface $consoleApp
     * @param string $controller
     * @param string $action
     * @param array $routeParams
     * @return ApplicationInterface
     */
    public function invokeConsoleApplication(ApplicationInterface $consoleApp,
                                             string $controller,
                                             string $action,
                                             array $routeParams): ApplicationInterface
    {
        $consoleControllerName = '\\PulpFiction\\controller\\console\\' . ucfirst($controller) . 'Controller';
        if ( !class_exists($consoleControllerName) ) {
            throw new InvalidArgumentException('The console controller does not exists.');
        }

        /* @var BaseController $consoleController */
        $consoleController = (new ReflectionClass($consoleControllerName))->newInstance();

        if ( !method_exists($consoleController, $action) ) {
            throw new InvalidArgumentException('Requested console action does not exists.');
        }

        $consoleApp->setController($consoleController);
        $consoleApp->setAction($action);

        return $consoleApp;
    }

    /**
     * @param string $params
     * @return array
     */
    public function resolveConsoleApplicationParams(string $params): array
    {
        $exploded = explode('/', $params);
        return [
            'controller' => reset($exploded),
            'action'     => $exploded[1],
            'params'     => isset($exploded[2]) ? [$exploded[2]] : []
        ];
    }
}
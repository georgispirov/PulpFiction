<?php

namespace PulpFiction\core\Dispatch;

use PulpFiction\core\App\ApplicationInterface;

interface DispatcherInterface
{
    /**
     * @param string $params
     * @return array
     */
    public function resolveConsoleApplicationParams(string $params): array;

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
                                             array $routeParams): ApplicationInterface;

    /**
     * @param ApplicationInterface $application
     * @param string $controller
     * @return mixed
     */
    public function loadController(ApplicationInterface $application,
                                   string $controller);

    /**
     * @param ApplicationInterface $application
     * @param string $action
     * @return mixed
     */
    public function loadAction(ApplicationInterface $application,
                               string $action);

    /**
     * @param ApplicationInterface $application
     * @return mixed
     */
    public function run(ApplicationInterface $application);

    /**
     * @param ApplicationInterface $application
     * @return mixed
     */
    public function setNotFoundPage(ApplicationInterface $application);
}
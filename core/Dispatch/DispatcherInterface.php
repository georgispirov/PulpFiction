<?php

namespace PulpFiction\core\Dispatch;

use PulpFiction\core\App\ApplicationInterface;

interface DispatcherInterface
{
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
     * @param array $callable
     * @param array $args
     * @return mixed
     */
    public function run(array $callable,
                        array $args);
}
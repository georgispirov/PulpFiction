<?php

namespace PulpFiction\core\Dispatch;

use PulpFiction\core\App\ApplicationInterface;

interface DispatcherInterface
{
    public function loadController(ApplicationInterface $application,
                                   string $controller);

    public function loadAction(ApplicationInterface $application,
                               string $action);

    public function run(array $callable,
                        array $args): bool;
}
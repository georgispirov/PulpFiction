<?php

namespace PulpFiction\core;

use PulpFiction\core\App\Application;
use PulpFiction\core\Dispatch\DispatcherInterface;
use PulpFiction\DatabaseConnection\DatabaseInterface;

class ConsoleApplication extends Application
{
    /**
     * ConsoleApplication constructor.
     * @param DatabaseInterface $database
     * @param DispatcherInterface $dispatcher
     */
    public function __construct(DatabaseInterface $database,
                                DispatcherInterface $dispatcher)
    {
        parent::__construct($database, $dispatcher);
    }
}
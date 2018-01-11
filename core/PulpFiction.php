<?php

namespace PulpFiction\core;

use PulpFiction\core\App\Application;
use PulpFiction\core\Dispatch\Dispatcher;
use PulpFiction\core\HttpHandler\Request;
use PulpFiction\core\Response\Response;
use PulpFiction\core\Session\Session;
use PulpFiction\core\Template\Template;
use PulpFiction\DatabaseConnection\Database;

class PulpFiction implements PulpFictionInterface
{
    /**
     * @var \PulpFiction\core\App\ApplicationInterface $app
     */
    public static $app;

    /**
     * @return mixed
     */
    public function bootstrap()
    {
        new Application(
                         Database::getConnection(),
                         new Dispatcher(),
                         new Response(),
                         new Template(),
                         new Request(),
                         new Session()
                       );
    }
}
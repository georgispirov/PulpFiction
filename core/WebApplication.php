<?php

namespace PulpFiction\core;

use ActiveRecord\Config;
use PulpFiction\core\App\Application;
use PulpFiction\core\Dispatch\DispatcherInterface;
use PulpFiction\core\EventBuilder\EventHandler;
use PulpFiction\core\EventBuilder\EventHandlerInterface;
use PulpFiction\core\HttpHandler\HttpInterface;
use PulpFiction\core\Response\ResponseInterface;
use PulpFiction\core\Session\SessionInterface;
use PulpFiction\core\Template\TemplateInterface;
use PulpFiction\DatabaseConnection\DatabaseInterface;

class WebApplication extends Application
{
    /**
     * @var ResponseInterface $response
     */

    private $response;

    /**
     * @var TemplateInterface $template
     */
    private $template;

    /**
     * @var HttpInterface $request
     */
    private $request;

    /**
     * @var SessionInterface $session
     */
    private $session;

    /**
     * @var EventHandler $eventHandler
     */
    private $eventHandler;

    /**
     * WebApplication constructor.
     * @param DatabaseInterface $database
     * @param DispatcherInterface $dispatcher
     * @param ResponseInterface $response
     * @param TemplateInterface $template
     * @param HttpInterface $request
     * @param SessionInterface $session
     * @param EventHandlerInterface $eventHandler
     */
    public function __construct(DatabaseInterface $database,
                                DispatcherInterface $dispatcher,
                                ResponseInterface $response,
                                TemplateInterface $template,
                                HttpInterface $request,
                                SessionInterface $session,
                                EventHandlerInterface $eventHandler)
    {
        $dbConfigPath = $_SERVER['DOCUMENT_ROOT'] . '/../DatabaseConnection/dbconfig.ini';
        $dbConfig = parse_ini_file($dbConfigPath);
        list($dsn, $user, $password, $db) = array_values($dbConfig);
        $connectionString = "mysql://$user:$password@localhost/$db";

        Config::initialize(function (Config $config) use ($connectionString) {
            $config->set_model_directory($this->getModelDirectory());
            $config->set_connections([
                'development' => $connectionString
            ]);
        });

        $this->response   = $response;
        $this->template   = $template;
        $this->request    = $request;
        $this->session    = $session;
        $this->eventHandler = $eventHandler;
        parent::__construct($database, $dispatcher);
    }


    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    /**
     * @return TemplateInterface
     */
    public function getTemplate(): TemplateInterface
    {
        return $this->template;
    }

    /**
     * @return HttpInterface
     */
    public function getRequest(): HttpInterface
    {
        return $this->request;
    }

    /**
     * @return SessionInterface
     */
    public function getSession(): SessionInterface
    {
        return $this->session;
    }

    public function getEventHandler(): EventHandlerInterface
    {
        return $this->eventHandler;
    }
}
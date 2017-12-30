<?php

namespace PulpFiction\core\App;

use Exception;
use PulpFiction\core\Controller;
use PulpFiction\core\Dispatch\DispatcherInterface;
use PulpFiction\core\Response\ResponseInterface;
use PulpFiction\DatabaseConnection\DatabaseInterface;

class Application implements ApplicationInterface
{
    /**
     * @var string|Controller
     */
    protected $controller = 'home';

    /**
     * @var string
     */
    protected $action     = 'index';

    /**
     * @var array $args
     */
    protected $args       = [];

    /**
     * @var DatabaseInterface $db
     */
    private static $db;

    /**
     * @var DispatcherInterface $dispatcher
     */
    private $dispatcher;

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * Application constructor.
     * @param DatabaseInterface $database
     * @param DispatcherInterface $dispatcher
     * @param ResponseInterface $response
     * @throws Exception
     */
    public function __construct(DatabaseInterface $database,
                                DispatcherInterface $dispatcher,
                                ResponseInterface $response)
    {
        self::$db         = $database;
        $this->dispatcher = $dispatcher;
        $this->response   = $response;

        $url = $this->parseUrl();

        if (sizeof($url) == 1) {
            $this->response->applyStatusCode(404);
            return $this->response->sendHeaders();
        }

        list($controller, $action) = $url;

        if (sizeof($url) > 2) {
            $this->args = (array) end($url);
        }

        if ( !$this->dispatcher->loadController($this, $controller) instanceof ApplicationInterface ) {
            return $this->controller->render('home/not_found');
        }

        if ( !$this->dispatcher->loadAction($this, $action) instanceof ApplicationInterface ) {
            return $this->controller->render('home/not_found');
        }

        return $this->dispatcher->run([
                    'controller' => $this->controller,
                    'action'     => $this->action
                ], $this->args);
    }

    public function getDb(DatabaseInterface $database)
    {
        return self::$db;
    }

    /**
     * @return array
     */
    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return $url = explode('/',
                                filter_var(
                                         rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }

        return [];
    }

    public function setController(Controller $controller)
    {
        $this->controller = $controller;
    }

    public function setAction(string $action)
    {
        $this->action = $action;
    }

    /**
     * @return null|Controller
     */
    public function getController()
    {
        return $this->controller;
    }


    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
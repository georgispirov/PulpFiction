<?php

namespace PulpFiction\core\App;

use PulpFiction\core\BaseController\BaseControllerInterface;
use PulpFiction\core\Dispatch\DispatcherInterface;
use PulpFiction\core\PulpFiction;
use PulpFiction\DatabaseConnection\DatabaseInterface;

class Application implements ApplicationInterface
{
    /**
     * @var BaseControllerInterface $controller
     */
    protected $controller;

    /**
     * @var string $action
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
     * Application constructor.
     * @param DatabaseInterface $database
     * @param DispatcherInterface $dispatcher
     */
    public function __construct(DatabaseInterface $database,
                                DispatcherInterface $dispatcher)
    {
        self::$db         = $database;
        $this->dispatcher = $dispatcher;

        PulpFiction::$app = $this;

        $url = $this->parseUrl();

        if (false === $this->prepareApplication($url)) {
            return $this->dispatcher->setNotFoundPage($this);
        }

        return $this->dispatcher->run($this);
    }

    /**
     * @return array
     */
    private function parseUrl(): array
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }

        return [];
    }

    private function prepareApplication(array $params): bool
    {
        $isApplicationValid = true;

        $this->args = (sizeof($params) === 3) ? (array) end($params) : [];

        if (sizeof($params) == 0) {
            $this->dispatcher->loadController($this, 'home');
            $this->dispatcher->loadAction($this, $this->action);
        }

        if (sizeof($params) == 1) {
            $this->dispatcher->loadController($this, 'home');
            $isApplicationValid = false;
        }

        if (sizeof($params) == 2) {
            list($controller, $action) = $params;

            if ( !$this->dispatcher->loadController($this, $controller) instanceof ApplicationInterface ) {
                $isApplicationValid = false;
            }

            if ( !$this->dispatcher->loadAction($this, $action) instanceof ApplicationInterface ) {
                $isApplicationValid = false;
            }
        }

        return $isApplicationValid;
    }

    /**
     * @param string $controller
     * @param string $action
     * @param array $args
     * @return mixed
     */
    public function callAction(string $controller,
                               string $action,
                               array $args = [])
    {
        $this->controller = null;
        $this->action     = null;
        $this->args       = $args;

        $this->dispatcher->loadController($this, $controller);
        $this->dispatcher->loadAction($this, $action);

        return $this->dispatcher->run($this);
    }

    /**
     * @return bool
     */
    public static function isConsole(): bool
    {
        return php_sapi_name() == 'cli';
    }

    /**
     * @return DatabaseInterface
     */
    public function getDb(): DatabaseInterface
    {
        return self::$db;
    }

    /**
     * @param string $action
     */
    public function setAction(string $action)
    {
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param BaseControllerInterface $controller
     */
    public function setController(BaseControllerInterface $controller)
    {
        $this->controller = $controller;
    }

    /**
     * @return BaseControllerInterface
     */
    public function getController(): BaseControllerInterface
    {
        return $this->controller;
    }

    /**
     * @return array
     */
    public function getRouteArguments(): array
    {
        return $this->args;
    }

    /**
     * @return string
     */
    public function getScriptSourceFolder(): string
    {
        return dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'web';
    }

    /**
     * @return string
     */
    public function getRootFolder(): string
    {
        return dirname(__DIR__);
    }

    /**
     * @return string
     */
    public function getImageSourceFolder(): string
    {
        return $this->getScriptSourceFolder() . DIRECTORY_SEPARATOR . 'images';
    }
}
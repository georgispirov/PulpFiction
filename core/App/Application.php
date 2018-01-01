<?php

namespace PulpFiction\core\App;

use PulpFiction\core\BaseController\BaseControllerInterface;
use PulpFiction\core\BaseController\Controller;
use PulpFiction\core\Dispatch\DispatcherInterface;
use PulpFiction\core\HttpHandler\HttpInterface;
use PulpFiction\core\PulpFiction;
use PulpFiction\core\Response\ResponseInterface;
use PulpFiction\core\Template\TemplateInterface;
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
     * Application constructor.
     * @param DatabaseInterface $database
     * @param DispatcherInterface $dispatcher
     * @param ResponseInterface $response
     * @param TemplateInterface $template
     * @param HttpInterface $request
     */
    public function __construct(DatabaseInterface $database,
                                DispatcherInterface $dispatcher,
                                ResponseInterface $response,
                                TemplateInterface $template,
                                HttpInterface $request)
    {
        self::$db         = $database;
        $this->dispatcher = $dispatcher;
        $this->response   = $response;
        $this->template   = $template;
        $this->request    = $request;
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
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }

        return [];
    }

    private function prepareApplication(array $params): bool
    {
        $isApplicationValid = true;

        $this->args = (sizeof($params) > 2) ? (array) end($params) : [];

        if ( !isset($params) ) {
            $this->dispatcher->loadController($this, $this->controller);
            $this->dispatcher->loadAction($this, $this->action);
        }

        if (sizeof($params) == 1) {
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
     * @param DatabaseInterface $database
     * @return DatabaseInterface|null
     */
    public function getDb(DatabaseInterface $database)
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
     * @param BaseControllerInterface|string $controller
     */
    public function setController(BaseControllerInterface $controller)
    {
        $this->controller = $controller;
    }

    /**
     * @return BaseControllerInterface|string
     */
    public function getController(): BaseControllerInterface
    {
        return $this->controller;
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
     * @return array
     */
    public function getRouteArguments(): array
    {
        return $this->args;
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
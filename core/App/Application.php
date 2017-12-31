<?php

namespace PulpFiction\core\App;

use PulpFiction\core\BaseController\BaseControllerInterface;
use PulpFiction\core\BaseController\Controller;
use PulpFiction\core\Dispatch\DispatcherInterface;
use PulpFiction\core\HttpHandler\HttpInterface;
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

        $url = $this->parseUrl();

        $this->dispatcher->loadController($this, $this->controller);
        $this->dispatcher->loadAction($this, $this->action);

        if (sizeof($url) == 1) {
            return $this->dispatcher->setNotFoundPage($this);
        }

        if (sizeof($url) == 2) {

            list($controller, $action) = $url;

            if ( !$this->dispatcher->loadController($this, $controller) instanceof ApplicationInterface ) {
                return $this->dispatcher->setNotFoundPage($this);
            }

            if ( !$this->dispatcher->loadAction($this, $action) instanceof ApplicationInterface ) {
                return $this->dispatcher->setNotFoundPage($this);
            }

        }

        if (sizeof($url) > 2) {
            $this->args = (array) end($url);
        }

        return $this->dispatcher->run([
                    'controller' => $this->controller,
                    'action'     => $this->action
                ], $this->args);
    }

    /**
     * @param DatabaseInterface $database
     * @return DatabaseInterface
     */
    public function getDb(DatabaseInterface $database)
    {
        return self::$db;
    }

    /**
     * @return array
     */
    public function parseUrl(): array
    {
        if (isset($_GET['url'])) {
            return $url = explode('/',
                                filter_var(
                                         rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }

        return [];
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
}
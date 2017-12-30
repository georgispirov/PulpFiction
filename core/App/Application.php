<?php

namespace PulpFiction\core\App;

use Exception;
use PulpFiction\core\Dispatch\DispatcherInterface;
use PulpFiction\core\Response\ResponseInterface;
use PulpFiction\DatabaseConnection\DatabaseInterface;
use ReflectionClass;

class Application implements ApplicationInterface
{
    /**
     * @var string
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

        list($controller, $action, $args) = $this->parseUrl();

        if (null === $controller || null === $action) {
            $this->response->applyStatusCode(404);
            throw new Exception('Given route cannot be matched.');
        }

        if ( !$this->dispatcher->loadController($this, $controller) instanceof ApplicationInterface ) {
            $this->response->applyStatusCode(404);
            throw new Exception('Unresolveable route.');
        }

        if ( !$this->dispatcher->loadAction($this, $action) instanceof ApplicationInterface ) {
            $this->response->applyStatusCode(404);
            throw new Exception('Unresolveable route.');
        }

        $this->dispatcher->run([
            'controller' => $controller,
            'action'     => $action
        ], $args);
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
}
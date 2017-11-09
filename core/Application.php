<?php

namespace softuni\core;

use ReflectionClass;
use softuni\core\HttpHandler\HttpInterface;
use softuni\DatabaseConnection\Database;

class Application
{
    protected $controller = '';

    protected $action = '';

    protected $args = [];

    private static $db;

    public function __construct(Database $database)
    {
        self::$db = $database;
        $url = $this->parseUrl();
        if (is_array($url) && reset($url) !== '') {
            $this->invoke($url);
        } else {
            $this->build($this->controller);
            call_user_func([$this->controller, $this->action], $this->args);
        }
    }

    public static function getDb()
    {
        if (self::$db instanceof Database) {
            return self::$db;
        }
        return null;
    }

    private function invoke(array $urlParams)
    {
        $action = $urlParams[1];
        $controller = reset($urlParams);

        if (isset($action) && $action !== '') {
            if (isset($controller) && $controller !== '') {
                $this->build($controller . 'Controller');
                if (method_exists($this->controller, $action)) {
                    $this->action = $action;
                    unset($urlParams[0]);
                    unset($urlParams[1]);
                    $this->args = $urlParams ? $this->configParams($urlParams) : [];
                    call_user_func([$this->controller, $this->action], $this->args);
                }
            }
        }
    }

    private function configParams(array $params)
    {
        if (sizeof($params) == 1) {
            return reset($params);
        }
        return $params;
    }

    private function build(string $controller)
    {
        $file_name = dirname(dirname(__DIR__)) . '/softuni/controller/' . ucfirst($controller) . '.php';
        $fullPath = '\\softuni\\controller\\' . ucfirst($controller);
        if (file_exists($file_name)) {
            $className = (new ReflectionClass($fullPath))->getName();
            $this->controller = new $className();
        }
    }

    protected function parseUrl()
    {
        if (isset($_GET['url'])) {
            return $url = explode('/',
                                filter_var(
                                         rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}
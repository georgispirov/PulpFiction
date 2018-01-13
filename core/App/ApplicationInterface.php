<?php

namespace PulpFiction\core\App;

use PulpFiction\core\BaseController\BaseControllerInterface;
use PulpFiction\DatabaseConnection\DatabaseInterface;

interface ApplicationInterface
{
    /**
     * @return bool
     */
    public static function isConsole(): bool;

    /**
     * @return string
     */
    public function getScriptSourceFolder(): string;

    /**
     * @return string
     */
    public function getRootFolder(): string;

    /**
     * @return string
     */
    public function getImageSourceFolder(): string;

    /**
     * @return DatabaseInterface
     */
    public function getDb(): DatabaseInterface;

    /**
     * @return BaseControllerInterface
     */
    public function getController(): BaseControllerInterface;

    /**
     * @return string
     */
    public function getAction(): string;

    /**
     * @param BaseControllerInterface $controller
     */
    public function setController(BaseControllerInterface $controller);

    /**
     * @param string $action
     */
    public function setAction(string $action);

    /**
     * @return array
     */
    public function getRouteArguments(): array;

    /**
     * @param string $controller
     * @param string $action
     * @param array $args
     * @return mixed
     */
    public function callAction(string $controller,
                               string $action,
                               array $args = []);
}
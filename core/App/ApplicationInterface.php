<?php

namespace PulpFiction\core\App;

use PulpFiction\core\BaseController\BaseControllerInterface;
use PulpFiction\core\HttpHandler\HttpInterface;
use PulpFiction\core\Response\ResponseInterface;
use PulpFiction\core\Template\TemplateInterface;
use PulpFiction\DatabaseConnection\DatabaseInterface;

interface ApplicationInterface
{
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
     * @param DatabaseInterface $database
     * @return mixed
     */
    public function getDb(DatabaseInterface $database);

    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface;

    /**
     * @return BaseControllerInterface|string
     */
    public function getController(): BaseControllerInterface;

    /**
     * @return TemplateInterface
     */
    public function getTemplate(): TemplateInterface;

    /**
     * @return HttpInterface
     */
    public function getRequest(): HttpInterface;

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
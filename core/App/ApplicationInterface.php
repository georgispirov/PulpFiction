<?php

namespace PulpFiction\core\App;

use PulpFiction\core\Controller;
use PulpFiction\core\Response\ResponseInterface;
use PulpFiction\DatabaseConnection\DatabaseInterface;

interface ApplicationInterface
{
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
     * @return null|Controller
     */
    public function getController();

    /**
     * @return string
     */
    public function getAction(): string;

    /**
     * @return mixed
     */
    public function parseUrl();

    /**
     * @param Controller $controller
     * @return mixed
     */
    public function setController(Controller $controller);

    /**
     * @param string $action
     * @return mixed
     */
    public function setAction(string $action);
}
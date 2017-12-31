<?php

namespace PulpFiction\core\BaseController;

interface BaseControllerInterface
{
    /**
     * @param string $route
     * @return mixed
     */
    public function redirect(string $route);

    /**
     * @param string $view
     * @param array $data
     * @return mixed
     */
    public function render(string $view, array $data = []);
}
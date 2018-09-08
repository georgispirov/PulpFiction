<?php

namespace PulpFiction\core;

class BaseController
{
    public function getCurrentUrl()
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function getActionId()
    {
        return end(explode('/', $_SERVER['REQUEST_URI']));
    }
}
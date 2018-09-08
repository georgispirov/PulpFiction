<?php

namespace PulpFiction\core;

class BaseController
{
    public function getActionId()
    {
        return end(explode('/', $_SERVER['REQUEST_URI']));
    }
}
<?php

namespace PulpFiction\controller;

use PulpFiction\core\BaseController\web\Controller;

class GeneratorController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function generate()
    {
        return $this->render('generator/index');
    }
}
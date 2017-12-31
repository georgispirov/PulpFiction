<?php

namespace PulpFiction\Controller;

use PulpFiction\core\BaseController\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return $this->render('home/index');
    }
}
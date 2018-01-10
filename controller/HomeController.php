<?php

namespace PulpFiction\Controller;

use PulpFiction\core\BaseController\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->render('home/index');
    }
}
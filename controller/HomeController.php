<?php

namespace PulpFiction\Controller;

use PulpFiction\core\BaseController\web\Controller;

class HomeController extends Controller
{
    /**
     * HomeController constructor.
     */
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
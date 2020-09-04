<?php

namespace PhpFramework\Bootstrap;

use PhpFramework\Exceptions\Whoops;
use PhpFramework\Http\Request;
use PhpFramework\Session\Session;

class App
{

    /**
     * App constructor.
     */
    private function __construct()
    {
    }

    /*
     * Run The Application
     */
    public static function run()
    {
        //Register Whoops
        Whoops::handle();

        //Start Session
        Session::start();

        //Handel Request
        Request::handle();

    }
}
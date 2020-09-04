<?php

namespace PhpFramework\Bootstrap;

use PhpFramework\Cookie\Cookie;
use PhpFramework\Exceptions\Whoops;
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
    }
}
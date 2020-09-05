<?php

namespace PhpFramework\Bootstrap;

use PhpFramework\Exceptions\Whoops;
use PhpFramework\File\File;
use PhpFramework\Http\Request;
use PhpFramework\Router\Route;
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

        //Require All Routes Directory
        File::requireDirectory('routes');

        echo '<pre>';
        print_r(Route::allRoutes());
        echo '<pre>';

    }
}
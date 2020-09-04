<?php

use PhpFramework\Bootstrap\App;


/**
 * Class Application
 */
class Application
{

    /**
     * Application constructor.
     */
    private function __construct()
    {
    }

    /**
     * Run the application
     *
     * @return void
     */
    public static function run(): void
    {
        /*
         * Define Root path
         */
        define('ROOT', dirname(__DIR__) . '');

        /*
         * Define DIRECTORY SEPARATOR
         */
        define('DS', DIRECTORY_SEPARATOR);

        /*
         * Run The Application
         */
        App::run();
    }
}
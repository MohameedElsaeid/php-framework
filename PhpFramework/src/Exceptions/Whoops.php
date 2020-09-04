<?php


namespace PhpFramework\Exceptions;


use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

/**
 * Class Whoops
 * @package PhpFramework\Exceptions
 */
abstract class Whoops
{
    /**
     * Handle Whoops errors
     *
     * @return void
     */
    public static function handle(): void
    {
        $whoops = new Run;
        $whoops->pushHandler(new PrettyPageHandler);
        $whoops->register();
    }
}
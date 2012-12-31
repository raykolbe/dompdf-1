<?php
/*
 * This file bootstraps the test environment.
 * 
 * Adapted from Doctrine\Tests\TestInit.php
 */
namespace DOMPDF\Tests;

error_reporting(E_ALL | E_STRICT);

// register silently failing autoloader
spl_autoload_register(function($class)
{
    if (0 === strpos($class, 'DOMPDF\Tests\\')) {
        $path = __DIR__.'/../../'.strtr($class, '\\', '/').'.php';
        if (is_file($path) && is_readable($path)) {
            require_once $path;

            return true;
        }
    } else if (0 === strpos($class, 'DOMPDF\\')) {
        $path = __DIR__.'/../../../lib/'.($class = strtr($class, '\\', '/')).'.php';
        if (is_file($path) && is_readable($path)) {
            require_once $path;

            return true;
        }
    } else if (0 === strpos($class, 'Cpdf\\')) {
        $path = __DIR__.'/../../../lib/vendor/'.($class = strtr($class, '\\', '/')).'.php';
        if (is_file($path) && is_readable($path)) {
            require_once $path;

            return true;
        }
    }
});
<?php
/**
 * Created by PhpStorm.
 * User: cwei
 * Date: 2018/10/17
 * Time: 9:09 AM
 */

namespace Script\Module\Cli;

use Phalcon\Loader;
use Phalcon\DiInterface;
use Phalcon\Cli\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Events\Manager;

class Module implements ModuleDefinitionInterface
{
    public function registerAutoloaders(DiInterface $di = null) {

        $loader = new Loader();

        $loader->registerNamespaces([
            'Script\\Module\\Cli\\Task' => SCRIPT_PATH . '/module/cli/task',
        ], true);

        $loader->register();
    }

    public function registerServices(DiInterface $di) {
        $di->set('dispatcher', function () {
            $dispatcher = new Dispatcher();

            $dispatcher->setDefaultNamespace('Script\\Module\\Cli\\Task');
            return $dispatcher;
        });
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: cwei
 * Date: 2018/10/17
 * Time: 9:09 AM
 */

namespace App\Module\Api;

use Phalcon\Loader;
use Phalcon\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Events\Manager;

class Module implements ModuleDefinitionInterface
{
    public function registerAutoloaders(DiInterface $di = null) {

        $di->get('Loader')->registerNamespaces([
            'App\\Module\\Api\\Controller' => APP_PATH . '/modules/api/controller',
            'App\\Module\\Api\\Model'      => APP_PATH . '/modules/api/model',
            'App\\Module\\Api\\Library'    => APP_PATH . '/modules/api/library',
        ], true);

        $di->get('Loader')->register();
    }

    public function registerServices(DiInterface $di) {
        $di->set('dispatcher', function () {
            $dispatcher = new Dispatcher();

            $dispatcher->setDefaultNamespace('App\\Module\\Api\\Controller');
            return $dispatcher;
        });
    }
}

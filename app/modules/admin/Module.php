<?php
/**
 * Created by PhpStorm.
 * User: cwei
 * Date: 2018/10/17
 * Time: 9:09 AM
 */

namespace App\Module\Admin;

use Phalcon\Loader;
use Phalcon\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Events\Manager;

class Module implements ModuleDefinitionInterface
{
    public function registerAutoloaders(DiInterface $di = null) {

        $di->get('Loader')->registerNamespaces([
            'App\\Module\\Admin\\Controller' => APP_PATH . '/modules/admin/controller',
            'App\\Module\\Admin\\Model'      => APP_PATH . '/modules/admin/model',
            'App\\Module\\Admin\\Library'    => APP_PATH . '/modules/admin/library',
        ], true);

        $di->get('Loader')->register();
    }

    public function registerServices(DiInterface $di) {
        $di->set('dispatcher', function () {
            $dispatcher = new Dispatcher();

            $dispatcher->setDefaultNamespace('App\\Module\\Admin\\Controller');
            return $dispatcher;
        });

        $di->setShared('view', function () {
            $view = new View();
            $view->setDI($this);
            $view->setViewsDir(APP_PATH . '/modules/admin/view');

            $view->registerEngines([
                '.phtml' => PhpEngine::class,
            ]);

            return $view;
        });
    }
}

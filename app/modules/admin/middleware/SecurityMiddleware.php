<?php
/**
 * Created by PhpStorm.
 * User: cwei
 * Date: 2018-12-11
 * Time: 13:48
 */

namespace App\Module\Admin\Middleware;

use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\User\Plugin;

class SecurityMiddleware extends Plugin
{
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher) {
        $user = $this->session->get('User');

        $controller = $dispatcher->getControllerName();
        if ($controller == 'passport') {
            if ($user) {
                $dispatcher->forward([
                    'module'     => 'admin',
                    'controller' => 'index',
                    'action'     => 'index',
                ]);
            }
            return false;
        }

        if (!$user) {
            $dispatcher->forward([
                'module'     => 'admin',
                'controller' => 'passport',
                'action'     => 'login',
            ]);

            return false;
        }

        return true;
    }
}
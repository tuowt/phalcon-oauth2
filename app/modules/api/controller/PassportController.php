<?php
/**
 * Created by PhpStorm.
 * User: cwei
 * Date: 2018-12-07
 * Time: 15:24
 */

namespace App\Module\Mch\Controller;

use Phalcon\Mvc\View;

class PassportController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->view->disableLevel(
            View::LEVEL_MAIN_LAYOUT
        );
    }

    public function loginAction()
    {
        echo date();
    }
}
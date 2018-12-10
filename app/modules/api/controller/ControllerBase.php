<?php
namespace App\Module\Mch\Controller;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public function initialize()
    {
        $this->view->disable();
    }
}

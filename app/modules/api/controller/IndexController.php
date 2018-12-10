<?php
namespace App\Module\Mch\Controller;

class IndexController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
    }

    public function indexAction()
    {
        echo date();
    }
}


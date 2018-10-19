<?php
namespace App\Module\OAuth2\Controller;

class IndexController extends BaseController
{
    public function indexAction()
    {
        echo date('Y-m-d H:i:s');
    }
}


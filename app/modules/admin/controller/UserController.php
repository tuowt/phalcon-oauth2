<?php

namespace App\Module\Admin\Controller;

use App\Model\SiteUser;
use Phalcon\Mvc\Model\Criteria;

class UserController extends ControllerBase
{
    public function initialize() {
        parent::initialize();
    }

    public function indexAction() {
        $this->persistent->parameters = null;
    }

    public function searchAction() {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'App\\Model\\SiteUser', $this->request->getPost());
            $this->persistent->parameters = $query->getParams();
        }
        else {
            $numberPage = $this->request->getQuery('page', 'int');
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters['order'] = 'id';

        $siteUsers = SiteUser::find($parameters);
        if (count($siteUsers) == 0) {
            $this->flash->notice('The search did not find any siteUsers');

            $this->dispatcher->forward([
                'controller' => 'user',
                'action'     => 'index',
            ]);

            return;
        }

        $paginator = new Paginator([
            'data'  => $siteUsers,
            'limit' => 10,
            'page'  => $numberPage,
        ]);

        $this->view->page = $paginator->getPaginate();
    }
}


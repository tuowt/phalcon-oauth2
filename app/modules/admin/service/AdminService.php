<?php
/**
 * Created by PhpStorm.
 * User: cwei
 * Date: 2018-12-11
 * Time: 08:54
 */

namespace App\Module\Admin\Service;

use App\Module\Admin\Model\DesktopAdmin;
use Phalcon\Mvc\User\Component;

class AdminService extends Component
{
    public function __construct(array $options) {
        $this->attributes = $options;
    }

    public function login() {
        $user = $this->getUser();

        if (!$user || !$user->validatePassword($this->attributes['password'])) {
            return false;
        }

        $duration = 3600 * 24 * 30;
        $this->session->set('User', $user->id);

        return true;
    }

    protected function getUser() {
        if ($this->_user === null) {
            $this->_user = DesktopAdmin::findFirstByUsername($this->attributes['username']);
        }
        return $this->_user;
    }
}
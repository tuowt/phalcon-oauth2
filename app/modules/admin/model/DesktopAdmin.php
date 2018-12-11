<?php

namespace App\Module\Admin\Model;

class DesktopAdmin extends \Phalcon\Mvc\Model
{
    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource() {
        return 'desktop_admin';
    }

    public function validatePassword($password) {
        return $this->getDI()->get('security')->checkHash($password, $this->password);
    }

    public function beforeSave() {
        $this->password = $this->getDI()->get('security')->hash($this->password);
    }


}

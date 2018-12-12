<?php

namespace App\Model;

class SiteUser extends \Phalcon\Mvc\Model
{
    public function initialize()
    {
        $this->hasOne(
            'id',
            'App\\Model\\SiteUserWechat',
            'user_id'
        );

        $this->hasOne(
            'id',
            'App\\Model\\SiteUserRelation',
            'user_id'
        );
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource() {
        return 'site_user';
    }

}

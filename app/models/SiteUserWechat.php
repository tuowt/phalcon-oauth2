<?php

namespace App\Model;

class SiteUserWechat extends \Phalcon\Mvc\Model
{
    public function initialize() {
        $this->belongsTo('user_id','App\\Model\\SiteUser','id');
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource() {
        return 'site_user_wechat';
    }

}

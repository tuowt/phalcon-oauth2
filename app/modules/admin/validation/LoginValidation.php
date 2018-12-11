<?php
/**
 * Created by PhpStorm.
 * User: cwei
 * Date: 2018-12-10
 * Time: 21:48
 */

namespace App\Module\Admin\Validation;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;

class LoginValidation extends Validation
{

    public function initialize() {
        $this->add([
            "username",
            "password",
        ], new PresenceOf([
            "message" => [
                "username" => "用户名或密码不能为空！",
                "password" => "用户名或密码不能为空！",
            ],
        ]));
    }
}
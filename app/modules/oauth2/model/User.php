<?php

namespace App\Module\OAuth2\Model;

use League\OAuth2\Server\Entities\UserEntityInterface;

/**
 * Class User
 * @property string username
 * @property string password
 * @property string scope
 * @property int    id
 * @package  App\Module\OAuth2\Model
 */
class User extends BaseModel implements UserEntityInterface
{
    public function initialize() {
        $this->setSource('oauth_users');
    }

    public function getIdentifier() {
        return $this->id;
    }
}

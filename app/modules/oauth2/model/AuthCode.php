<?php
namespace App\Module\OAuth2\Model;

use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use League\OAuth2\Server\Entities\Traits\AuthCodeTrait;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\Traits\TokenEntityTrait;

/**
 * Class AuthCode
 * @property string client_id
 * @property string authorization_code
 * @property string expires
 * @property string user_id
 * @property string scope
 * @property string redirect_url
 * @property int revoked
 * @package  App\Module\OAuth2\Model
 */
class AuthCode extends BaseModel implements AuthCodeEntityInterface
{
    use AuthCodeTrait, EntityTrait, TokenEntityTrait;

    public function initialize()
    {
        $this->setSource('oauth_authorization_codes');
    }
}

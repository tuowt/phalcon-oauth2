<?php
namespace App\Module\OAuth2\Model;

use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\Traits\AccessTokenTrait;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use League\OAuth2\Server\Entities\Traits\TokenEntityTrait;

/**
 * Class AccessToken
 * @property string client_id
 * @property string access_token
 * @property string expires
 * @property string user_id
 * @property string scope
 * @property int revoked
 * @package App\Module\OAuth2\Model
 */
class AccessToken extends BaseModel implements AccessTokenEntityInterface
{
    use AccessTokenTrait, EntityTrait, TokenEntityTrait;

    public function initialize()
    {
        $this->setSource('oauth_access_tokens');
    }
}

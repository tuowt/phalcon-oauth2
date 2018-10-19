<?php

namespace App\Module\OAuth2\Repository;

use App\Module\OAuth2\Library\OAuthHelper;
use App\Module\OAuth2\Library\Utils;
use App\Module\OAuth2\Model\RefreshToken;
use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use League\OAuth2\Server\Exception\UniqueTokenIdentifierConstraintViolationException;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;

/**
 * Class RefreshTokenRepository
 * @package App\Module\OAuth2\Repository
 */
class RefreshTokenRepository extends Repository implements RefreshTokenRepositoryInterface
{
    use Utils, OAuthHelper;
    /**
     * Model class name for the concrete implementation
     *
     * @return string
     */
    public function modelName()
    {
        return RefreshToken::class;
    }

    /**
     * Creates a new refresh token
     *
     * @return RefreshTokenEntityInterface
     */
    public function getNewRefreshToken()
    {
        return new RefreshToken();
    }

    /**
     * Create a new refresh token_name.
     *
     * @param RefreshTokenEntityInterface $refreshTokenEntity
     *
     * @throws UniqueTokenIdentifierConstraintViolationException
     */
    public function persistNewRefreshToken(RefreshTokenEntityInterface $refreshTokenEntity)
    {
        $token = $refreshTokenEntity->getIdentifier();
        if ($this->findOne(['refresh_token' => $token])) {
            throw UniqueTokenIdentifierConstraintViolationException::create();
        }

        $accessToken = $refreshTokenEntity->getAccessToken();
        $this->create([
            'refresh_token' => $token,
            'expires' => $this->formatDateTime($refreshTokenEntity->getExpiryDateTime()),
            'client_id' => $accessToken->getClient()->getIdentifier(),
            'user_id' => $accessToken->getUserIdentifier(),
            'revoked' => 0,
        ]);
    }

    /**
     * Revoke the refresh token.
     *
     * @param string $tokenId
     */
    public function revokeRefreshToken($tokenId)
    {
        $this->update(['refresh_token' => $tokenId], ['revoked' => 1]);
    }

    /**
     * Check if the refresh token has been revoked.
     *
     * @param string $tokenId
     *
     * @return bool Return true if this token has been revoked
     */
    public function isRefreshTokenRevoked($tokenId)
    {
        if ($result = $this->findOne(['refresh_token' => $tokenId])) {
            return (int)$result->revoked === 1;
        }

        return true;
    }
}

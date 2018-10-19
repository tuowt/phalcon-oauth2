<?php

namespace App\Module\OAuth2\Controller;

use App\Module\OAuth2\Library\HttpStatusCodes;
use App\Module\OAuth2\Library\ResponseCodes;
use App\Module\OAuth2\Library\Utils;
use App\Module\OAuth2\Model\User;
use App\Module\OAuth2\Repository\AccessTokenRepository;
use GuzzleHttp\Psr7\ServerRequest;
use League\OAuth2\Server\AuthorizationValidators\BearerTokenValidator;
use League\OAuth2\Server\CryptKey;
use League\OAuth2\Server\Exception\OAuthServerException;

/**
 * Class AuthController
 * @property \League\OAuth2\Server\AuthorizationServer oauth2Server injected into DI
 * @package App\Module\OAuth2\Controller
 */
class AuthController extends BaseController
{
    use Utils;

    /**
     * Get authorization code
     * @return mixed
     */
    public function authorizeAction() {
        $serverResponse = new \GuzzleHttp\Psr7\Response();

        try {
            $request = ServerRequest::fromGlobals();

            // this is where the client gets validated
            //(e.g how facebook validates/verifies the Spotify Web client)
            $authRequest = $this->oauth2Server->validateAuthorizationRequest($request);

            // The auth request object can be serialized and saved into a user's session.
            // You will probably want to redirect the user at this point to a login endpoint.
            //(e.g the point where Facebook now requests for your username and password)

            // Once the user has logged in set the user on the AuthorizationRequest
            $authRequest->setUser(new User([
                'id' => '1',
            ])); // an instance of UserEntityInterface

            // At this point you should redirect the user to an authorization page.
            // This form will ask the user to approve the client and the scopes requested.
            // (e.g when facebook asks you whether you want the
            //            $this->response->redirect('http://local.practice.com/node.php', true);
            //            header('Location: ' . 'http://local.practice.com/node.php');

            // Once the user has approved or denied the client update the status
            // (true = approved, false = denied)
            $authRequest->setAuthorizationApproved(true);
            //
            //            // Return the HTTP redirect response
            $response = $this->oauth2Server->completeAuthorizationRequest($authRequest, $serverResponse);

            $redirectUrl = $response->getHeaders()['Location'][0];
            //this redirect url should contain the the authorization code and the optional state parameter
            //redirect to this url and request for a token with the authorization code using the token endpoint
            //
            return $this->response->sendSuccess($redirectUrl);
        } catch (OAuthServerException $exception) {
            $response = $exception->generateHttpResponse($serverResponse);
            $payload = $exception->getPayload();
            return $this->response->sendError($payload['error'], $response->getStatusCode(), $payload['message']);
        } catch (\Exception $exception) {
            return $this->response->sendError(ResponseCodes::INTERNAL_SERVER_ERROR, 500, $exception->getMessage());
        }
    }

    /**
     * Get access token
     * @return mixed
     */
    public function tokenAction() {
        $serverResponse = new \GuzzleHttp\Psr7\Response();

        try {
            $response = $this->oauth2Server->respondToAccessTokenRequest(ServerRequest::fromGlobals(), $serverResponse);
            return $this->response->sendSuccess(json_decode($response->getBody()));
        } catch (OAuthServerException $exception) {
            return $this->sendResponseFromException($exception);
        } catch (\Exception $exception) {
            return $this->sendResponseFromException($exception);
        }
    }

    /**
     * Validate access token
     * @return mixed
     */
    public function validateAction() {

        $accessTokenRepository = new AccessTokenRepository();
        $bearerTokenValidator = new BearerTokenValidator($accessTokenRepository);
        $bearerTokenValidator->setPublicKey(new CryptKey($this->config->oauth->public_key_path, null, false));

        try {
            $request = $bearerTokenValidator->validateAuthorization(ServerRequest::fromGlobals());
            return $this->response->sendSuccess([$request->getAttributes()]);
        } catch (OAuthServerException $exception) {
            return $this->sendResponseFromException($exception);
        } catch (\Exception $exception) {
            return $this->sendResponseFromException($exception);
        }
    }

    /**
     * @param \Exception $exception
     *
     * @return mixed
     */
    private function sendResponseFromException(\Exception $exception) {
        if ($exception instanceof OAuthServerException) {
            $payload = $exception->getPayload();
            return $this->response->sendError($payload['error'], $exception->getHttpStatusCode(), $payload['message']);
        }

        return $this->response->sendError(ResponseCodes::INTERNAL_SERVER_ERROR, HttpStatusCodes::INTERNAL_SERVER_ERROR_CODE, $exception->getMessage());
    }
}

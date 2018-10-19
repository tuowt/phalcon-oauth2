<?php
namespace App\Module\OAuth2\Controller;

use App\Module\OAuth2\Library\Response;
use Phalcon\Mvc\Controller;

/**
 * Class BaseController
 * @package App\Module\OAuth2\Controller
 * @property Response $response
 */
class BaseController extends Controller
{
    /**
     * Check if payload is empty
     * @return bool
     */
    public function isPayloadEmpty()
    {
        $postData = $this->getPayload();
        return empty((array)$postData);
    }

    /**
     * Get payload of current request
     * @return array|bool|\stdClass
     */
    public function getPayload()
    {
        return $this->request->getJsonRawBody();
    }
}

<?php

namespace App\Module\OAuth2\Controller;

use Phalcon\Config;

/**
 * Class VersionController
 * @property Config config
 * @package App\Module\OAuth2\Controller
 */
class VersionController extends BaseController
{
    public function indexAction()
    {
        $data = "Welcome to " . $this->config->appParams->appName . " V" . $this->config->appParams->appVersion;
        return $this->response->sendSuccess($data);
    }
}

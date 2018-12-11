<?php

namespace App\Module\Admin\Controller;

use Phalcon\Mvc\Controller;
use App\Library\Response;

/**
 * Class BaseController
 * @package App\Module\Admin\Controller
 * @property Response $response
 */
class ControllerBase extends Controller
{
    public function initialize() {
    }
}

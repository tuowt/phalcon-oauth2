<?php

namespace App\Module\OAuth2\CInterface;

/**
 * Interface JSend
 */
interface JSend
{
    /**
     * @param            $code
     * @param int|string $http_status_code
     *
     * @return mixed
     */
    public function sendError($code, $http_status_code = 200);

    /**
     * @param $data
     *
     * @return mixed
     */
    public function sendSuccess($data);

    /**
     * @param            $data
     * @param int|string $http_status_code
     *
     * @return mixed
     */
    public function sendFail($data, $http_status_code = 500);
}


<?php

namespace App\Library;

use Phalcon\Http\Response as PhalconResponse;

/**
 * Class Response
 */
class Response extends PhalconResponse
{

    const RESPONSE_TYPE_ERROR = 'error';
    const RESPONSE_TYPE_SUCCESS = 'success';
    const RESPONSE_TYPE_FAIL = 'fail';

    public function __construct($content = null, $code = null, $status = null) {
        parent::__construct($content, $code, $status);
    }

    /**
     * @param            $code
     * @param int|string $http_status_code
     * @param null       $message
     *
     * @return mixed
     */
    public function sendError($code, $message = null, $http_status_code = 500) {
        $response = [
            'status'  => self::RESPONSE_TYPE_ERROR,
            'message' => (is_null($message)) ? ResponseMessages::getMessageFromCode($code) : $message,
            'code'    => $code,
        ];

        $this->setStatusCode($http_status_code, HttpStatusCodes::getMessage($http_status_code))->sendHeaders();
        $this->setJsonContent($response);
        return $this->sendResponse();
    }


    /**
     * @param $data
     *
     * @return mixed
     */
    public function sendSuccess($data, $message = null) {
        $this->setStatusCode(200, HttpStatusCodes::getMessage(200))->sendHeaders();
        $this->setJsonContent([
            'status'  => self::RESPONSE_TYPE_SUCCESS,
            'message' => (is_null($message)) ? '' : $message,
            'data'    => $data,
            'code'    => 0,
        ]);

        return $this->sendResponse();
    }

    /**
     * @param            $data
     * @param int|string $http_status_code
     *
     * @return mixed|void
     */
    public function sendFail($message = null, $code = -1) {
        $this->setStatusCode(200, HttpStatusCodes::getMessage(200))->sendHeaders();
        $this->setJsonContent([
            'status' => self::RESPONSE_TYPE_FAIL,
            'message' => (is_null($message)) ? '' : $message,
            'code'   => $code,
        ]);

        return $this->sendResponse();
    }

    /**
     * Send response
     */
    public function sendResponse() {
        $this->setContentType("application/json");
        if (!$this->isSent()) {
            $this->send();
        }
    }
}

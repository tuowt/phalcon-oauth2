<?php

namespace App\Library;

/**
 * Class ResponseMessages
 * @package App\Library
 */
class ResponseMessages
{
    private static $messages = [
        ResponseCodes::METHOD_NOT_IMPLEMENTED => 'method not implemented',
        ResponseCodes::INTERNAL_SERVER_ERROR => 'an internal server error occurred',
        ResponseCodes::UNEXPECTED_ERROR => 'an unexpected error occurred',
    ];

    /**
     * @param $code
     * @return mixed
     */
    public static function getMessageFromCode($code)
    {
        if (array_key_exists($code, self::$messages)) {
            return self::$messages[$code];
        } else {
            return self::$messages[ResponseCodes::UNEXPECTED_ERROR];
        }
    }
}

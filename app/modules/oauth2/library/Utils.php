<?php

namespace App\Module\OAuth2\Library;

/**
 * Class Util
 * @package App\Module\OAuth2\Library
 */
trait Utils
{
    /**
     * @return bool|string
     */
    public function getCurrentDateTime()
    {
        return date('Y-m-d H:i:s');
    }

    /**
     * @return bool|string
     */
    public function getCurrentDate()
    {
        return date('Y-m-d');
    }

    /**
     * @param \DateTime $dateTime
     * @param string $format
     * @return string
     */
    public function formatDateTime(\DateTime $dateTime, $format = 'Y-m-d H:i:s')
    {
        return $dateTime->format($format);
    }
}

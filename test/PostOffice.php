<?php
/**
 * Created by PhpStorm.
 * User: cwei
 * Date: 2018/11/23
 * Time: 10:50 AM
 */

namespace App\Service;

class PostOffice extends AbstractLogic
{

    public function calcFee(array $weights) {
        return $this->loopWeights($weights, function ($val) {
            return 60 + $val * 20;
        });
    }
}
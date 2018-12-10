<?php
/**
 * Created by PhpStorm.
 * User: cwei
 * Date: 2018/11/23
 * Time: 10:43 AM
 */

namespace App\Service;

class BlackCat extends AbstractLogic
{

    public function calcFee(array $weights) {
        return $this->loopWeights($weights, function ($val) {
            return 100 + $val * 10;
        });
    }
}
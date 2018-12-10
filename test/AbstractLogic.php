<?php
/**
 * Created by PhpStorm.
 * User: cwei
 * Date: 2018/11/23
 * Time: 11:03 AM
 */

namespace App\Service;

class AbstractLogic
{

    protected function loopWeights(array $weights, callable $clouse) {
        $amount = 0;
        foreach ($weights as $val) {
            $amount += $clouse($val);
        }
        return $amount;
    }
}
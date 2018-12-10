<?php
/**
 * Created by PhpStorm.
 * User: cwei
 * Date: 2018/11/23
 * Time: 8:58 AM
 */

namespace App\Service;

class ShippingService
{

    /**
     * @param array $weights
     * @param       $company
     *
     * @return float|int
     */
    public function calcFee(array $weights, AbstractLogic $logic) {
        $amount = $logic->calcFee($weights);
        return $amount;
    }
}
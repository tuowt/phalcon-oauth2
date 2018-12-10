<?php
/**
 * Created by PhpStorm.
 * User: cwei
 * Date: 2018/11/23
 * Time: 11:31 AM
 */

namespace App\Service;

require './autoload.php';

$weights = [1, 2, 3];

try {
    $shippingService = new ShippingService();

    echo $shippingService->calcFee($weights, (new BlackCat())).'<br/>';

    echo $shippingService->calcFee($weights, new Hsinchu()).'<br/>';

    echo $shippingService->calcFee($weights, new PostOffice()).'<br/>';
} catch (\Exception $e) {
    echo '<pre>'.$e->getMessage().'</pre>';
}

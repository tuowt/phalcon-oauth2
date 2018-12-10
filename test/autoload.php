<?php
/**
 * Created by PhpStorm.
 * User: cwei
 * Date: 2018/11/23
 * Time: 11:52 AM
 */

class Autoloader {

    public static $_maps = [
        'App\\Service\\AbstractLogic' => './AbstractLogic.php',
        'App\\Service\\BlackCat' => './BlackCat.php',
        'App\\Service\\Hsinchu' => './Hsinchu.php',
        'App\\Service\\PostOffice' => './PostOffice.php',
        'App\\Service\\ShippingService' => './ShippingService.php'
    ];

    public static function loadClassLoader($name) {
        require self::$_maps[$name];
    }
}

spl_autoload_register(array('Autoloader', 'loadClassLoader'), true, true);

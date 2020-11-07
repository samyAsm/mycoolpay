<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 07/11/20
 * Time: 12:45
 */

namespace MyCoolPay\Setup;


class Setup
{
    public static function install()
    {
        mkdir(__DIR__.'/setup.yaml');
    }
}
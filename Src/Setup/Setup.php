<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 07/11/20
 * Time: 12:45
 */

namespace MyCoolPay\Setup;

use Composer\Script\Event;
use Composer\Installer\PackageEvent;

class Setup
{
    public static function install(Event $event)
    {
        mkdir(__DIR__.'/setup.yaml');
    }
}
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

    public static function postUpdate(Event $event)
    {
        $composer = $event->getComposer();
        // do stuff
        self::initConfigs();
    }

    public static function postPackageInstall(PackageEvent $event)
    {
        $installedPackage = $event->getOperation()->getPackage();
        // do stuff
        self::initConfigs();
    }

    protected static function initConfigs(){

        $config = fopen(__DIR__.'/setup.yaml', 'a+');

        if ($config){
            fclose($config);
            print_r("Config loaded");
        }else{
            print_r("Unable to create configs");
        }

    }
}
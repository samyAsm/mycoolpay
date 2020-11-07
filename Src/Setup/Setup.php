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
use Composer\Plugin\CommandEvent;

class Setup
{

    public static function command(CommandEvent $event)
    {
        print_r(get_class_methods(Event::class));
    }

    public static function postCmdUpdate(Event $event)
    {
        print_r(get_class_methods(Event::class));
        // do stuff
        self::initConfigs($event);
    }

    public static function postCmdInstall(Event $event)
    {
        // do stuff
        print_r(get_class_methods(Event::class));
        self::initConfigs($event);
    }

    public static function initConfigs(Event $event){

        $config = fopen('./../../../setup.yaml', 'a+');

        exec("touch ./../../setup.xml");

        if ($config){
            fclose($config);
            print_r("Config loaded \r\n");
        }else{
            print_r("Unable to create configs \r\n");
        }

    }
}
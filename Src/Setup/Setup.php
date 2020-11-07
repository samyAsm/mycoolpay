<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 07/11/20
 * Time: 12:45
 */

namespace MyCoolPay\Setup;

use Composer\Script\Event;

class Setup
{
    public static function postInstall(Event $event)
    {
        $installedPackage = $event->getComposer()->getPackage();
        // any tasks to run after the package is installed?
        mkdir(__DIR__.'setup.yaml');
    }
}
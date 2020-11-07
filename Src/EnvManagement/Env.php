<?php


/**
 * Class that retrieve and load env variables
 * */

namespace MyCoolPay\EnvManagement;

use Exception;

class Env
{
    static $Env = null;

    /**
     * load environment variables such as public & private key
     * @param array|null $env
     */
    public static function loadEnv(?array $env = [])
    {
        self::$Env = $env;
    }

    /**
     * @return array|null
     * @throws Exception
     */
    public static function getEnv():?array
    {
        return self::$Env;
    }

    /**
     * @return string|null
     * @throws Exception
     */
    public static function getPrivateKey():?string
    {
        return isset(self::$Env['MY_COOLPAY_PRIVATE'])?self::$Env['MY_COOLPAY_PRIVATE']:null;
    }

    /**
     * @return string|null
     * @throws Exception
     */
    public static function getPublicKey():?string
    {
        return isset(self::$Env['MY_COOLPAY_PUBLIC'])?self::$Env['MY_COOLPAY_PUBLIC']:null;
    }

    /**
     * @return string|null
     * @throws Exception
     */
    public static function getUserName():?string
    {
        return isset(self::$Env['CUSTOMER_USER_NAME'])?self::$Env['CUSTOMER_USER_NAME']:null;
    }

    /**
     * @return string|null
     * @throws Exception
     */
    public static function getCustomerPhoneNumber():?string
    {
        return isset(self::$Env['CUSTOMER_PHONE_NUMBER'])?self::$Env['CUSTOMER_PHONE_NUMBER']:null;
    }

    /**
     * @return string|null
     * @throws Exception
     */
    public static function getCustomerEmail():?string
    {
        return isset(self::$Env['CUSTOMER_EMAIL'])?self::$Env['CUSTOMER_EMAIL']:null;
    }

    /**
     * @return string|null
     * @throws Exception
     */
    public static function getAppName():?string
    {
        return isset(self::$Env['APP_NAME'])?self::$Env['APP_NAME']:null;
    }

}
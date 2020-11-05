<?php


/**
 * Class that retrieve and load env variables
 * */

class Env
{
    static $Env = null;

    /**
     * load environment variables such as public & private key
     * @throws Exception
     */
    public static function loadEnv()
    {
        if (self::$Env === null || self::$Env === [])
            self::parseEnvFromYaml();

        if (self::$Env === [])
            throw new Exception("Env not found");
    }

    /**
     * @return array|null
     * @throws Exception
     */
    public static function getEnv():?array
    {
        self::loadEnv();

        return self::$Env;
    }

    /**
     * @return string|null
     * @throws Exception
     */
    public static function getPrivateKey():?string
    {
        self::loadEnv();

        return isset(self::$Env['MY_COOLPAY_PRIVATE'])?self::$Env['MY_COOLPAY_PRIVATE']:null;
    }

    /**
     * @return string|null
     * @throws Exception
     */
    public static function getPublicKey():?string
    {
        self::loadEnv();
        return isset(self::$Env['MY_COOLPAY_PUBLIC'])?self::$Env['MY_COOLPAY_PUBLIC']:null;
    }

    /**
     * @return string|null
     * @throws Exception
     */
    public static function getUserName():?string
    {
        self::loadEnv();
        return isset(self::$Env['CUSTOMER_USER_NAME'])?self::$Env['CUSTOMER_USER_NAME']:null;
    }

    /**
     * @return string|null
     * @throws Exception
     */
    public static function getCustomerPhoneNumber():?string
    {
        self::loadEnv();
        return isset(self::$Env['CUSTOMER_PHONE_NUMBER'])?self::$Env['CUSTOMER_PHONE_NUMBER']:null;
    }

    /**
     * @return string|null
     * @throws Exception
     */
    public static function getCustomerEmail():?string
    {
        self::loadEnv();
        return isset(self::$Env['CUSTOMER_EMAIL'])?self::$Env['CUSTOMER_EMAIL']:null;
    }

    /**
     * @return string|null
     * @throws Exception
     */
    public static function getAppName():?string
    {
        self::loadEnv();
        return isset(self::$Env['APP_NAME'])?self::$Env['APP_NAME']:null;
    }

    /**
     * @return bool
     */
    static function parseEnvFromYaml():bool
    {

        try{
            if (!file_exists(self::getEnvPath()))
                throw new Exception("Env file not exists, please set the env.yaml file into Configs directory");

            self::$Env = YamlParser::parse(file_get_contents(self::getEnvPath()));

        }catch (Exception $exception){
            return false;
        }

        return true;
    }


    public static function getEnvPath()
    {
        //can be customized
        return __DIR__ . '/../../../Configs/env.yaml';
    }
}
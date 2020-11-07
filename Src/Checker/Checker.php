<?php

namespace MyCoolPay\Checker;

use Exception;
use MyCoolPay\EnvManagement\Env;

class Checker
{

    /**
     * @throws Exception
    */
    public static function checkConfigs():void
    {
        self::checkEnv();
    }

    /**
     * @throws Exception
     */
    private static function checkEnv():void
    {

        $ENV = Env::getEnv();

        if (!isset($ENV['MY_COOLPAY_PRIVATE']))
            throw new Exception("Private key not found, please set your private key on environment MY_COOLPAY_PRIVATE");

        if (!isset($ENV['MY_COOLPAY_PUBLIC']))
            throw new Exception("Public key not found, please set your public key on environment MY_COOLPAY_PUBLIC");

    }

    /**
     * check the request signature
     *
     * @param array $data
     * @return boolean
     * @throws Exception
     */
     public static function check_signature(array $data):bool
     {
         self::checkResponseContent($data);

         $signature_received = $data["signature"];

         $new_signature = $data["transaction_ref"] . $data["transaction_type"] . $data["transaction_amount"] .
             $data["transaction_currency"] . $data["transaction_operator"] . Env::getPrivateKey();

         $new_md5_signature = md5($new_signature);

         return $signature_received === $new_md5_signature;
    }

    /**
     * @param array $data
     * @throws Exception
     */
    private static function checkResponseContent(array $data):void
    {
         if (!isset($data['signature']))
             throw new  Exception("Unable to find signature");

         if (!isset($data['transaction_ref']))
             throw new  Exception("Unable to find transaction_ref");

         if (!isset($data['transaction_type']))
             throw new  Exception("Unable to find transaction_type");

         if (!isset($data['transaction_amount']))
             throw new  Exception("Unable to find transaction_amount");

         if (intval($data['transaction_amount']) <= 0)
             throw new  Exception("invalid transaction_amount");

         if (!isset($data['transaction_currency']))
             throw new  Exception("Unable to find transaction_currency");

         if (!isset($data['transaction_operator']))
             throw new  Exception("Unable to find transaction_operator");
    }

}
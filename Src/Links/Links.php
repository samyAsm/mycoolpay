<?php


/**
 * This class provide all necessary links for API communication
 * such as paylink, payout, check status
 * Links are generated according to your public key
**/

namespace MyCoolPay\Links;

use MyCoolPay\EnvManagement\Env;

class Links
{
    private const BASE_API_URL = "https://my-coolpay.com/api/";

    private const PAY_LINK_API_URL = "paylink";

    private const PAY_SYNC_LINK_API_URL = "pay";

    private const WITHDRAWAL_LINK_API_URL = "payout";

    private const CHECK_LINK_API_URL = "checkStatus";

    public static function getBaseAPIUrl():string
    {
        return self::BASE_API_URL;
    }

    public static function getPaymentAPILink():string
    {
        return self::BASE_API_URL.Env::getPublicKey().self::slash().self::PAY_LINK_API_URL;
    }

    public static function getSyncPaymentAPILink():string
    {
        return self::BASE_API_URL.Env::getPublicKey().self::slash().self::PAY_SYNC_LINK_API_URL;
    }

    public static function getPayoutAPILink():string
    {
        return self::BASE_API_URL.Env::getPublicKey().self::slash().self::WITHDRAWAL_LINK_API_URL;
    }

    public static function getCheckStatusAPILink():string
    {
        return self::BASE_API_URL.Env::getPublicKey().self::slash().self::CHECK_LINK_API_URL;
    }

    public static function slash()
    {
        return "/";
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 07/11/20
 * Time: 07:26
 */

namespace MyCoolPay\Test;

class Test
{
    protected $mcp;

    /**
     * Test constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->mcp = new MCPTest();
    }

    public function testPayment()
    {
        $payment_parameters = [
            'transaction_amount' => 100,
            'transaction_reason' => "Testing MCP integration reason",
            'customer_phone_number' => "690547092",
            'customer_username' => "samy",
            'customer_name' => "Samuel",
            'app_transaction_ref' => time(),
            'customer_email' => "samuel@gmail.com",
            'customer_lang' => "fr",
        ];

        $response =  $this->mcp->getPaymentLink($payment_parameters, 5,8,false);
        // if succeed, got something like https://my-coolpay.com/payment/checkout/xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx
        print_r($response);
        die();
    }
}
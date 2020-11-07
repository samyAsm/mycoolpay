<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 07/11/20
 * Time: 09:16
 */

namespace MyCoolPay;


interface MCPInterface
{

    /**
     * This function is responsible of all process you want to do before to retrieve a payment link
     * @param $user_identifier
     * @param $product_ref
     * @param $transaction_ref
     * @return bool
     */

    function save_transaction_before_call_api($user_identifier, $product_ref , $transaction_ref);


    /**
     * This function is responsible of all process you want to do at the callback payment
     * Will be called if payment type is PAYIN
     * @param array $payload
     */

    function trigger_callback_of_payin_transaction(array $payload);


    /**
     * This function is responsible of all process you want to do at the callback payment
     * Will be called if payment type is PAYOUT
     * @param array $payload
     */

    function trigger_callback_of_payout_transaction(array $payload);


    /**
     * This function is responsible of logging issues with payments
     * @param $payload
     * @param string $message
     */

    function trigger_logger($payload, string $message);


    /**
     * This function must check if user has successfully paid for given product
     * @param $user_identifier
     * @param $product_ref
     * @return bool
     */

    function check_if_user_has_paid_product($user_identifier, $product_ref);
}
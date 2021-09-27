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
     * @param array $transaction_payload
     * @return bool
     */

    function save_transaction_before_call_api(array $transaction_payload);


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
     * @param array $payload
     * @param \Throwable $throwable
     */

    function trigger_logger(array $payload, \Throwable $throwable);


    /**
     * This function must check if user has successfully paid for given product
     * @param array $payload
     * @return bool
     */

    function check_if_user_has_paid_product(array $payload);
}
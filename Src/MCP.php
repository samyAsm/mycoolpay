<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 07/11/20
 * Time: 08:52
 */

namespace MyCoolPay;


use Exception;
use MyCoolPay\Checker\Checker;
use MyCoolPay\Gateway\Gateway;

class MCP
{

    public function __construct()
    {

        $needed_methods = get_class_methods(MCPInterface::class);

        foreach ($needed_methods as $index => $method) {
            if (!method_exists($this, $method)){
                throw new \Exception(__CLASS__." 
                must implement the PasswordViewRenderer and define the ".implode(",", $needed_methods)." method");
            }
        }
    }

    /**
     * @param array $request_parameters
     * @return bool
     */
    public final function callback(array $request_parameters){

        try{

            if (!isset($request_parameters["transaction_type"]))
                return false;

            // Must check MCP request signature before any process on callback
            Checker::check_signature($request_parameters);

            // when signature is valid, we process the callback

            if ($request_parameters["transaction_type"] === "PAYIN"){
                $this->trigger_callback_of_payin_transaction($request_parameters);
            }else{
                $this->trigger_callback_of_payout_transaction($request_parameters);
            }

            return true;
        }catch (Exception $exception){
            $this->trigger_logger($request_parameters,$exception->getMessage());
        }

        return false;
    }


    /**
     * @param array $payment_parameters
     * @param $user_identifier
     * @param $product_ref
     * @param bool $redirect_on_success
     * @return array|null|string
     */
    public final function getPaymentLink(array $payment_parameters, $user_identifier, $product_ref,
                                         $redirect_on_success = false){

        $response = null;

        try{

            if (!$this->save_transaction_before_call_api($user_identifier, $product_ref, $payment_parameters['app_transaction_ref']))
                throw new Exception("Can not save trnsaction");

            $processor = new Gateway();

            $response = $processor->getPaymentLink($payment_parameters);

            if (!isset($response['payment_url']))
                throw new Exception("Payment url not found");

            if ($redirect_on_success && isset($response['payment_url']))
                header("Location: " . $response['payment_url'] . "");

            return $response['payment_url'];

        }catch (Exception $exception){
            return $exception->getMessage();
        }

    }


    /**
     * @param array $payout_parameters
     * @return array|null
     */
    public final function payout(array $payout_parameters){

        $response = null;

        try{

            $processor = new Gateway();

            $response = $processor->payout($payout_parameters);

            return $response;

        }catch (Exception $exception){
            return [
                "error" => $exception->getMessage()
            ];
        }

    }


    /**
     * @param array $payload
     * @return array|null
     */
    public final function checkStatus(array $payload){

        $response = null;

        try{

            $processor = new Gateway();

            $response = $processor->checkTransactionStatus($payload);

            return $response;

        }catch (Exception $exception){
            return [
                "error" => $exception->getMessage()
            ];
        }

    }
}
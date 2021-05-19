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
use MyCoolPay\EnvManagement\Env;
use MyCoolPay\Gateway\Gateway;

class MCP
{

    protected $original_response;

    /**
     * MCP constructor.
     * @param array|null $environment
     * @throws Exception
     */
    public function __construct(array $environment = ['MY_COOLPAY_PUBLIC' => null, 'MY_COOLPAY_PRIVATE' => null])
    {

        $needed_methods = get_class_methods(MCPInterface::class);

        foreach ($needed_methods as $index => $method) {
            if (!method_exists($this, $method)){
                throw new \Exception(__CLASS__." 
                must implement the PasswordViewRenderer and define the ".implode(",", $needed_methods)." methods");
            }
        }

        Env::loadEnv($environment);
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
                throw new Exception("Can not save transaction");

            $processor = new Gateway();

            $this->original_response = $processor->getPaymentLink($payment_parameters);

            if (!isset($this->original_response['payment_url']))
                throw new Exception("Payment url not found");

            if ($redirect_on_success && isset($this->original_response['payment_url']))
                header("Location: " . $this->original_response['payment_url'] . "");

            return $this->original_response['payment_url'];

        }catch (Exception $exception){
            return $exception->getMessage();
        }

    }

    /**
     * @param array $payment_parameters
     * @param $user_identifier
     * @param $product_ref
     * @return array|null|string
     */
    public final function syncPayment(array $payment_parameters, $user_identifier, $product_ref){

        $response = null;

        try{

            if (!$this->save_transaction_before_call_api($user_identifier, $product_ref, $payment_parameters['app_transaction_ref']))
                throw new Exception("Can not save transaction");

            $processor = new Gateway();

            $this->original_response = $processor->syncPayment($payment_parameters);

            return $this->original_response;

        }catch (Exception $exception){
            return $exception->getMessage();
        }

    }


    /**
     * @param array $payout_parameters
     * @return array|null
     */
    public final function payout(array $payout_parameters){

        try{

            $processor = new Gateway();

            $this->original_response = $processor->payout($payout_parameters);

            return $this->original_response;

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

        try{

            $processor = new Gateway();

            $this->original_response = $processor->checkTransactionStatus($payload);

            return $this->original_response;

        }catch (Exception $exception){
            return [
                "error" => $exception->getMessage()
            ];
        }

    }

    /**
     * @return mixed
     */
    public function getOriginalResponse()
    {
        return $this->original_response;
    }

}
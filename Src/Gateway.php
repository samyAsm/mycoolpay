<?php

namespace MyCoolPay;

use Exception;
use MyCoolPay\Checker\Checker;
use MyCoolPay\Curl\Curl;
use MyCoolPay\Links\Links;
use MyCoolPay\Parameter\Parameter;
use MyCoolPay\Response\CoolPaymentResponse;

class Gateway
{
    private $curl;

    private $response;

    private $parameter;

    public function __construct()
    {
        $this->curl = new Curl();
        $this->response = new CoolPaymentResponse();
        $this->parameter = new Parameter();
    }

    /**
     * @param array $payload
     * @return array
     * @throws Exception
     */
    final public function getPaymentLink(array $payload): array
    {
        try{
            $this->loadAndValidatePaymentParameters($payload);
            //setting url
            $this->curl->setLink(Links::getPaymentAPILink());
            //setting request parameter
            $this->curl->setPostRequestParams($this->parameter->toArray());
            //perform request
            $this->curl->executeRequest();
            //transform response to object
            $this->response->makeFromJson($this->curl->getResponse());
            //serialize and return serialized
            return $this->response->toArray();

        }catch (Exception $exception){
            $this->curl->close();
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @param array $payload
     * @return array|null
     * @throws Exception
     */
    final public function checkTransactionStatus(array $payload): ?array
    {
        try{
            $this->loadAndValidatePaymentParameters($payload);
            //setting url
            $this->curl->setLink(Links::getCheckStatusAPILink());
            //setting request parameter
            $this->curl->setPostRequestParams($this->parameter->toArray());
            //perform request
            $this->curl->executeRequest();

            $this->response->makeFromJson($this->curl->getResponse());

            return $this->response->toArray();

        }catch (Exception $exception){
            $this->curl->close();
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @param array $payload
     * @return array|null
     * @throws Exception
     */
    final public function payout(array $payload): ?array
    {
        try{
            //must add keys on parameter
            $this->loadAndValidatePayoutParameters($payload);
            //setting url
            $this->curl->setLink(Links::getPayoutAPILink());
            //setting request parameter
            $this->curl->setPostRequestParams($this->parameter->toArray());
            //disable the return transfer
            $this->curl->setReturnTransfer(true);
            //disable the return header
            $this->curl->setReturnHeaderOnResponse(false);
            //perform request
            $this->curl->executeRequest();

            if (preg_match("#Redirecting#", htmlspecialchars($this->curl->getResponse())))
                throw new Exception("Ip not authorized");

            $this->response->makeFromJson($this->curl->getResponse());

            return $this->response->toArray();

        }catch (Exception $exception){
            $this->curl->close();
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @param array $payload
     * @throws Exception
     */
    private function loadAndValidatePaymentParameters(array $payload): void
    {
        //check configs
        Checker::checkConfigs();
        //load parameters
        $this->parameter->loadFromArray($payload);
        //check parameters validity
        $this->parameter->validateForPayment();
    }

    /**
     * @param array $payload
     * @throws Exception
     */
    private function loadAndValidatePayoutParameters(array $payload): void
    {
        //check configs
        Checker::checkConfigs();

        //load user credentials from env if they are not set
        if (!isset($payload['customer_phone_number'])
            && !isset($payload['customer_email'])
            && !isset($payload['customer_username'])
        ){
            $this->parameter->addUserCredentials();
        }
        //load parameters

        $this->parameter->loadFromArray($payload);
        //for payout, we add private key on request
        $this->parameter->addPrivateKey();
        //check parameters validity
        $this->parameter->validateForPayout();
    }

}
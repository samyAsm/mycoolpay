<?php

namespace MyCoolPay\Response;

class CoolResponse
{

    /**
     * @var string $application
     */
    protected $application; // application parameter
    /**
     * @var string $app_transaction_ref
     */
    protected $app_transaction_ref; // app_transaction_ref parameter
    /**
     * @var string $operator_transaction_ref
     */
    protected $operator_transaction_ref; // operator_transaction_ref parameter
    /**
     * @var string $transaction_ref
     */
    protected $transaction_ref; // transaction_ref parameter
    /**
     * @var string $transaction_type
     *
     */
    protected $transaction_type; // transaction_type parameter
    /**
     * @var string $transaction_amount
     */
    protected $transaction_amount; // transaction_amount parameter
    /**
     * @var string $transaction_currency
     */
    protected $transaction_currency; // transaction_currency parameter
    /**
     * @var string $transaction_operator
     */
    protected $transaction_operator; // transaction_operator parameter
    /**
     * @var string $transaction_status
     */
    protected $transaction_status; // transaction_status parameter
    /**
     * @var string $transaction_reason
     */
    protected $transaction_reason; // transaction_reason parameter
    /**
     * @var string $customer_phone_number
     */
    protected $customer_phone_number; // customer_phone_number parameter
    /**
     * @var string $signature
     */
    protected $signature; // signature parameter

    /**
     * @var string|null $status
     */
    protected $status;

    /**
     * @var string|null $ussd
     */
    protected $ussd;

    /**
     * @var string|null $link
     */
    protected $link;

    /**
     * @var string|null $action
     */
    protected $action;

    /**
     * @var string|null $error
     */
    protected $error;

    /**
     * @var string|null $message
     */
    protected $message;

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param mixed $error
     */
    public function setError($error): void
    {
        $this->error = $error;
    }

    /**
     * @return mixed
     */
    public function getApplication():?string
    {
        return $this->application;
    }

    /**
     * @param string|null $application
     * @return CoolResponse
     */
    public function setApplication(?string $application):?string
    {
        $this->application = $application;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAppTransactionRef():?string
    {
        return $this->app_transaction_ref;
    }

    /**
     * @param string|null $app_transaction_ref
     * @return CoolResponse
     */
    public function setAppTransactionRef(?string $app_transaction_ref):?string
    {
        $this->app_transaction_ref = $app_transaction_ref;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOperatorTransactionRef():?string
    {
        return $this->operator_transaction_ref;
    }

    /**
     * @param string|null $operator_transaction_ref
     * @return CoolResponse
     */
    public function setOperatorTransactionRef(?string $operator_transaction_ref):?string
    {
        $this->operator_transaction_ref = $operator_transaction_ref;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTransactionRef():?string
    {
        return $this->transaction_ref;
    }

    /**
     * @param string|null $transaction_ref
     * @return CoolResponse
     */
    public function setTransactionRef(?string $transaction_ref):?string
    {
        $this->transaction_ref = $transaction_ref;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTransactionType():?string
    {
        return $this->transaction_type;
    }

    /**
     * @param string|null $transaction_type
     * @return CoolResponse
     */
    public function setTransactionType(?string $transaction_type):?string
    {
        $this->transaction_type = $transaction_type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTransactionAmount():?string
    {
        return $this->transaction_amount;
    }

    /**
     * @param string|null $transaction_amount
     * @return CoolResponse
     */
    public function setTransactionAmount(?string $transaction_amount):?string
    {
        $this->transaction_amount = $transaction_amount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTransactionCurrency():?string
    {
        return $this->transaction_currency;
    }

    /**
     * @param string|null $transaction_currency
     * @return CoolResponse
     */
    public function setTransactionCurrency(?string $transaction_currency):?string
    {
        $this->transaction_currency = $transaction_currency;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTransactionOperator():?string
    {
        return $this->transaction_operator;
    }

    /**
     * @param string|null $transaction_operator
     * @return CoolResponse
     */
    public function setTransactionOperator(?string $transaction_operator):?string
    {
        $this->transaction_operator = $transaction_operator;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTransactionStatus():?string
    {
        return $this->transaction_status;
    }

    /**
     * @param string|null $transaction_status
     * @return CoolResponse
     */
    public function setTransactionStatus(?string $transaction_status):?string
    {
        $this->transaction_status = $transaction_status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTransactionReason():?string
    {
        return $this->transaction_reason;
    }

    /**
     * @param string|null $transaction_reason
     * @return CoolResponse
     */
    public function setTransactionReason(?string $transaction_reason):?string
    {
        $this->transaction_reason = $transaction_reason;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomerPhoneNumber():?string
    {
        return $this->customer_phone_number;
    }

    /**
     * @param string|null $customer_phone_number
     * @return CoolResponse
     */
    public function setCustomerPhoneNumber(?string $customer_phone_number):?string
    {
        $this->customer_phone_number = $customer_phone_number;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSignature():?string
    {
        return $this->signature;
    }

    /**
     * @param string|null $signature
     * @return CoolResponse
     */
    public function setSignature(?string $signature):?string
    {
        $this->signature = $signature;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'application' => $this->application,
            'app_transaction_ref' => $this->app_transaction_ref,
            'operator_transaction_ref' => $this->operator_transaction_ref,
            'transaction_ref' => $this->transaction_ref,
            'transaction_type' => $this->transaction_type,
            'transaction_amount' => $this->transaction_amount,
            'transaction_currency' => $this->transaction_currency,
            'transaction_operator' => $this->transaction_operator,
            'transaction_status' => $this->transaction_status,
            'transaction_reason' => $this->transaction_reason,
            'customer_phone_number' => $this->customer_phone_number,
            'signature' => $this->signature,
        ];
    }

    /**
     * @param string $response
     */
    public function makeFromJson(string $response)
    {
        $response = json_decode($response, true);

        $this->application = $response['application'];
        $this->app_transaction_ref = $response['app_transaction_ref'];
        $this->operator_transaction_ref = $response['operator_transaction_ref'];
        $this->transaction_ref = $response['transaction_ref'];
        $this->transaction_type = $response['transaction_type'];
        $this->transaction_amount = $response['transaction_amount'];
        $this->transaction_currency = $response['transaction_currency'];
        $this->transaction_operator = $response['transaction_operator'];
        $this->transaction_status = $response['transaction_status'];
        $this->transaction_reason = $response['transaction_reason'];
        $this->customer_phone_number = $response['customer_phone_number'];
        $this->signature = $response['signature'];
    }

    /**
     * @return string|null
     */
    final public function getStatus():?string
    {
        return strtoupper($this->status);
    }

    /**
     * @param string|null $status
     */
    final public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @return string|null
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string|null $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

    /**
     * @return string|null
     */
    public function getUssd(): ?string
    {
        return $this->ussd;
    }

    /**
     * @param string|null $ussd
     */
    public function setUssd(?string $ussd): void
    {
        $this->ussd = $ussd;
    }
}
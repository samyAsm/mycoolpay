<?php

namespace MyCoolPay\Parameter;

use Exception;
use MyCoolPay\EnvManagement\Env;

class Parameter
{

    /**
     * @var string|null $transaction_amount
     */
    public $transaction_amount;
    /**
     * @var string|null $transaction_reason
     */
    public $transaction_reason;
    /**
     * @var string|null $app_transaction_ref
     */
    public $app_transaction_ref;
    /**
     * @var string|null $customer_name
     */
    public $customer_name;
    /**
     * @var string|null $customer_phone_number
     */
    public $customer_phone_number;
    /**
     * @var string|null $customer_email
     */
    public $customer_email;
    /**
     * @var string|null $customer_lang
     */
    public $customer_lang;
    /**
     * @var string|null $private_key
     */
    public $private_key;
    /**
     * @var string|null $public_key
     */
    public $public_key;
    /**
     * @var string|null $transaction_operator
     */
    public $transaction_operator;
    /**
     * @var string|null $customer_username
     */
    public $customer_username;

    public function __construct()
    {
        $this->private_key = Env::getPrivateKey();

        $this->public_key = Env::getPublicKey();

        $this->init();
    }

    /**
     *
     */
    public function init()
    {
        $this->transaction_amount = 2;
        $this->transaction_reason = 'Some reason';
        $this->app_transaction_ref = time();
        $this->customer_name = 'Customer name';
        $this->customer_phone_number = '';
        $this->customer_email = 'somecustomer@email.com';
        $this->customer_lang = 'FR'; // EN
        $this->private_key = '';
        $this->public_key = '';
        $this->transaction_operator = 'CM_OM'; // MCP|CM_MOMO|CM_OM|CARD
        $this->customer_username = '';
    }

    public function addPrivateKey()
    {
        $this->private_key = Env::getPrivateKey();
    }

    public function addUserCredentials()
    {
        $this->customer_username = Env::getUserName();
        $this->customer_email = Env::getCustomerEmail();
        $this->customer_phone_number = Env::getCustomerPhoneNumber();
    }

    /**
     * @param array $payload
     */
    final public function loadFromArray(array $payload)
    {
        if (isset($payload['transaction_amount'])){
            $this->transaction_amount = $payload['transaction_amount'];
        }
        if (isset($payload['transaction_reason'])){
            $this->transaction_reason = $payload['transaction_reason'];
        }
        if (isset($payload['app_transaction_ref'])){
            $this->app_transaction_ref = $payload['app_transaction_ref'];
        }
        if (isset($payload['customer_name'])){
            $this->customer_name = $payload['customer_name'];
        }
        if (isset($payload['customer_phone_number'])){
            $this->customer_phone_number = $payload['customer_phone_number'];
        }
        if (isset($payload['customer_email'])){
            $this->customer_email = $payload['customer_email'];
        }
        if (isset($payload['customer_lang'])){
            $this->customer_lang = $payload['customer_lang'];
        }
        if (isset($payload['private_key'])){
            $this->private_key = $payload['private_key'];
        }
        if (isset($payload['public_key'])){
            $this->public_key = $payload['public_key'];
        }
        if (isset($payload['transaction_operator '])){
            $this->transaction_operator = $payload['transaction_operator '];
        }
        if (isset($payload['customer_username'])){
            $this->customer_username = $payload['customer_username'];
        }
    }

    /**
     * @throws Exception
     */
    final public function validateForPayment():?bool
    {
        if ((intval($this->transaction_amount) < 0))
            throw new Exception("Invalid transaction amount");

        if (strlen(trim($this->transaction_reason)) < 5)
            throw new Exception("Please set a valid transaction reason, at leas 5 characters");

        if (strlen(trim($this->app_transaction_ref)) < 4)
            throw new Exception("Please set a valid app_transaction_ref, at leas 4 characters");

        return true;
    }

    /**
     * @throws Exception
     */
    final public function validateForPayout():?bool
    {
        if (!$this->private_key)
            throw new Exception("Please set your private key");

        if (intval($this->transaction_amount) < 0)
            throw new Exception("Invalid transaction amount");

        if (strlen(trim($this->transaction_reason)) < 5)
            throw new Exception("Please set a valid transaction, at leas 5 characters");

        if (strlen(trim($this->app_transaction_ref)) < 4)
            throw new Exception("Please set a valid app_transaction_ref, at leas 4 characters");

        return true;
    }

    /**
     * @return array
     */
    final public function toArray(): array
    {
        return array_filter([
            'transaction_amount' => $this->transaction_amount,
            'transaction_reason' => $this->transaction_reason,
            'app_transaction_ref' => $this->app_transaction_ref,
            'customer_name' => $this->customer_name,
            'customer_phone_number' => $this->customer_phone_number,
            'customer_email' => $this->customer_email,
            'customer_lang' => $this->customer_lang,
            'private_key' => $this->private_key,
            'public_key' => $this->public_key,
            'transaction_operator' => $this->transaction_operator,
            'customer_username' => $this->customer_username,
        ]);
    }

    /**
     * @return array
     */
    public function toArrayWithoutPrivate()
    {
        $parameters = $this->toArray();

        unset($parameters['private_key']);

        return $parameters;
    }

    /**
     * @return string|null
     */
    public function getTransactionAmount(): ?string
    {
        return $this->transaction_amount;
    }

    /**
     * @param string|null $transaction_amount
     * @return Parameter
     */
    public function setTransactionAmount(?string $transaction_amount): Parameter
    {
        $this->transaction_amount = $transaction_amount;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTransactionReason(): ?string
    {
        return $this->transaction_reason;
    }

    /**
     * @param string|null $transaction_reason
     * @return Parameter
     */
    public function setTransactionReason(?string $transaction_reason): Parameter
    {
        $this->transaction_reason = $transaction_reason;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAppTransactionRef(): ?string
    {
        return $this->app_transaction_ref;
    }

    /**
     * @param string|null $app_transaction_ref
     * @return Parameter
     */
    public function setAppTransactionRef(?string $app_transaction_ref): Parameter
    {
        $this->app_transaction_ref = $app_transaction_ref;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCustomerName(): ?string
    {
        return $this->customer_name;
    }

    /**
     * @param string|null $customer_name
     * @return Parameter
     */
    public function setCustomerName(?string $customer_name): Parameter
    {
        $this->customer_name = $customer_name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCustomerPhoneNumber(): ?string
    {
        return $this->customer_phone_number;
    }

    /**
     * @param string|null $customer_phone_number
     * @return Parameter
     */
    public function setCustomerPhoneNumber(?string $customer_phone_number): Parameter
    {
        $this->customer_phone_number = $customer_phone_number;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCustomerEmail(): ?string
    {
        return $this->customer_email;
    }

    /**
     * @param string|null $customer_email
     * @return Parameter
     */
    public function setCustomerEmail(?string $customer_email): Parameter
    {
        $this->customer_email = $customer_email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCustomerLang(): ?string
    {
        return $this->customer_lang;
    }

    /**
     * @param string|null $customer_lang
     * @return Parameter
     */
    public function setCustomerLang(?string $customer_lang): Parameter
    {
        $this->customer_lang = $customer_lang;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPrivateKey(): ?string
    {
        return $this->private_key;
    }

    /**
     * @param string|null $private_key
     * @return Parameter
     */
    public function setPrivateKey(?string $private_key): Parameter
    {
        $this->private_key = $private_key;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPublicKey(): ?string
    {
        return $this->public_key;
    }

    /**
     * @param string|null $public_key
     * @return Parameter
     */
    public function setPublicKey(?string $public_key): Parameter
    {
        $this->public_key = $public_key;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTransactionOperator(): ?string
    {
        return $this->transaction_operator;
    }

    /**
     * @param string|null $transaction_operator
     * @return Parameter
     */
    public function setTransactionOperator(?string $transaction_operator): Parameter
    {
        $this->transaction_operator = $transaction_operator;
        return $this;
    }

    /**
     * @return string|null
     */
    public final function getCustomerUsername(): ?string
    {
        return $this->customer_username;
    }

    /**
     * @param string|null $customer_username
     * @return Parameter
     */
    public function setCustomerUsername(?string $customer_username): Parameter
    {
        $this->customer_username = $customer_username;
        return $this;
    }

}
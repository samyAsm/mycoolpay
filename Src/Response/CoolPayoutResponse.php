<?php

namespace MyCoolPay\Response;

class CoolPayoutResponse  extends CoolResponse
{
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

    public function makeFromJson(string $response)
    {
        $response = json_decode($response, true);

        if (isset($response['status']))
            $this->status = $response['status'];
        if (isset($response['message']))
            $this->message = $response['message'];

    }
}
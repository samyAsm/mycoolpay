<?php

namespace MyCoolPay\Response;

class CoolPaymentResponse extends CoolResponse
{

    protected $payment_url;

    public function makeFromJson(string $response)
    {
        $response = json_decode($response, true);

        if (isset($response['status']))
            $this->status = $response['status'];
        if (isset($response['payment_url']))
            $this->payment_url = $response['payment_url'];
        if (isset($response['error']))
            $this->error = $response['error'];
        if (isset($response['message']))
            $this->message = $response['message'];
        if (isset($response['action']))
            $this->action = $response['action'];
        if (isset($response['transaction_ref']))
            $this->transaction_ref = $response['transaction_ref'];
        if (isset($response['ussd']))
            $this->ussd = $response['ussd'];
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_filter([
            'status' => $this->status,
            'payment_url' => $this->payment_url,
            'error' => $this->error,
            'action' => $this->action,
            'message' => $this->message,
            'transaction_ref' => $this->transaction_ref,
            'ussd' => $this->ussd,
        ]);
    }

    /**
     * @return string|null
     */
    public function getPaymentUrl()
    {
        return $this->payment_url;
    }

    /**
     * @param string $payment_url
     */
    public function setPaymentUrl($payment_url): void
    {
        $this->payment_url = $payment_url;
    }
}
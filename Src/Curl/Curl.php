<?php


/**
 * This is a small class that performs basic curl actions
**/

namespace MyCoolPay\Curl;

use MyCoolPay\Status\Status;

class Curl
{
    private $curl;

    private $response;

    private $error;

    public function __construct()
    {
        $this->init();
    }

    /**
     *Init curl and default curl settings
     */
    private function init(){
        $this->curl = curl_init();

        $this->setReturnHeaderOnResponse(false);

        $this->setRequestTypeToPost();

        $this->setReturnTransfer(true);
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Link of resource to call
     * @param string $link
     */
    public function setLink($link)
    {
        curl_setopt($this->curl, CURLOPT_URL, $link);
    }


    public function setReturnTransfer($return_transfer = true)
    {
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, $return_transfer);
    }

    public function setReturnHeaderOnResponse($return_header = true)
    {
        curl_setopt($this->curl, CURLOPT_HEADER, $return_header);
    }

    public function setRequestTypeToPost()
    {
        curl_setopt($this->curl, CURLOPT_POST, true);
    }

    public function setRequestTypeToGet()
    {
        curl_setopt($this->curl, CURLOPT_POST, false);
    }

    /**
     * @param $parameters
     */
    public function setPostRequestParams($parameters)
    {
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $parameters);
    }

    public function executeRequest()
    {
        $this->response = curl_exec($this->curl);

        return $this->response;
    }

    public function close()
    {
        curl_close($this->curl);
    }

    /**
     * Can be use to check whether the response has end with a success
     * @param array $response
     * @return bool
     */
    function response_is_success(array $response)
    {
        return (isset($response['status']) && $response['status'] == Status::success());
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }
}
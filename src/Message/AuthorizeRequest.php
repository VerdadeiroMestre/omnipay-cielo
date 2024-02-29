<?php

namespace Omnipay\Cielo\Message;

/**
 * AuthorizeRequest class
 */
class AuthorizeRequest extends AbstractRequest
{
    protected $endpointBase = 'requests';
    protected $requestMethod = 'POST';

    /**
     * Get the data for this Request
     *
     * @return array
     */
    public function getData(): array
    {
        $this->validate('MerchantOrderId', 'Payment');
        
        $data = array(
            "MerchantOrderId"   => $this->getMerchantOrderId(),
            "Customer"          => $this->getCustomer() ? $this->getCustomer()->getData() : null,
            "Payment"           => $this->getPayment()->getData()
        );        

        return $data;
    }

    /**
     * Get the endpoint
     *
     * @return string URL
     */ 
    public function getEndpoint(): string
    {
        return parent::getEndpoint().'1/sales';
    }

    /**
     * Create Response
     * 
     * @param array $data 
     * @return AuthorizeResponse
     */
    protected function createResponse(array $data)
    {
        return $this->response = new AuthorizeResponse($this, $data);
    }
}
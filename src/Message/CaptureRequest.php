<?php

namespace Omnipay\Cielo\Message;

/**
 * CaptureRequest class
 */
class CaptureRequest extends AbstractRequest
{   
    protected $endpointBase = 'requests';
    protected $requestMethod = 'PUT';

    /**
     * Get the payment id
     * 
     * @return string
     */
    public function getPaymentId()
    {
        return $this->getParameter('PaymentId');
    }

    /**
     * Set the payment id
     * 
     * @param string $value
     */
    public function setPaymentId($value)
    {
        return $this->setParameter('PaymentId', $value);
    }

    /**
     * Get the data for this Request
     *
     * @return array
     */
    public function getData(): array
    {
        $data = [
            '' => '',
        ];

        return $data;
    }

    /**
     * Get the endpoint
     *
     * @return string URL
     */ 
    public function getEndpoint(): string
    {
        $amount = $this->getAmount() ? '?amount='.$this->getAmountInteger() : '';
        return parent::getEndpoint().'1/sales/'.$this->getPaymentId().$amount.'/capture';
    }

    /**
     * Create Response
     * 
     * @param array $data 
     * @return CaptureResponse
     */
    protected function createResponse(array $data)
    {
        return new CaptureResponse($this, $data);
    }

}
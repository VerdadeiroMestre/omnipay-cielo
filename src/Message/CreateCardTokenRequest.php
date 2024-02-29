<?php

namespace Omnipay\Cielo\Message;

/**
 * CreateCardTokenRequest class
 */
class CreateCardTokenRequest extends AbstractRequest
{
    protected $endpointBase = 'requests';
    protected $requestMethod = 'POST';

    /**
     * Get the customer name
     * 
     * @return string
     */
    public function getCustomerName()
    {
        return $this->getParameter('CustomerName');
    }

    /**
     * Set the customer name
     * 
     * @param string $value
     */
    public function setCustomerName($value)
    {
        return $this->setParameter('CustomerName', $value);
    }

     /**
     * Get the Card Number
     * 
     * @return array
     */
    public function getCardNumber()
    {
        return $this->getParameter('CardNumber');
    }

    /**
     * Set the Card Number
     * 
     * @param array $value
     */
    public function setCardNumber($value)
    {
        return $this->setParameter('CardNumber', $value);
    }

     /**
     * Get the Holder
     * 
     * @return array
     */
    public function getHolder()
    {
        return $this->getParameter('Holder');
    }

    /**
     * Set the Holder
     * 
     * @param array $value
     */
    public function setHolder($value)
    {
        return $this->setParameter('Holder', $value);
    }

     /**
     * Get the ExpirationDate
     * 
     * @return array
     */
    public function getExpirationDate()
    {
        return $this->getParameter('ExpirationDate');
    }

    /**
     * Set the ExpirationDate
     * 
     * @param array $value
     */
    public function setExpirationDate($value)
    {
        return $this->setParameter('ExpirationDate', $value);
    }

     /**
     * Get the Brand
     * 
     * @return array
     */
    public function getBrand()
    {
        return $this->getParameter('Brand');
    }

    /**
     * Set the Brand
     * 
     * @param array $value
     */
    public function setBrand($value)
    {
        return $this->setParameter('Brand', $value);
    }

    public function getData(): array
    {   
        $this->validate('CustomerName', 'CardNumber', 'Holder', 'ExpirationDate', 'Brand');

        $data = array(
            "CustomerName"      => $this->getCustomerName(),
            "CardNumber"        => $this->getCardNumber(),
            "Holder"            => $this->getHolder(),
            "ExpirationDate"    => $this->getExpirationDate(),
            "Brand"             => $this->getBrand()
        );

        return $data;
    }
    
    public function getEndpoint(): string
    {
        return parent::getEndpoint().'1/card/';
    }

    /**
     * Create Response
     * 
     * @param array $data 
     * @return PurchaseResponse
     */
    protected function createResponse(array $data)
    {
        return $this->response = new CreateCardTokenResponse($this, $data);
    }
}
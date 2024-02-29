<?php

namespace Omnipay\Cielo\Message;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * AuthorizeResponse class
 */
class AuthorizeResponse extends AbstractResponse
{
    /**
     * Is the response successful?
     *
     * @return bool 
     */
    public function isSuccessful(): bool
    {
        return isset($this->data['Payment']['Status']);
    }

    /**
     * Get the transaction reference and|or the payment id
     *
     * @return array
     */
    public function getTransactionReference()
    {
        $tid = array();
        if(isset($this->data['Payment']['Tid'])){
            $tid['Tid'] = $this->data['Payment']['Tid'];
        }
        if(isset($this->data['Payment']['PaymentId'])){
            $tid['PaymentId'] = $this->data['Payment']['PaymentId'];
        }
        
        return $tid;
    }

    /**
     * Get the customer reference
     *
     * @return string|null
     */
    public function getCustomerReference(): ?array
    {
        return $this->data['Customer'] ?? null;
    }

    /**
     * Get the payment reference
     *
     * @return string|null
     */
    public function getPaymentReference(): ?array
    {
        return $this->data['Payment'] ?? null;
    }
}
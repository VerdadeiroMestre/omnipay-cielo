<?php

namespace Omnipay\Cielo\Message;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * CaptureResponse class
 */
class CaptureResponse extends AbstractResponse
{
    /**
     * Is the response successful?
     *
     * @return bool 
     */
    public function isSuccessful(): bool
    {
        return $this->data['Status'] === 2;
    }

    /**
     * Get the transaction reference
     *
     * @return string|null
     */
    public function getTransactionReference()
    {        
        return $this->data['Tid'] ?? null;
    }
}
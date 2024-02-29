<?php

namespace Omnipay\Cielo\Message;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * CreateCardTokenResponse class
 */
class CreateCardTokenResponse extends AbstractResponse
{
    /**
     * Is the response successful?
     *
     * @return bool 
     */
    public function isSuccessful(): bool
    {
        return isset($this->data['CardToken']);
    }
}
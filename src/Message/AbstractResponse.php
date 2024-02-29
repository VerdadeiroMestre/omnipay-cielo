<?php

namespace Omnipay\Cielo\Message;

use Omnipay\Common\Message\AbstractResponse as BaseAbstractResponse;

/**
 * AbstractResponse class
 */
abstract class AbstractResponse extends BaseAbstractResponse
{
    /**
     * Response message
     *
     * @return string|null A response message from the payment gateway
     */
    public function getMessage(): ?string
    {
        return $this->data[0]['Message'] ?? null;
    }

    /**
     * Response code
     *
     * @return string|null A response code from the payment gateway
     */
    public function getCode(): ?string
    {
        return $this->data[0]['Code'] ?? null;
    }
}
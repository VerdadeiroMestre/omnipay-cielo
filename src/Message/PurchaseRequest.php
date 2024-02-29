<?php

namespace Omnipay\Cielo\Message;

/**
 * PurchaseRequest class
 */
class PurchaseRequest extends AuthorizeRequest
{
    /**
     * Get the data for this Request
     *
     * @return array
     */
    public function getData(): array
    {
        $data = parent::getData();
        $data['Payment']['Capture'] = true;     

        return $data;
    }
}
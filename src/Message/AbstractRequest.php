<?php

namespace Omnipay\Cielo\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

/**
 * AbstractRequest class
 */
abstract class AbstractRequest extends BaseAbstractRequest
{
    /**
     * Base to define the Cielo API endpoint
     * requests|queries
     * 
     * requests: for operations that cause side effects - such as authorization, capture and cancellation of transactions
     * queries: for operations that do not cause side effects, such as transaction searching.
     */
    protected $endpointBase;

    /**
     * Request Method
     * POST|GET|PUT
     */
    protected $requestMethod;

    /**
     * Define the live endpoint based on the variable $endpointBase
     * 
     * @return string
     */
    protected function liveEndpoint(): string
    {
        return sprintf('https://%s.cieloecommerce.cielo.com.br/', $this->endpointBase == 'requests' ? 'api' : 'apiquery');
    }

    /**
     * Define the sandbox endpoint based on the variable $endpointBase
     * 
     * @return string
     */
    protected function sandboxEndpoint(): string
    {
        return sprintf('https://%s.cieloecommerce.cielo.com.br/', $this->endpointBase == 'requests' ? 'apisandbox' : 'apiquerysandbox');
    }

    /**
     * Get the appropriate endpoint (live or sandbox)
     * 
     * @return string
     */
    protected function getEndpoint(): string
    {
        return $this->getTestMode()
            ? $this->sandboxEndpoint()
            : $this->liveEndpoint();
    }

    //-------------------------------------------

    /**
     * Get the Merchant id
     * 
     * @return string
     */
    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    /**
     * Set the Merchant id
     * 
     * @param string $value
     * @return $this
     */
    public function setMerchantId(string $value)
    {
        return $this->setParameter('merchantId', $value);
    }

    //-------------------------------------------

    /**
     * Get the Merchant key
     * 
     * @return string
     */
    public function getMerchantKey()
    {
        return $this->getParameter('merchantKey');
    }

    /**
     * Set the Merchant key
     * 
     * @param string $value
     * @return $this
     */
    public function setMerchantKey(string $value)
    {
        return $this->setParameter('merchantKey', $value);
    }

    //-------------------------------------------

    /**
     * Get the Merchant order id
     * 
     * @return string
     */
    public function getMerchantOrderId()
    {
        return $this->getParameter('MerchantOrderId');
    }

    /**
     * Set the Merchant order id
     * 
     * @param string $value
     * @return $this
     */
    public function setMerchantOrderId($value)
    {
        return $this->setParameter('MerchantOrderId', $value);
    }

    //-------------------------------------------
    
    /**
     * Get the Customer
     * 
     * @return array
     */
    public function getCustomer()
    {
        return $this->getParameter('Customer');
    }

    /**
     * Set the Customer
     * 
     * @param array $value
     * @return $this
     */
    public function setCustomer($value)
    {
        return $this->setParameter('Customer', $value);
    }

    //-------------------------------------------
    
    /**
     * Get the Payment
     * 
     * @return array
     */
    public function getPayment()
    {
        return $this->getParameter('Payment');
    }

    /**
     * Set the Payment
     * 
     * @param array $value
     * @return $this
     */
    public function setPayment($value)
    {
        return $this->setParameter('Payment', $value);
    }

    /**
     * Send the data to the API endpoint
     */
    public function sendData($data)
    {
        $method = $this->requestMethod;
        $url = $this->getEndpoint($data);

        $headers = [
            'MerchantId' => $this->getMerchantId() ?? '',
            'MerchantKey' => $this->getMerchantKey() ?? '',
            'Content-Type' => 'application/json'
        ];

        $response = $this->httpClient->request(
            $method,
            $url,
            $headers,
            json_encode($data)
        );

        $payload = json_decode($response->getBody(),true);
    
        return $this->response = $this->createResponse($payload);
    }

    /**
     * Create Response
     * 
     * @param array $data 
     * @return Response
     */
    abstract protected function createResponse(array $data);
}
<?php

namespace Omnipay\Cielo;

use Omnipay\Common\AbstractGateway;
use Omnipay\Cielo\Message\PurchaseRequest;
use Omnipay\Cielo\Message\CaptureRequest;
use Omnipay\Cielo\Message\CreateCardTokenRequest;

/**
 * Gateway class
 */
class Gateway extends AbstractGateway
{
    /**
     * Get gateway display name
     *
     * This can be used by carts to get the display name for each gateway.
     * 
     * Exemple:
     * <code>
     *  $gateway = Omnipay::create('CieloTest');
     * 
     *  $gateway->initialize(array(
     *       'testMode'         => true,                    //Enable sandbox mode
     *       'MerchantId'       => 'MyMerchantId',
     *       'MerchantKey'      => 'MyMerchantKey',
     *   ));
     * 
     * $transaction = $gateway->purchase(array(
     *       'MerchantOrderId'  => '123456',
     *       'Customer'         => $customer,       @see Omnipay\Cielo\Models\Customer
     *       'Payment'          => $payment         @see Omnipay\Cielo\Models\Payment
     *   ));
     * 
     * $response = $transaction->send();
     * 
     * if ($response->isSuccessful()) {
     *       echo $response->getMessage();
     *   }
     * </code>
     * 
     * 
     * For the Cielo Documentation:
     * @link https://developercielo.github.io/manual/cielo-ecommerce 
     */
    public function getName()
    {
        return 'Cielo';
    }

    public function getDefaultParameters()
    {
        return array(
            'testMode' => false,
            'MerchantId' => '',
            'MerchantKey' => '',
        );
    }

    public function getMerchantId()
    {
        return $this->getParameter('MerchantId');
    }

    public function setMerchantId($value)
    {
        return $this->setParameter('MerchantId', $value);
    }

    public function getMerchantKey()
    {
        return $this->getParameter('MerchantKey');
    }

    public function setMerchantKey($value)
    {
        return $this->setParameter('MerchantKey', $value);
    }

    public function authorize(array $params = array())
    {
        return $this->createRequest(AuthorizeRequest::class, $params);
    }

    public function purchase(array $params = array())
    {
        return $this->createRequest(PurchaseRequest::class, $params);
    }

    public function capture(array $params = array())
    {
        return $this->createRequest(CaptureRequest::class, $params);
    }

    public function createCardToken(array $params = array())
    {
        return $this->createRequest(CreateCardTokenRequest::class, $params);
    }
}
<?php

namespace Omnipay\Cielo\Models;

use Symfony\Component\HttpFoundation\ParameterBag;
use Omnipay\Common\Helper;
use Omnipay\Common\ParametersTrait;

/**
 * Payment Class
 * 
 * This class prepare the information to be used by the gateway.
 * 
 * //------------------------------------------------------------
 * 
 * Required parameters
 * * CardNumber
 * * ExpirationDate
 * * Brand
 * 
 * All parameters
 * * CardNumber
 * * Holder
 * * ExpirationDate
 * * SecurityCode
 * * SaveCard
 * * Brand
 * * CardOnFile.Usage
 * * CardOnFile.Reason
 * 
 * Required parameters tokenized card
 * * CardToken
 * * Brand
 * 
 * All parameters tokenized card
 * * CardToken
 * * Brand
 * * SecurityCode
 * 
 * //------------------------------------------------------------
 * 
 * For more information visit:
 * @link https://developercielo.github.io/manual/cielo-ecommerce
 */
class CreditCard {
    use ParametersTrait;

    /**
     * Create a new Payment object using the specified parameters
     * 
     * @param array $parameters An array of parameters to set on the new object
     */
    public function __construct($parameters = null)
    {
        $this->initialize($parameters);
    }

    /**
     * Initialize the object with parameters.
     *
     * If any unknown parameters passed, they will be ignored.
     *
     * @param array $parameters An associative array of parameters
     * @return $this
     */
    public function initialize(array $parameters = null)
    {
        $this->parameters = new ParameterBag;

        Helper::initialize($this, $parameters);

        return $this;
    }

    public function getCardNumber()
    {
        return $this->getParameter('CardNumber');
    }

    public function setCardNumber($value)
    {
        return $this->setParameter('CardNumber', $value);
    }

    public function getHolder()
    {
        return $this->getParameter('Holder');
    }

    public function setHolder($value)
    {
        return $this->setParameter('Holder', $value);
    }

    public function getExpirationDate()
    {
        return $this->getParameter('ExpirationDate');
    }

    public function setExpirationDate($value)
    {
        return $this->setParameter('ExpirationDate', $value);
    }

    public function getSecurityCode()
    {
        return $this->getParameter('SecurityCode');
    }

    public function setSecurityCode($value)
    {
        return $this->setParameter('SecurityCode', $value);
    }

    public function getSaveCard()
    {
        return $this->getParameter('SaveCard');
    }

    public function setSaveCard($value)
    {
        return $this->setParameter('SaveCard', $value);
    }

    public function getBrand()
    {
        return $this->getParameter('Brand');
    }

    public function setBrand($value)
    {
        return $this->setParameter('Brand', $value);
    }

    public function getCardOnFile()
    {
        return $this->getParameter('CardOnFile');
    }

    public function setCardOnFile($value)
    {
        return $this->setParameter('CardOnFile', $value);
    }

    public function getCardToken()
    {
        return $this->getParameter('CardToken');
    }

    public function setCardToken($value)
    {
        return $this->setParameter('CardToken', $value);
    }

}
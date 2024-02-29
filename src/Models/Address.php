<?php

namespace Omnipay\Cielo\Models;

use Symfony\Component\HttpFoundation\ParameterBag;
use Omnipay\Common\Helper;
use Omnipay\Common\ParametersTrait;

/**
 * Address class
 * 
 * This class prepare the information to be used by the gateway.
 * 
 * //------------------------------------------------------------
 * 
 * Boleto required parameters:
 * * ZipCode
 * * State
 * * City
 * * District
 * * Street
 * * Number
 * 
 * All parameters:
 * * Street
 * * Number
 * * Complement
 * * Neighborhood
 * * District
 * * City
 * * State
 * * Country
 * * ZipCode
 * 
 * //------------------------------------------------------------
 * 
 * For more information visit:
 * @link https://developercielo.github.io/manual/cielo-ecommerce
 */
class Address{
    use ParametersTrait;
    
    /**
     * Create a new Address object using the specified parameters
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

    public function getStreet()
    {
        return $this->getParameter('Street');
    }

    public function setStreet($value)
    {
        return $this->setParameter('Street', $value);
    }

    public function getNumber()
    {
        return $this->getParameter('Number');
    }

    public function setNumber($value)
    {
        return $this->setParameter('Number', $value);
    }

    public function getComplement()
    {
        return $this->getParameter('Complement');
    }

    public function setComplement($value)
    {
        return $this->setParameter('Complement', $value);
    }

    public function getZipCode()
    {
        return $this->getParameter('ZipCode');
    }

    public function setZipCode($value)
    {
        return $this->setParameter('ZipCode', $value);
    }

    public function getNeighborhood()
    {
        return $this->getParameter('Neighborhood');
    }

    public function setNeighborhood($value)
    {
        return $this->setParameter('Neighborhood', $value);
    }

    public function getDistrict()
    {
        return $this->getParameter('District');
    }

    public function setDistrict($value)
    {
        return $this->setParameter('District', $value);
    }

    public function getCity()
    {
        return $this->getParameter('City');
    }

    public function setCity($value)
    {
        return $this->setParameter('City', $value);
    }

    public function getState()
    {
        return $this->getParameter('State');
    }

    public function setState($value)
    {
        return $this->setParameter('State', $value);
    }

    public function getCountry()
    {
        return $this->getParameter('Country');
    }

    public function setCountry($value)
    {
        return $this->setParameter('Country', $value);
    }
}
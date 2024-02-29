<?php

namespace Omnipay\Cielo\Models;

use Symfony\Component\HttpFoundation\ParameterBag;
use Omnipay\Common\Helper;
use Omnipay\Common\ParametersTrait;

/**
 * Customer class
 * 
 * This class prepare the information to be used by the gateway.
 * For each type of payment, there are some required information.
 * 
 * //------------------------------------------------------------
 * 
 * Credit card:
 * // No required parameters
 * 
 * All parameters
 * * Name
 * * Status
 * * Identity
 * * IdentityType
 * * Email
 * * Birthdate
 * * Address            @see Omnipay\Cielo\Models\Address
 * * DeliveryAddress    @see Omnipay\Cielo\Models\Address
 * * Billing            @see Omnipay\Cielo\Models\Address
 * 
 * Pix:
 * 
 * Required parameters
 * * Name
 * * Identity
 * * IdentityType
 * 
 * Boleto:
 * 
 * Required parameters
 * * Address            @see Omnipay\Cielo\Models\Address
 * 
 * All parameters
 * * Name
 * * Status
 * * Address            @see Omnipay\Cielo\Models\Address
 * * Billing            @see Omnipay\Cielo\Models\Address
 * 
 * //------------------------------------------------------------
 * 
 * For more information visit:
 * @link https://developercielo.github.io/manual/cielo-ecommerce
 */
class Customer{
    use ParametersTrait;
    
    /**
     * Create a new Customer object using the specified parameters
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

    public function getName()
    {
        return $this->getParameter('Name');
    }

    public function setName($value)
    {
        return $this->setParameter('Name', $value);
    }

    public function getIdentity()
    {
        return $this->getParameter('Identity');
    }

    public function setIdentity($value)
    {
        return $this->setParameter('Identity', $value);
    }

    public function getEmail()
    {
        return $this->getParameter('Email');
    }

    public function setEmail($value)
    {
        return $this->setParameter('Email', $value);
    }

    public function getBirthdate()
    {
        return $this->getParameter('Birthdate');
    }

    public function setBirthdate($value)
    {
        return $this->setParameter('Birthdate', $value);
    }

    public function getAddress()
    {
        return $this->getParameter('Address');
    }

    public function setAddress($value)
    {
        return $this->setParameter('Address', $value);
    }

    public function getDeliveryAddress()
    {
        return $this->getParameter('DeliveryAddress');
    }

    public function setDeliveryAddress($value)
    {
        return $this->setParameter('DeliveryAddress', $value);
    }

    public function getBilling()
    {
        return $this->getParameter('Billing');
    }

    public function setBilling($value)
    {
        return $this->setParameter('Billing', $value);
    }

    /**
     * Prepare an array with the information given to be used by the gateway
     * 
     * @return array $data
     */
    public function getData(){
        $data = $this->getParameters();

        if($this->getAddress()){
            $data["Address"] = $this->getAddress()->getParameters();
        }
        if($this->getDeliveryAddress()){
            $data["DeliveryAddress"] = $this->getDeliveryAddress()->getParameters();
        }
        if($this->getBilling()){
            $data["Billing"] = $this->getBilling()->getParameters();
        }

        return $data;
    }

}
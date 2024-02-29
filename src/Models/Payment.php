<?php

namespace Omnipay\Cielo\Models;

use Symfony\Component\HttpFoundation\ParameterBag;
use Omnipay\Common\Helper;
use Omnipay\Common\ParametersTrait;

/**
 * Payment Class
 * 
 * This class prepare the information to be used by the gateway.
 * For each type of payment, there are some required information.
 * 
 * //------------------------------------------------------------
 * Credit card:
 * 
 * Required parameters
 * * Type
 * * Amount
 * * Installments
 * * CreditCard @see Omnipay\Cielo\CreditCard
 * 
 * All parameters
 * * Type
 * * Amount
 * * Currency
 * * Country
 * * Provider
 * * ServiceTaxAmount
 * * SoftDescriptor
 * * Installments
 * * Interest
 * * Authenticate
 * * Recurrent
 * * IsCryptocurrencyNegotiation
 * * AirlineData.TicketNumber
 * * CreditCard @see Omnipay\Cielo\CreditCard
 * * InitiatedTransactionIndicator.Category
 * * InitiatedTransactionIndicator.Subcategory
 * 
 * // If you want to used a tokenized card you must send an array like this
 * 
 * Pix:
 * 
 * Required parameters
 * * Type
 * * Amount
 * 
 * Boleto:
 * 
 * Required parameters
 * * Amount
 * * Provider
 * 
 * All parameters
 * * Amount
 * * Provider
 * * Adress
 * * BoletoNumber
 * * Assignor
 * * Demonstrative
 * * ExpirationDate
 * * Identification
 * * Instructions
 * 
 * //------------------------------------------------------------
 * 
 * There are other informations required to create a request
 * @see Omnipay\Cielo\Customer
 * 
 * For more information visit:
 * @link https://developercielo.github.io/manual/cielo-ecommerce
 */
class Payment{
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

    public function getCurrency()
    {
        return $this->getParameter('Currency');
    }

    public function setCurrency($value)
    {
        return $this->setParameter('Currency', $value);
    }

    public function getCountry()
    {
        return $this->getParameter('Country');
    }

    public function setCountry($value)
    {
        return $this->setParameter('Country', $value);
    }

    public function getServiceTaxAmount()
    {
        return $this->getParameter('ServiceTaxAmount');
    }

    public function setServiceTaxAmount($value)
    {
        return $this->setParameter('ServiceTaxAmount', $value);
    }

    public function getInstallments()
    {
        return $this->getParameter('Installments');
    }

    public function setInstallments($value)
    {
        return $this->setParameter('Installments', $value);
    }

    public function getInterest()
    {
        return $this->getParameter('Interest');
    }

    public function setInterest($value)
    {
        return $this->setParameter('Interest', $value);
    }

    public function getAuthenticate()
    {
        return $this->getParameter('Authenticate');
    }

    public function setAuthenticate($value)
    {
        return $this->setParameter('Authenticate', $value);
    }

    public function getRecurrent()
    {
        return $this->getParameter('Recurrent');
    }

    public function setRecurrent($value)
    {
        return $this->setParameter('Recurrent', $value);
    }

    public function getSoftDescriptor()
    {
        return $this->getParameter('SoftDescriptor');
    }

    public function setSoftDescriptor($value)
    {
        return $this->setParameter('SoftDescriptor', $value);
    }

    public function getIsCryptoCurrencyNegotiation()
    {
        return $this->getParameter('IsCryptoCurrencyNegotiation');
    }

    public function setIsCryptoCurrencyNegotiation($value)
    {
        return $this->setParameter('IsCryptoCurrencyNegotiation', $value);
    }

    public function getCreditCard()
    {
        return $this->getParameter('CreditCard');
    }

    public function setCreditCard($value)
    {
        return $this->setParameter('CreditCard', $value);
    }

    public function getType()
    {
        return $this->getParameter('Type');
    }

    public function setType($value)
    {
        return $this->setParameter('Type', $value);
    }

    public function getAmount()
    {
        return $this->getParameter('Amount');
    }

    public function setAmount($value)
    {
        return $this->setParameter('Amount', (int) $value*100);
    }

    public function getAirlineData()
    {
        return $this->getParameter('AirlineData');
    }

    public function setAirlineData($value)
    {
        return $this->setParameter('AirlineData', $value);
    }

    public function getProvider()
    {
        return $this->getParameter('Provider');
    }

    public function setProvider($value)
    {
        return $this->setParameter('Provider', $value);
    }

    public function getAddress()
    {
        return $this->getParameter('Address');
    }

    public function setAddress($value)
    {
        return $this->setParameter('Address', $value);
    }

    public function getBoletoNumber()
    {
        return $this->getParameter('BoletoNumber');
    }

    public function setBoletoNumber($value)
    {
        return $this->setParameter('BoletoNumber', $value);
    }

    public function getAssignor()
    {
        return $this->getParameter('Assignor');
    }

    public function setAssignor($value)
    {
        return $this->setParameter('Assignor', $value);
    }

    public function getDemonstrative()
    {
        return $this->getParameter('Demonstrative');
    }

    public function setDemonstrative($value)
    {
        return $this->setParameter('Demonstrative', $value);
    }
    public function getExpirationDate()
    {
        return $this->getParameter('ExpirationDate');
    }

    public function setExpirationDate($value)
    {
        return $this->setParameter('ExpirationDate', $value);
    }
    public function getIdentification()
    {
        return $this->getParameter('Identification');
    }

    public function setIdentification($value)
    {
        return $this->setParameter('Identification', $value);
    }
    public function getInstructions()
    {
        return $this->getParameter('Instructions');
    }

    public function setInstructions($value)
    {
        return $this->setParameter('Instructions', $value);
    }

    /**
     * Prepare an array with the information given to be used by the gateway
     * 
     * @return array $data
     */
    public function getData(){
        $data = $this->getParameters();
        if($this->getCreditCard()){
            $data["CreditCard"] = $this->getCreditCard()->getParameters();
        }
        return $data;
    }
}
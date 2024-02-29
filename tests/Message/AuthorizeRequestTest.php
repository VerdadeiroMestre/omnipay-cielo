<?php

namespace Omnipay\Cielo\Message\Tests;

use Omnipay\Tests\TestCase;
use Omnipay\Cielo\Message\AuthorizeRequest;

use Omnipay\Cielo\Models\Payment;
use Omnipay\Cielo\Models\CreditCard;
use Omnipay\Cielo\Models\Address;
use Omnipay\Cielo\Models\Customer;

class AuthorizeRequestTest extends TestCase
{
    protected $request;

    public function setUp(): void
    {
        $this->request = new AuthorizeRequest($this->getHttpClient(), $this->getHttpRequest());        
    }

    public function testAuthorizeCreditCardSuccess(): void
    {
        $card = new CreditCard(array(
            "CardNumber"        => "4012888888881881",
            'ExpirationDate'    => '12/2030',
            'Brand'             => 'Visa',
        ));

        $payment = new Payment(array(
            "Type"          => "CreditCard",
            "Amount"        => "10.00",
            "Installments"  => 1,
            "CreditCard"    => $card,
        ));

        $this->request->initialize(array(
            "MerchantOrderId"   => "123456",
            "Payment"           => $payment
        ));

        $this->setMockHttpResponse('AuthorizeCreditCardSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getMessage());
    }

    public function testAuthorizeBoletoSuccess(): void
    {
        $address = new Address(array(
              "Street"          => "Rua Teste",
              "Number"          => "123",
              "Complement"      => "AP 123",
              "ZipCode"         => "12345987",
              "District"        => "Centro",
              "City"            => "Rio de Janeiro",
              "State"           => "RJ",
              "Country"         => "BRA"
        ));
        
        $customer = new Customer(array(
              "Name"            => "Comprador Teste",
              "Identity"        => "1234567890",
              "Address"         => $address
        ));
        $card = new CreditCard(array(
            "CardNumber"        => "4012888888881881",
            'ExpirationDate'    => '12/2030',
            'Brand'             => 'Visa',
        ));

        $payment = new Payment(array(
            "Type"              => "Boleto",
            "Amount"            => 15700,
            "Provider"          => "Bradesco2",
            "Address"           => "Rua Teste",
            "BoletoNumber"      => "123",
            "Assignor"          => "Empresa Teste",
            "Demonstrative"     => "Desmonstrative Teste",
            "ExpirationDate"    => "2020-12-31",
            "Identification"    => "11884926754",
            "Instructions"      => "Aceitar somente até a data de vencimento, após essa data juros de 1% dia."
        ));

        $this->request->initialize(array(
            "MerchantOrderId"   => "123456",
            "Payment"           => $payment
        ));

        $this->setMockHttpResponse('AuthorizeBoletoSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getMessage());
    }
}
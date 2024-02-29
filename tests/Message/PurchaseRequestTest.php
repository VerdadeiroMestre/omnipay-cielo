<?php

namespace Omnipay\Cielo\Message\Tests;

use Omnipay\Tests\TestCase;
use Omnipay\Cielo\Message\PurchaseRequest;

use Omnipay\Cielo\Models\Payment;
use Omnipay\Cielo\Models\CreditCard;

class PurchaseRequestTest extends TestCase
{
    protected $request;

    public function setUp(): void
    {
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        
        
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
            "testMode"      => true,
            "MerchantOrderId"   => "123456",
            "Payment"           => $payment
        ));
        
    }

    public function testPurchaseSuccess(): void
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getMessage());
    }
}
<?php

namespace Omnipay\Cielo\Tests;

use Omnipay\Tests\GatewayTestCase;
use Omnipay\Cielo\Gateway;

use Omnipay\Cielo\Message\PurchaseRequest;
use Omnipay\Cielo\Message\CaptureRequest;
use Omnipay\Cielo\Message\CreateCardTokenRequest;

use Omnipay\Cielo\Models\Customer;
use Omnipay\Cielo\Models\Address;
use Omnipay\Cielo\Models\Payment;
use Omnipay\Cielo\Models\CreditCard;

/**
 * Class GatewayTest
 * @package Omnipay\Cielo\Tests
 */
class GatewayTest extends GatewayTestCase
{
    /**
     * @var Gateway
     */
    protected $gateway;

    /**
     * Set up gateway
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
    }

    /**
     *
     */
    public function testPurchaseRequest(): void
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

        $params = array(
            "MerchantOrderId"   => "123456",
            "Payment"           => $payment
        );

        $request = $this->gateway->purchase($params);

        $this->assertInstanceOf(PurchaseRequest::class,$request);
        $this->assertSame('123456', $request->getMerchantOrderId());
        $this->assertSame($payment, $request->getPayment());
    }

    /**
     *
     */
    public function testCaptureRequest(): void
    {
        $request = $this->gateway->capture(array(
            "PaymentId"         => "11111111"
        ));

        $this->assertInstanceOf(CaptureRequest::class, $request);
        $this->assertSame("11111111", $request->getPaymentId());
    }

    /**
     *
     */
    public function testCreateCardTokenRequest(): void
    {

        $request = $this->gateway->createCardToken(array(
            "CustomerName"      => "Armando",
            "CardNumber"        => "4012888888881881",
            "Holder"            => "Teste Holder",
            'ExpirationDate'    => '12/2030',
            'Brand'             => 'Visa'
        ));

        $this->assertInstanceOf(CreateCardTokenRequest::class, $request);
        $this->assertSame('Armando', $request->getCustomerName());
        $this->assertSame('4012888888881881', $request->getCardNumber());
        $this->assertSame('Teste Holder', $request->getHolder());
        $this->assertSame('12/2030', $request->getExpirationDate());
        $this->assertSame('Visa', $request->getBrand());
    }

}
<?php

namespace Omnipay\Cielo\Message\Tests;

use Omnipay\Tests\TestCase;
use Omnipay\Cielo\Message\CaptureRequest;

use Omnipay\Cielo\Models\Payment;
use Omnipay\Cielo\Models\CreditCard;

class CaptureRequestTest extends TestCase
{
    protected $request;

    public function setUp(): void
    {
        $this->request = new CaptureRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->setPaymentId('111111');
        
    }

    public function testCaptureSuccess(): void
    {
        $this->setMockHttpResponse('CaptureSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getMessage());
    }
}
<?php

namespace Omnipay\Cielo\Message\Tests;

use Omnipay\Tests\TestCase;
use Omnipay\Cielo\Message\CreateCardTokenRequest;

class CreateCardTokenRequestTest extends TestCase
{
    protected $request;

    public function setUp(): void
    {
        $this->request = new CreateCardTokenRequest($this->getHttpClient(), $this->getHttpRequest());
        
        $this->request->initialize(array(
            "CustomerName"      => "Armando",
            "CardNumber"        => "4012888888881881",
            "Holder"            => "Teste Holder",
            'ExpirationDate'    => '12/2030',
            'Brand'             => 'Visa'
        ));
        
    }

    public function testCreateCardTokenSuccess(): void
    {
        $this->setMockHttpResponse('CreateCardTokenSuccess.txt');
        $response = $this->request->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertNull($response->getMessage());
    }
}
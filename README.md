# Omnipay: Cielo 
(Versão imcompleta de teste)

Este projeto visa implementar o gateway de pagamentos da Cielo no padrão [Omnipay](https://github.com/omnipay/omnipay).

## Instalação

A instalação é feita via [Composer](http://getcomposer.org/). Instale esse pacote juntamente com o pacote base do Omnipay (`league/omnipay`).
```
composer require league/omnipay verdadeiro-mestre/omnipay-cielo
```

## Como usar

O seguinte gateway é fornecido por este pacote:

* [Cielo](https://cielo.com.br/)

para a documentação das APIs da Cielo acesse: 
https://developercielo.github.io/en/manual/cielo-ecommerce

#### Organização
Foram criadas algumas **classes** para facilitar a organização dos dados:
```php
use Omnipay\Cielo\Models\Address;
use Omnipay\Cielo\Models\Customer;
use Omnipay\Cielo\Models\CreditCard; //A classe CreditCard do Omnipay\Common não atendia aos uso necessário
use Omnipay\Cielo\Models\Payment;
```

### Exemplos de utilização

#### Realizando transação com cartão de crédito

```php
//Criando o gateway da Cielo por meio do Omnipay
$gateway = Omnipay::create("Cielo");

// inicializando o gateway
$gateway->initialize(array(
    "merchantId"        => "MyMerchantId",
    "merchantKey"       => "MyMerchantKey",
));

$address = new Address(array(
      "Street"          => "Rua Teste",
      "Number"          => "123",
      "Complement"      => "AP 123",
      "ZipCode"         => "12345987",
      "District"        => "Centro"
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
    "Holder"            => "Teste Holder",
    "CardNumber"        => "4012888888881881",
    "SecurityCode"      => "123",
    "ExpirationDate"    => "12/2030",
    "SaveCard"          => "false",
    "Brand"             => "Visa",
));

$payment = new Payment(array(
    "Type"              => "CreditCard",
    "Amount"            => "10.00",
    "Installments"      => 1,
    "CreditCard"        => $card,
));

//Realizando a transação
// o metodo purchase realiza a transação
// e o metodo authorize apenas autoriza a transação
$response = $gateway->purchase(array(
    "MerchantOrderId"   => "123456",
    "Customer"          => $customer,
    "Payment"           => $payment
))->send();

if($response->isSuccessful()){
    return $response->getData();
}

```

#### Realizando transação com boleto

```php
//Criando o gateway da Cielo por meio do Omnipay
$gateway = Omnipay::create("Cielo");

// inicializando o gateway
$gateway->initialize(array(
    "merchantId"        => "MyMerchantId",
    "merchantKey"       => "MyMerchantKey",
));

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

//Realizando a transação
// o metodo purchase realiza a transação
// e o metodo authorize apenas autoriza a transação
$response = $gateway->purchase(array(
    "MerchantOrderId"   => "123456",
    "Customer"          => $customer,
    "Payment"           => $payment
))->send();

if($response->isSuccessful()){
    return $response->getData();
}

```

#### Tokenização de cartão
```php
//Criando o gateway da Cielo por meio do Omnipay
$gateway = Omnipay::create("Cielo");

// inicializando o gateway
$gateway->initialize(array(
    "merchantId"        => "MyMerchantId",
    "merchantKey"       => "MyMerchantKey",
));

$response = $gateway->createCardToken(array(
    "CustomerName"      => "Armando",
    "CardNumber"        => "4012888888881881",
    "Holder"            => "Teste Holder",
    'ExpirationDate'    => '12/2030',
    'Brand'             => 'Visa'
))->send();

if($response->isSuccessful()){
    return $response->getData();
}
```

### Modo de teste

Para ativar o modo sandbox das APIs da Cielo faça da seguinte forma:


```php
$gateway->initialize(array(
    "testMode"      => true,    //Habilita o modo sandbox
    "merchantId"        => "MyMerchantId",
    "merchantKey"       => "MyMerchantKey",
));

```
<?php

use Kubinyete\Logbank\Core\LogbankClient;
use Kubinyete\Logbank\Core\LogbankEnvironment;
use Kubinyete\Logbank\Exception\LogbankException;
use Kubinyete\Logbank\Model\Auth\Credentials;
use Kubinyete\Logbank\Model\Transaction\Address;
use Kubinyete\Logbank\Model\Transaction\Billing;
use Kubinyete\Logbank\Model\Transaction\Card;
use Kubinyete\Logbank\Model\Transaction\Item;
use Kubinyete\Logbank\Model\Transaction\Payment;
use Kubinyete\Logbank\Model\Transaction\Phone;
use Kubinyete\Logbank\Model\Transaction\Shipping;
use Kubinyete\Logbank\Model\Transaction\Transaction;
use Kubinyete\Logbank\Model\Transaction\TransactionCancelRequest;

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$client = new LogbankClient(LogbankEnvironment::sandbox());
$credentials = new Credentials(getenv('PROJECTID'), getenv('CLIENTID'), getenv('CLIENTSECRET'));

$address = new Address('Av. Teste', '123', 'Nenhum', 'Centro', 'Presidente Prudente', 'SP', 'BR', '19360000');
$phone = new Phone(55, 18, '933333333');
$card = new Card('5101085309440509', 'Mastercard', 'VITOR KUBINYETE', '414.945.130-30', '07', '26', '123', 'vitor@ipag.com.br', '18933333333');
$payment = new Payment('10000', 12, $card);
$billing = new Billing('414.945.130-30', 'VITOR KUBINYETE', 'vitor@ipag.com.br', $address);
$shipping = new Shipping('414.945.130-30', 'VITOR KUBINYETE', 'vitor@ipag.com.br', $address);
$billing->addPhone($phone);
$shipping->addPhone($phone);
$transaction = new Transaction('vitor@ipag.com.br', '10299,99', 12);
$transaction->addPayment($payment);
$transaction->setBilling($billing);
$transaction->setShipping($shipping);
$transaction->addItem(new Item('IPHONE 13 PRO MAX', '5599,99', 1));
$transaction->addItem(new Item('PLAYSTATION 5', '4299,99', 1));

$client->authenticate($credentials);

$transaction = $client->createTransaction($transaction);
dump($transaction->getStatus(), $transaction->getAuthorizationNumber(), $transaction->getEcommerceOrderNumber(), $transaction->getStartDate(), $transaction->getStartDateString());

$response = $client->cancelTransaction(new TransactionCancelRequest($transaction->getEcommerceOrderNumber(), $transaction->getValue()));
dump($response);

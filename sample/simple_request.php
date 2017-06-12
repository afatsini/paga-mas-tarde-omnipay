<?php
use Omnipay\Omnipay;

require './../vendor/autoload.php';

$gateway = Omnipay::create('PagaMasTarde');

$formData = [
  'locale' => 'es',
  'iframe' => 'false',
  'account_id' => 'tk_fe1de2f4f0bfd6174f3d113f',
  'secret_key' => '7f9e2daee0865197',
  'callback_url' => 'callback_url',
  'full_name' => 'Albert Fatsini Font',
  'email' => 'testing@test.com',
  'amount' => floatval(1234)
];

$purcharse_request = $gateway->purchase($formData);

$data = $purcharse_request->getData();
$purchase_response = $purcharse_request->sendData($data);

$purchase_response->redirect();

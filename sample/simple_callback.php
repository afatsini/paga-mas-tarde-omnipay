<?php
use Omnipay\Omnipay;

require './../vendor/autoload.php';

$gateway = Omnipay::create('PagaMasTarde');

$input = file_get_contents('php://input');

$formData = ['secret_key' => '7f9e2daee0865197'];

$complete_request = $gateway->completePurchase($formData);

$data = $complete_request->getData($input);

$complete_response = $complete_request->sendData($data);

if ($complete_response->isSuccessful()) {
    echo "completed purchase with data:\n";
    print_r($data);
} else {
    echo "error!\n";
    print_r($complete_response->getMessage);
}

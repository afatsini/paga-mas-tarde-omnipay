<?php

namespace Omnipay\PagarMasTarde\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Sermepa\Encryptor\Encryptor;
use PagaMasTarde\Core\PagaMasTardeConstants;
use PagaMasTarde\Request\Configuration;
use PagaMasTarde\Request\Request;

/**
 * Sermepa (Redsys) Purchase Request
 *
 * @author Javier Sampedro <jsampedro77@gmail.com>
 */
class PurchaseRequest extends AbstractRequest
{

    public function getData()
    {
        $data = array(
            "account_id" => $this->getAccountId(),
            "currency" => $this->getCurrency(),
            "ok_url" => $this->getReturnUrl(),
            "nok_url" => $this->getReturnUrl(),
            "cancelled_url" => $this->getCancelUrl(),
            "callback_url" => $this->getCallbackUrl(),
            "order_id" => $this->getTransactionId(),
            "amount" => $this->getAmount(),
            "description" => $this->getDescription(),
            "locale" => $this->getLocale(),
            "iframe" => $this->getIframe(),
            "discount" => array(
                "full" => $this->getDiscount()
            )
        );

        $data['signature'] = $this->generateSignature($data);

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }

    protected function generateSignature($data)
    {
        $text_to_encode = $this->getSecretKey().
            $data['account_id'].
            $data['order_id'].
            $data['amount'].
            $data['currency'].
            $data['ok_url'].
            $data['nok_url'].
            $data['callback_url'].
            $data['discount'].
            $data['cancelled_url'];

        return hash('sha512', $text_to_encode);
    }

    private function getCallbackUrl()
    {
        return $this->getParameter('callback_url');
    }

    private function getLocale()
    {
        return $this->getParameter('locale');
    }

    private function getIframe()
    {
        return $this->getParameter('iframe');
    }

    private function getDiscount()
    {
        return $this->getParameter('discount');
    }

    private function getAccountId()
    {
        return $this->getParameter('account_id');
    }

    private function getSecretKey()
    {
        return $this->getParameter('secret_key');
    }
}

<?php

namespace Omnipay\PagarMasTarde\Message;

use Omnipay\Common\Message\AbstractRequest;

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
            "account_id" => $this->getParameter('account_id'),
            "currency" => $this->getCurrency(),
            "ok_url" => $this->getReturnUrl(),
            "nok_url" => $this->getReturnUrl(),
            "cancelled_url" => $this->getCancelUrl(),
            "order_id" => $this->getTransactionId(),
            "amount" => $this->getAmount(),
            "description" => $this->getDescription(),
            "locale" => $this->getParameter('locale'),
            "iframe" => $this->getParameter('iframe'),
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
        $text_to_encode = $this->getParameter('secret_key').
            $data['account_id'].
            $data['order_id'].
            $data['amount'].
            $data['currency'].
            $data['ok_url'].
            $data['nok_url'].
            $data['cancelled_url'];

        return hash('sha512', $text_to_encode);
    }

    public function setLocale($value)
    {
        return $this->setParameter('locale', $value);
    }

    public function setIframe($value)
    {
        return $this->setParameter('iframe', $value);
    }

    public function setAccountId($value)
    {
        return $this->setParameter('accound_id', $value);
    }

    public function setSecretKey($value)
    {
        return $this->setParameter('secret_key', $value);
    }
}

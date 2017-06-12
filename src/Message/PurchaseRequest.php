<?php

namespace Omnipay\PagaMasTarde\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\PagaMasTarde\Traits\Parameters;

/**
 * Paga+Tarde Purchase Request
 */
class PurchaseRequest extends AbstractRequest
{
    use Parameters;

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
            'full_name' => $this->getParameter('full_name'),
            'email' => $this->getParameter('email')
        );

        if ($this->getParameter('callback_url')) {
            $data['callback_url'] = $this->getParameter('callback_url');
        }

        $data['signature'] = $this->generateSignature($data);

        return $data;
    }

    protected function generateSignature($data)
    {
        $text_to_encode = $this->getParameter('secret_key') .
            $data['account_id'] .
            $data['order_id'] .
            $data['amount'] .
            $data['currency'] .
            $data['ok_url'] .
            $data['nok_url'];

        if (!empty($data['callback_url'])) {
            $text_to_encode .= $data['callback_url'];
        }

        if (!empty($data['cancelled_url'])) {
            $text_to_encode .= $data['cancelled_url'];
        }

        return hash('sha512', $text_to_encode);
    }

    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }

    public function setFullName($value)
    {
        return $this->setParameter('full_name', $value);
    }

    public function setEmail($value)
    {
        return $this->setParameter('email', $value);
    }

    public function setMultiply($multiply)
    {
        return $this->setParameter('multiply', $multiply);
    }

    public function getAmount()
    {
        if ($this->getParameter('multiply')) {
            return (float)parent::getAmount() * 100;
        }
        return (float)parent::getAmount();
    }
}

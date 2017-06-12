<?php

namespace Omnipay\PagaMasTarde\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Paga+Tarde Complete Purchase Response
 */
class CompletePurchaseResponse extends AbstractResponse
{

    public function __construct($request, $data)
    {
        $this->request = $request;
        $this->data = $data;
        parent::__construct($request, $data);
    }

    public function isSuccessful()
    {
        return $this->data['event'] === 'charge.created';
    }

    public function getMessage()
    {
        return $this->data['data']['error_code'] . ' - ' . $this->data['data']['error_message'];
    }
}

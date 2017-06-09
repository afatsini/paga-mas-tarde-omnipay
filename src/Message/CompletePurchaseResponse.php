<?php

namespace Omnipay\PagaMasTarde\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Paga+Tarde Complete Purchase Response
 */
class CompletePurchaseResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return $this->data['event'] === 'charge.created';
    }

    public function getMessage()
    {
        return $this->data['data']['error_code'] . ' - ' . $this->data['data']['error_message'];
    }
}
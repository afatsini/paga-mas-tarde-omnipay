<?php

namespace Omnipay\PagaMasTarde\Traits;

trait Signature
{

    protected function generateSignature($data)
    {
        $text_to_encode = $this->getParameter('secret_key') .
            $data['account_id'] .
            $data['order_id'] .
            $data['amount'] .
            $data['currency'] .
            $data['ok_url'] .
            $data['nok_url'];

        if (!empty($data['callback_url']))
            $text_to_encode .= $data['callback_url'];

        if (!empty($data['cancelled_url']))
            $text_to_encode .= $data['cancelled_url'];

        return hash('sha512', $text_to_encode);
    }
}

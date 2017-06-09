<?php
namespace Omnipay\PagaMasTarde\Message;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\PagaMasTarde\Traits\Parameters;
use Omnipay\PagaMasTarde\Traits\Signature;
use Omnipay\PagaMasTarde\Exception\BadSignatureException;

/**
 * Paga+Tarde Complete Purchase Request
 */
class CompletePurchaseRequest extends AbstractRequest
{
    use Parameters, Signature;

    public function getData()
    {
        $data = $this->httpRequest->getContent();

        if(!$this->checkSignature($data['data'], $data['signature'])) {
            throw new BadSignatureException();
        }

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new CompletePurchaseResponse($this, $data);
    }

    private function checkSignature($data, $expectedSignature)
    {
        $signature = $this->generateSignature($data);
        return $signature == $expectedSignature;
    }
}
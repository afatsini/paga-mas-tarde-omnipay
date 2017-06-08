<?php

namespace Omnipay\PagarMasTarde;

use Symfony\Component\HttpFoundation\Request;
use Omnipay\Common\AbstractGateway;
use Omnipay\Sermepa\Message\CallbackResponse;

/**
 * Sermepa (Redsys) Gateway
 *
 * @author Javier Sampedro <jsampedro77@gmail.com>
 */
class Gateway extends AbstractGateway
{

    public function getDefaultParameters()
    {
        return array();
    }

    public function getName()
    {
        return 'PagarMasTarde';
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PagarMasTarde\Message\PurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Sermepa\Message\CompletePurchaseRequest', $parameters);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param bool $returnObject
     * @return bool|CallbackResponse
     * @throws Exception\BadSignatureException
     * @throws Exception\CallbackException
     */
    public function checkCallbackResponse(Request $request, $returnObject = false)
    {
        $response = new CallbackResponse($request, $this->getParameter('merchantKey'));

        if ($returnObject) {
            return $response;
        }

        return $response->isSuccessful();
    }

    public function decodeCallbackResponse(Request $request)
    {
        return json_decode(base64_decode(strtr($request->get('Ds_MerchantParameters'), '-_', '+/')), true);
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
        return $this->setParameter('account_id', $value);
    }

    public function setSecretKey($value)
    {
        return $this->setParameter('secret_key', $value);
    }
}

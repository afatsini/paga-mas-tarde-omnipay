<?php

namespace Omnipay\PagaMasTarde;

use Omnipay\PagaMasTarde\Traits\Parameters;
use Omnipay\Common\AbstractGateway;

/**
 * Paga+Tarde Gateway
 *
 * @author Enric Bisbe Gil <enric@bikebitants.com>
 */
class Gateway extends AbstractGateway
{
    use Parameters;

    public function getDefaultParameters()
    {
        return array();
    }

    public function getName()
    {
        return 'PagaMasTarde';
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PagaMasTarde\Message\PurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PagaMasTarde\Message\CompletePurchaseRequest', $parameters);
    }
}

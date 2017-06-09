<?php
namespace Omnipay\PagaMasTarde\Traits;

trait Parameters {

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

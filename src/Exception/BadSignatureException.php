<?php

namespace Omnipay\PagaMasTarde\Exception;

/**
 * BadSignatureException
 */
class BadSignatureException extends \Exception
{
    protected $message = 'Invalid signature';
}
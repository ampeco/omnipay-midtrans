<?php

namespace Ampeco\OmnipayMidtrans\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\ResponseInterface;

class Response extends AbstractResponse implements ResponseInterface, RedirectResponseInterface
{
    protected int $statusCode;

    public function __construct(RequestInterface $request, $data, $statusCode)
    {
        $this->request = $request;
        $this->data = json_decode($data, true);
        $this->statusCode = (int) $statusCode;
    }

    public function getRequest(): AbstractRequest
    {
        return $this->request;
    }

    public function isSuccessful()
    {
        return $this->statusCode < 400;
    }

    public function isRedirect()
    {
        return !is_null($this->getRedirectUrl());
    }

    public function getRedirectUrl()
    {
        return @$this->data['redirect_url'];
    }

    public function getTransactionReference()
    {
        if ($this->isRedirect()) {
            return @$this->data['token'];
        } else {
            return @$this->data['transaction_id'];
        }
    }

    public function getCode()
    {
        return @$this->data['channel_response_code'];
    }

    public function getMessage()
    {
        return @$this->data['channel_response_message'];
    }
}

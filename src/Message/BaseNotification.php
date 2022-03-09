<?php

namespace Ampeco\OmnipayMidtrans\Message;

use Omnipay\Common\Message\NotificationInterface;

class BaseNotification implements NotificationInterface
{
    const STATUS_SUCCESS = 200;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getTransactionStatus(): int
    {
        return @$this->data['status_code'];
    }

    public function getMessage()
    {
        return $this->getTransactionStatus();
    }

    public function getData()
    {
        return $this->data;
    }

    public function getTransactionReference()
    {
        return @$this->data['payme_sale_id'];
    }

    public function isSuccessful(): bool
    {
        return $this->getTransactionStatus() === self::STATUS_SUCCESS;
    }
}

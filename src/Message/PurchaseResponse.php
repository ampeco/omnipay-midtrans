<?php

namespace Ampeco\OmnipayMidtrans\Message;

use Ampeco\OmnipayMidtrans\Gateway;

class PurchaseResponse extends Response
{
    public function isSuccessful()
    {
        return parent::isSuccessful() && $this->getCode() === Gateway::STATUS_SUCCESS;
    }
}

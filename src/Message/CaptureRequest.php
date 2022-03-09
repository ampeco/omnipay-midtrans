<?php

namespace Ampeco\OmnipayMidtrans\Message;

class CaptureRequest extends AbstractRequest
{
    public function getEndpoint()
    {
        return 'capture-sale';
    }

    public function getData()
    {
        $this->validate('amount');

        return [
            'payme_sale_id' => $this->getTransactionReference(),
            'sale_price' => $this->getAmountInteger(),
            'installments' => 1,
        ];
    }
}

<?php

namespace Ampeco\OmnipayMidtrans\Message;

class VoidRequest extends AbstractRequest
{
    public function getEndpoint()
    {
        return 'refund-sale';
    }

    public function getData()
    {
        return [
            'seller_payme_id' => $this->getSellerId(),
            'payme_sale_id' => $this->getTransactionReference(),
        ];
    }

    public function send()
    {
        // The payment provider does not support voiding pre-authorized amount
        // so we are creating fake successful response
        return $this->createResponse(json_encode([
            'status_code' => 0,
            'payme_sale_id' => $this->getTransactionReference(),
        ]), 200);
    }
}

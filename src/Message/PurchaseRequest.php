<?php

namespace Ampeco\OmnipayMidtrans\Message;

class PurchaseRequest extends AbstractRequest
{
    public function setHold($value)
    {
        $this->setParameter('hold', (bool) $value);
    }

    public function getHold()
    {
        return $this->getParameter('hold');
    }

    public function getEndpoint()
    {
        return 'charge';
    }

    public function getData()
    {
        $this->validate('token', 'transactionId', 'amount');

        $params = [
            'payment_type' => 'credit_card',
            'transaction_details' => [
                'order_id' => $this->getTransactionId(),
                'gross_amount' => $this->getAmount(),
            ],
            'credit_card' => [
                'token_id' => $this->getToken(),
            ],
        ];

        if ($this->getHold()) {
            $params['type'] = 'authorize';
        }

        return $params;
    }

    protected function getResponseClass()
    {
        return PurchaseResponse::class;
    }
}

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
        return 'generate-sale';
    }

    public function getData()
    {
        $this->validate('token', 'transactionId', 'amount', 'currency', 'description');

        $params = [
            'seller_payme_id' => $this->getSellerId(),
            'sale_price' => $this->getAmountInteger(),
            'currency' => $this->getCurrency(),
            'product_name' => $this->getDescription(),
            'installments' => 1,
            'transaction_id' => $this->getTransactionId(),
            'sale_send_notification' => false,
            'buyer_key' => $this->getToken(),
        ];

        if ($this->getHold()) {
            $params['sale_type'] = 'authorize';
        }

        return $params;
    }

    protected function getResponseClass()
    {
        return PurchaseResponse::class;
    }
}

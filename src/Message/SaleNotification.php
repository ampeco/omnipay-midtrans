<?php

namespace Ampeco\OmnipayMidtrans\Message;

class SaleNotification extends BaseNotification
{
    // "payme_status": "success",
    // "status_error_code": "0",
    // "status_code": "0",
    // "payme_sale_id": "SALE1639-062536VW-AMFN64XO-K1KQKUA5",
    // "payme_sale_code": "848956",
    // "sale_created": "2021-12-09 17:08:56",
    // "payme_sale_status": "completed",
    // "sale_status": "completed",
    // "currency": "USD",
    // "transaction_id": "5a55351ceb",
    // "is_token_sale": "1",
    // "price": "100",
    // "payme_signature": "46a34aee56f13adab8d8c931469041b7",
    // "payme_transaction_id": "TRAN1639-062569QB-XNLB6RAP-6ZXXGILP",
    // "payme_transaction_total": "100",
    // "payme_transaction_card_brand": "Visa",
    // "payme_transaction_auth_number": "9743923",
    // "payme_transaction_voucher": "1001",
    // "buyer_name": "John Doe",
    // "buyer_email": "john.doe@example.com",
    // "buyer_phone": "2222222",
    // "buyer_card_mask": "420000******0000",
    // "buyer_card_exp": "0222",
    // "buyer_card_is_foreign": "1",
    // "buyer_social_id": "99994",
    // "installments": "1",
    // "sale_paid_date": "2021-12-09 17:09:29",
    // "buyer_key": "BUYER160-4342521O-ZQRZLKA8-EDQNCYCH",
    // "notify_type": "sale-complete"

    public function isForTokenization(): bool
    {
        return $this->getToken() !== null
            && $this->data['notify_type'] === 'sale-complete';
    }

    public function getToken(): ?string
    {
        return @$this->data['buyer_key'];
    }

    public function getCardBrand(): string
    {
        return $this->data['payme_transaction_card_brand'];
    }

    public function getCardNumber(): string
    {
        return $this->data['buyer_card_mask'];
    }

    public function getExpirationMonth(): int
    {
        return intval(substr($this->getExpireDate(), 0, 2));
    }

    public function getExpirationYear(): int
    {
        return 2000 + intval(substr($this->getExpireDate(), -2));
    }

    public function getExpireDate(): string
    {
        return $this->data['buyer_card_exp'];
    }
}

<?php

namespace App\Payment;

class CreditCardPayment implements PaymentMethod
{
    private string $cardNumber;
    private string $expirationDate;

    public function __construct(string $cardNumber, string $expirationDate)
    {
        $this->cardNumber = $cardNumber;
        $this->expirationDate = $expirationDate;
    }

    public function processPayment(float $amount): bool
    {
        // Логика обработки платежа (например, проверка карты и оплата)
        echo "Processing payment of $amount via Credit Card.";
        return true;
    }
}

<?php

namespace App\Payment;

class PayPalPayment implements PaymentMethod
{
    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function processPayment(float $amount): bool
    {
        // Логика для оплаты через PayPal
        echo "Processing payment of {$amount} via PayPal for {$this->email}.\n";
        return true;
    }
}

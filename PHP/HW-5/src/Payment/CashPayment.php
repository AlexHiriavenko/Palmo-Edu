<?php

namespace App\Payment;

class CashPayment implements PaymentMethod
{
    public function processPayment(float $amount): bool
    {
        echo "Processing cash payment of {$amount}.\n";
        return true;
    }
}

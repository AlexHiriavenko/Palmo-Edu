<?php

namespace App\Payment;

interface PaymentMethod
{
    public function processPayment(float $amount): bool;
}

<?php

namespace App\Vehicles;

class Car extends Vehicle {
    private float $dailyRate;

    public function __construct(string $brand, string $model, int $year, float $dailyRate) {
        parent::__construct($brand, $model, $year);
        $this->dailyRate = $dailyRate;
    }

    public function calculateRentalCost(int $days): float {
        return $days * $this->dailyRate;
    }
}
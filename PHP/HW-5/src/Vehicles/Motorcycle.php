<?php

namespace App\Vehicles;

class Motorcycle extends Vehicle
{
    private float $hourlyRate;

    public function __construct(string $brand, string $model, int $year, float $hourlyRate)
    {
        parent::__construct($brand, $model, $year);
        $this->hourlyRate = $hourlyRate;
    }

    public function calculateRentalCost(int $hours): float
    {
        return $hours * $this->hourlyRate;
    }
}

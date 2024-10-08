<?php
namespace App\Vehicles;

abstract class Vehicle {
    protected string $brand;
    protected string $model;
    protected int $year;

    public function __construct(string $brand, string $model, int $year) {
        $this->brand = $brand;
        $this->model = $model;
        $this->year = $year;
    }

    abstract public function calculateRentalCost(int $days): float;

    public function getInfo(): string {
        return "{$this->year} {$this->brand} {$this->model}";
    }
}
?>
<?php

namespace App\RentalSystem;

use App\Vehicles\Vehicle;
use App\Payment\PaymentMethod;
use Exception;

class RentalSystem {
    private array $vehicles = [];

    // Метод для добавления транспортных средств
    public function addVehicle(Vehicle $vehicle): void {
        $this->vehicles[] = $vehicle;
    }

    // Метод для аренды транспортного средства
    public function rentVehicle(int $vehicleIndex, int $duration, PaymentMethod $paymentMethod): void {
        if (!isset($this->vehicles[$vehicleIndex])) {
            throw new Exception("Vehicle not found.");
        }

        $vehicle = $this->vehicles[$vehicleIndex];
        $cost = $vehicle->calculateRentalCost($duration);

        echo $vehicle->getInfo() . " rental cost: {$cost}\n";

        // Обработка платежа с возможностью выброса исключения
        if (!$paymentMethod->processPayment($cost)) {
            throw new Exception("Payment failed.");
        }
        
        echo "Payment processed successfully.\n";
    }

    // Метод для получения всех транспортных средств
    public function listVehicles(): array {
        return $this->vehicles;
    }

    // Метод для удаления транспортного средства
    public function removeVehicle(int $vehicleIndex): void {
        if (!isset($this->vehicles[$vehicleIndex])) {
            throw new Exception("Vehicle not found.");
        }

        unset($this->vehicles[$vehicleIndex]);
        echo "Vehicle removed successfully.\n";
    }
}

<?php

const BR = '<br>';

require '../vendor/autoload.php';

use App\Vehicles\Car;
use App\Vehicles\Motorcycle;
use App\Payment\CreditCardPayment;
use App\Payment\PayPalPayment;
use App\Payment\CashPayment;
use App\RentalSystem\RentalSystem;

// Создаем объекты автомобилей и мотоциклов
$car = new Car("Toyota", "Corolla", 2020, 50.0);
$motorcycle = new Motorcycle("Harley Davidson", "Sportster", 2018, 10.0);

// Создаем систему аренды
$rentalSystem = new RentalSystem();

try {
    // Добавляем транспортные средства в систему
    $rentalSystem->addVehicle($car);
    $rentalSystem->addVehicle($motorcycle);

    // Создаем объект оплаты через кредитную карту
    $creditCardPayment = new CreditCardPayment("1234-5678-9012-3456", "12/25");
    // Арендуем транспортные средства
    $rentalSystem->rentVehicle(0, 5, $creditCardPayment);  // Арендуем автомобиль на 5 дней
    echo BR;

    // Создаем объект оплаты через PayPal
    $paypalPayment = new PayPalPayment("user@example.com");
    $rentalSystem->rentVehicle(1, 3, $paypalPayment);  // Арендуем мотоцикл на 3 часа
    echo BR;

    // Список всех транспортных средств

    echo 'Список всех транспортных средств:' . BR;

    $vehicles = $rentalSystem->listVehicles();
    foreach ($vehicles as $index => $vehicle) {
        echo "{$index}: " . $vehicle->getInfo() . BR;
    }
    echo BR;

    // Удаляем транспортное средство
    $rentalSystem->removeVehicle(0);
    echo BR;

    // Аренда с наличными
    $cashPayment = new CashPayment();
    $rentalSystem->rentVehicle(1, 2, $cashPayment); // Арендуем мотоцикл на 2 часа
    echo BR;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

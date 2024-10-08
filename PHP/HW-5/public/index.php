<?php
// Подключаем автозагрузку из HW-5
// require_once __DIR__ . '/HW-5/vendor/autoload.php';

// Дальнейшая логика

require '../vendor/autoload.php';

use App\Vehicles\Car;
use App\Vehicles\Motorcycle;
use App\Payment\CreditCardPayment;

// Создаем объекты автомобилей и мотоциклов
$car = new Car("Toyota", "Corolla", 2020, 50.0);
$motorcycle = new Motorcycle("Harley Davidson", "Sportster", 2018, 10.0);

// Выводим информацию о транспортных средствах
echo $car->getInfo() . "\n"; // Toyota Corolla 2020
echo $motorcycle->getInfo() . "\n"; // Harley Davidson Sportster 2018

// Рассчитываем стоимость аренды
echo "Car rental cost for 5 days: " . $car->calculateRentalCost(5) . "\n"; // 250.0
echo "Motorcycle rental cost for 3 hours: " . $motorcycle->calculateRentalCost(3) . "\n"; // 30.0

// Создаем объект оплаты и выполняем оплату
$payment = new CreditCardPayment("1234-5678-9012-3456", "12/25");
$payment->processPayment(280.0);
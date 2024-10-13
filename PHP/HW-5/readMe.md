# Завдання: Розробка системи оренди транспортних засобів з використанням ООП у PHP

Мета: Створити систему оренди транспортних засобів, що демонструє ключові принципи ООП у PHP.

## Частина 1: Створення базової структури

1. Створіть інтерфейс `PaymentMethod` з методом `processPayment($amount)`.

2. Розробіть абстрактний клас `Vehicle` з наступними характеристиками:
   - Захищені властивості: `$brand`, `$model`, `$year`
   - Конструктор, що приймає ці три параметри
   - Абстрактний метод `calculateRentalCost($days)`
   - Метод `getInfo()`, що повертає рядок з інформацією про транспортний засіб

## Частина 2: Реалізація конкретних класів

3. Створіть клас `Car`, що успадковує від `Vehicle`:
   - Додайте приватну властивість `$dailyRate`
   - Реалізуйте конструктор та метод `calculateRentalCost()`

4. Аналогічно створіть клас `Motorcycle`:
   - Додайте приватну властивість `$hourlyRate`
   - Реалізуйте конструктор та метод `calculateRentalCost()`

5. Розробіть клас `CreditCardPayment`, що реалізує інтерфейс `PaymentMethod`:
   - Додайте приватні властивості `$cardNumber` та `$expirationDate`
   - Реалізуйте конструктор та метод `processPayment()`

## Частина 3: Створення системи оренди

6. Створіть клас `RentalSystem`:
   - Додайте приватну властивість `$vehicles` (масив)
   - Реалізуйте методи `addVehicle()` та `rentVehicle()`

## Частина 4: Демонстрація роботи системи

7. Напишіть код для демонстрації роботи системи:
   - Створіть екземпляр `RentalSystem`
   - Додайте до системи кілька транспортних засобів
   - Створіть екземпляр `CreditCardPayment`
   - Продемонструйте оренду різних транспортних засобів

## Вимоги до реалізації:

- Використовуйте правильні модифікатори доступу (public, protected, private)
- Застосовуйте типізацію параметрів та значень, що повертаються, де це можливо
- Дотримуйтесь принципів ООП: успадкування, поліморфізм, інкапсуляцію
- Додайте коментарі до методів та класів для покращення читабельності коду

## Додаткові завдання (за бажанням):

- Реалізуйте обробку помилок з використанням винятків (exceptions)
- Додайте додаткові методи до класу `RentalSystem` для керування списком транспортних засобів
- Створіть додаткові класи платіжних методів, що реалізують інтерфейс `PaymentMethod`
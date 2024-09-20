-- вибрати номер сертифіката (number), власника сертифіката (fio) із таблиці сертифікатів (certificates), де не вказано рік випуску year ( за замовчуванням поле year має значення NULL)

SELECT number, fio FROM certificates
WHERE year IS NULL;

-- Оновити таблицю certificates, встановити такі значення: у полі series встановити значення ВН, у полі number – 25444, де user_id = 7

UPDATE certificates 
SET series = 'BH', number = 25444 
WHERE user_id = 7;
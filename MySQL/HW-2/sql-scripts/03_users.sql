--  вибрати всіх користувачів із таблиці users, які зареєстрували свої поштові скриньки (email) у сервісі “gmail.com”

SELECT * 
FROM users 
WHERE email LIKE '%@gmail.com';

--  Видалити останні 5 записів з таблиці users

DELETE FROM users
ORDER BY id DESC;
LIMIT 5;

-- Вибрати прізвище surname користувача та ім'я name з таблиці users та відповідну назву регіону (поле name) із таблиці areas. 
-- Зв'язок: users.area_id = areas.id, відсортувати за назвою регіону. Вибрати всього 4 записи

SELECT 
    SUBSTRING_INDEX(users.fio, ' ', 1) AS name,
    SUBSTRING_INDEX(users.fio, ' ', -1) AS surname,
    areas.name AS region_name
FROM users
JOIN areas ON users.area_id = areas.id
ORDER BY areas.name
LIMIT 4;
--  вибрати всіх користувачів із таблиці users, які зареєстрували свої поштові скриньки (email) у сервісі “gmail.com”

SELECT * 
FROM users 
WHERE email LIKE '%@gmail.com';

--  Видалити останні 5 записів з таблиці users

DELETE FROM users
ORDER BY id DESC;
LIMIT 5;
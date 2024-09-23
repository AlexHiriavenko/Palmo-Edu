-- Використовуйте INNER JOIN між таблицями "Books" та "Authors" для отримання інформації про книги та їхніх авторів.
-- Знайти студентів, які не призначені жодному курсу:

SELECT 
    books.book_title, 
    authors.author_name 
FROM books
INNER JOIN authors ON books.author_id = authors.id;

-- Знайти кількість унікальних авторів книг у кожному жанрі:
-- Використовуйте INNER JOIN та GROUP BY для підрахунку кількості унікальних авторів кожного жанру в таблицях "Books" та "Genres".

SELECT 
    genres.genre_name, 
    COUNT(DISTINCT books.author_id) AS unique_authors
FROM books
INNER JOIN genres ON books.genre_id = genres.id
GROUP BY genres.genre_name;

-- Отримати список книг, які є улюбленими у більш як двох користувачів:
-- Використовуйте підзапит та GROUP BY для знаходження книг, які мають більше двох записів в таблиці "Favorites".

SELECT 
    books.book_title, 
    COUNT(favorites.user_id) AS favorites_count
FROM books
INNER JOIN favorites ON books.id = favorites.book_id
GROUP BY books.id
HAVING COUNT(favorites.user_id) > 2;

--  Отримати список користувачів, які не використовували систему протягом останнього місяця: 
-- Використовуйте підзапит та оператори порівняння для визначення користувачів, 
-- які не мають відповідних записів в таблиці "UserActivity" протягом останнього місяця. 

SELECT user_name
FROM users
WHERE 
    id NOT IN (
        SELECT user_id 
        FROM user_activity 
        WHERE activity_date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)
    );
-- Необхідно відобразити назви жанрів (name) з таблиці genres, які не мають жодної книги з таблиці books
-- Зв'язок books.genre_id=genres.id

SELECT genres.name
FROM genres
LEFT JOIN books ON genres.id = books.genre_id
WHERE books.genre_id IS NULL;
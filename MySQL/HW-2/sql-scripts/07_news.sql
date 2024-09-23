-- Необхідно вивести 10 новин з таблиці news, відсортувати за датою додавання created_at

SELECT * 
FROM news 
ORDER BY created_at DESC
LIMIT 10;

-- Необхідно порахувати скільки новин у кожній категорії
-- Зв'язок news.category_id = categories.id

SELECT categories.name AS category,  COUNT(news.id) AS number_news
FROM categories
LEFT JOIN news ON news.category_id = categories.id
GROUP BY categories.name

-- Вивести перші 5 записів з таблиці publishes, результат має містити такі поля: дата (publish_date) та текст (body)

SELECT publish_date, body
FROM publishes
ORDER BY publish_date
LIMIT 5;
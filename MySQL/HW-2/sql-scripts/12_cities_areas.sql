-- Вибрати назву міста (name) із таблиці cities та відповідну назву регіону (name) із таблиці areas. Зв'язок: cities.area_id = areas.id

SELECT cities.name AS city, areas.name AS area
FROM cities
LEFT JOIN areas ON cities.area_id = areas.id
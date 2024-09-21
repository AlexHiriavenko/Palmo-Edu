-- Вибрати назву школи (name) з таблиці schools та відповідну назву регіону (name) з таблиці districts. 
-- Зв'язок: schools.district_id = districts.id

SELECT schools.name AS school, districts.name AS district
FROM schools
LEFT JOIN districts ON schools.district_id = districts.id
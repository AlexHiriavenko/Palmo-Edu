--  Знайти мінімальне значення з поля count_students у таблиці організацій, де type_id = 5

SELECT MIN(count_students) FROM organizations WHERE type_id = 5;

-- Підрахувати кількість записів у таблиці organizations

SELECT COUNT(*) FROM organizations
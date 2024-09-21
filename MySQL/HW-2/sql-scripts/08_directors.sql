-- Необхідно вибрати номер телефону (phones) та ім'я (name) з таблиці директорів directors, 
-- у яких назва організації (organization) починається зі слова «ВНЗ»

SELECT phones, name FROM directors
WHERE organization LIKE 'ВНЗ%'  OR organization LIKE 'VNZ%';
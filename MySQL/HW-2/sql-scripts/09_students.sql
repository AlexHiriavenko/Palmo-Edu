--  Вивести surname з таблиці студентів students, які народилися в 1995 році (поле birthday має формат DATE)

SELECT surname FROM students WHERE YEAR(birthday) = 1995;
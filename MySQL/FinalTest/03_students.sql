-- 1.Вибрати всіх студентів

SELECT first_name, last_name
FROM Students;

-- 2. Вибрати курси з кількістю кредитів більше 4

SELECT course_name, credits
FROM Courses
WHERE credits > 4;

-- 3. Вибрати імена та прізвища студентів, які народилися після 1996 року

SELECT first_name, last_name, YEAR(birth_date) AS year_birthday
FROM Students
WHERE YEAR(birth_date) > 1996;

-- 4. Вибрати курси та їхню загальну кількість кредитів

SELECT 
  'all_courses' AS courses,
  SUM(credits) AS total_credits
FROM Courses;

-- 6. Підрахувати кількість студентів, які зареєстровані на кожен курс

SELECT 
    Courses.course_name, 
    COUNT(Enrollments.student_id) AS count_students
FROM Courses
LEFT JOIN Enrollments ON Courses.course_id = Enrollments.course_id
GROUP BY Courses.course_name;

-- 7. Знайти студентів, які не зареєстровані на жоден курс

SELECT Students.*
FROM Students
LEFT JOIN Enrollments ON Students.student_id = Enrollments.student_id
WHERE Enrollments.course_id IS NULL;

-- 11. Знайти студентів, які мають оцінки від 90 і вище

SELECT 
    Students.*,
    Grades.grade
FROM Students
JOIN Grades ON Students.student_id = Grades.student_id
WHERE Grades.grade >= 90;

-- 12. Підрахувати середній бал для кожного студента

SELECT 
    Students.*,
    AVG(Grades.grade) AS average_grade
FROM Students
JOIN Grades ON Students.student_id = Grades.student_id
GROUP BY Students.student_id;

-- 13. Знайти курси, на які зареєстровані всі студенти
-- что бы запрос вернул курс добавлены данные в "04_update_tables.sql"

SELECT Courses.course_name
FROM Courses
JOIN Enrollments ON Courses.course_id = Enrollments.course_id
GROUP BY Courses.course_id
HAVING COUNT(DISTINCT Enrollments.student_id) = (SELECT COUNT(*) FROM Students);

-- 15. Знайти студентів, які вступили в університет до свого 18-річчя
-- дата рождения Кейт изменена в 04_update_tables чтобы она попала в выборку

SELECT 
    *, 
    TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) AS age
FROM Students
WHERE TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) < 18;

-- 16. Отримати курси, які є улюбленими хоча б у двох студентів
-- добавлена таблица в 04_update_tables

SELECT 
    Courses.course_name, 
    COUNT(Favorite_Courses.student_id) AS student_count
FROM Courses
JOIN Favorite_Courses ON Courses.course_id = Favorite_Courses.course_id
GROUP BY Courses.course_id, Courses.course_name
HAVING COUNT(Favorite_Courses.student_id) >= 2;

-- 17. Знайти студентів, які зареєстровані на всі курси деякої категорії
-- добавлены категории в  04_update_tables
-- для того чтобы John Doe попал в выборку ему добавлен курс в категории 'Database'в  04_update_tables

SELECT 
    Students.student_id, 
    CONCAT(Students.first_name, ' ', Students.last_name) AS student_name
FROM Students
JOIN Enrollments ON Students.student_id = Enrollments.student_id
JOIN Courses ON Enrollments.course_id = Courses.course_id
WHERE Courses.category = 'Database'
GROUP BY Students.student_id
HAVING 
    COUNT(DISTINCT Courses.course_id) = (
        SELECT COUNT(*) 
        FROM Courses 
        WHERE category = 'Database'
    );

-- 18. Визначити найбільший бал серед всіх студентів
SELECT MAX(grade) AS highest_grade
FROM Grades;

-- 19. Вибрати студентів, які зареєстровані на курси більше одного разу
-- нет дублирующихся данных в выборке будет пусто

SELECT 
    student_id, 
    COUNT(course_id) AS registrations_count,
    course_id
FROM Enrollments
GROUP BY student_id, course_id
HAVING COUNT(course_id) > 1;

-- 21. Отримати імена та прізвища студентів, які зареєстровані на більше ніж один курс

SELECT 
    Students.first_name, 
    Students.last_name, 
    COUNT(Enrollments.course_id) AS course_count
FROM Students
JOIN Enrollments ON Students.student_id = Enrollments.student_id
GROUP BY Students.student_id
HAVING COUNT(Enrollments.course_id) > 1;

-- 22. Вибрати курси та кількість студентів, які на них зареєстровані

SELECT 
    Courses.course_name, 
    COUNT(Enrollments.student_id) AS student_count
FROM Courses
LEFT JOIN Enrollments ON Courses.course_id = Enrollments.course_id
GROUP BY Courses.course_id;


-- 23. Знайти всі пари студентів, які взяли хоча б один спільний курс

SELECT 
    Students1.student_id AS student1_id,
    CONCAT(Students1.first_name, ' ', Students1.last_name) AS student1_name,
    Students2.student_id AS student2_id,
    CONCAT(Students2.first_name, ' ', Students2.last_name) AS student2_name,
    Courses.course_name
FROM Enrollments Enrollments1
JOIN 
    Enrollments Enrollments2 
    ON Enrollments1.course_id = Enrollments2.course_id 
    AND Enrollments1.student_id < Enrollments2.student_id
JOIN 
    Students Students1 
    ON Enrollments1.student_id = Students1.student_id
JOIN 
    Students Students2 
    ON Enrollments2.student_id = Students2.student_id
JOIN 
    Courses 
    ON Enrollments1.course_id = Courses.course_id
ORDER BY 
    Students1.student_id, Students2.student_id, Courses.course_name;

-- 24. Отримати список курсів, на які не зареєстровано жодного студента

SELECT 
    Courses.course_id, 
    Courses.course_name
FROM Courses
LEFT JOIN Enrollments ON Courses.course_id = Enrollments.course_id
WHERE Enrollments.student_id IS NULL;

-- 25. Знайти кількість студентів, які зареєстровані на кожен курс, для курсів із зазначенням кількості
-- не понял задание до конца чем отличается от 

SELECT 
    Courses.course_name, 
    COUNT(Enrollments.student_id) AS student_count
FROM 
    Courses
LEFT JOIN Enrollments ON Courses.course_id = Enrollments.course_id
GROUP BY Courses.course_id;

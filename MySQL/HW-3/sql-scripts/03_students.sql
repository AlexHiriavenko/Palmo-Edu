-- Отримати список студентів із їхніми курсами:
-- Використовуйте INNER JOIN між таблицями "Students" та "Enrollments" для отримання імені студента та назви курсу, на якому вони зареєстровані.

SELECT 
    students.student_name, 
    courses.course_name
FROM students
INNER JOIN enrollments ON students.id = enrollments.student_id
INNER JOIN courses ON enrollments.course_id = courses.id;

-- Знайти студентів, які не призначені жодному курсу:
-- Використовуйте LEFT JOIN між таблицями "Students" та "Enrollments" та визначте нульові значення для записів, які не мають відповідних зв'язків.

SELECT 
    students.student_name AS student, 
    'no course' AS course
FROM students
LEFT JOIN enrollments ON students.id = enrollments.student_id
WHERE enrollments.id IS NULL;

-- Знайти студентів, які зареєстровані на всі курси:
-- Використовуйте підзапит для порівняння кількості курсів, на які студент зареєстрований, з загальною кількістю курсів.

SELECT student_name
FROM students
WHERE 
    (SELECT COUNT(*) 
     FROM enrollments 
     WHERE enrollments.student_id = students.id) = 
    (SELECT COUNT(*) 
     FROM courses);

-- Знайти студентів, які зареєстровані на більше одного курсу того ж дня:
-- Використовуйте підзапит для знаходження студентів, які мають більше одного запису в таблиці "Enrollments" для одного й того ж дня.

SELECT student_name 
FROM students 
WHERE 
    id IN (
        SELECT student_id 
        FROM enrollments 
        GROUP BY student_id, enrollment_date 
        HAVING COUNT(*) > 1
    );

-- Отримати список курсів, які мають більше 5 студентів:
-- Використовуйте GROUP BY та HAVING, щоб визначити курси, у яких кількість студентів перевищує 5.

SELECT 
    courses.course_name, 
    COUNT(enrollments.student_id) AS student_count 
FROM enrollments 
JOIN courses ON enrollments.course_id = courses.id
GROUP BY enrollments.course_id 
HAVING student_count > 5;


-- Отримати список студентів, які не мають оцінок:
-- Використовуйте LEFT JOIN та IS NULL для знаходження студентів, які не мають відповідних записів в таблиці "Grades".

SELECT students.student_name 
FROM students
LEFT JOIN grades ON students.id = grades.student_id
WHERE grades.id IS NULL;

-- Знайти курси, які мають хоча б одного студента з високими оцінками (більше 90):
-- Використовуйте INNER JOIN та підзапит для визначення курсів, у яких є студенти з високими оцінками.

SELECT courses.course_name
FROM courses
INNER JOIN grades ON courses.id = grades.course_id
WHERE 
    grades.course_id IN (
        SELECT course_id 
        FROM grades 
        WHERE grade > 90
    )
GROUP BY courses.id;

-- 2й вариант без подзапроса

SELECT courses.course_name
FROM courses
INNER JOIN grades ON courses.id = grades.course_id
WHERE grades.grade > 90
GROUP BY courses.course_name;

-- Отримати середній бал для кожного студента:
-- Використовуйте INNER JOIN та GROUP BY для визначення середнього балу для кожного студента на основі записів у таблиці "Grades".

SELECT 
    students.student_name, 
    AVG(grades.grade) AS average_grade
FROM students
INNER JOIN grades ON students.id = grades.student_id
GROUP BY students.id;


-- Отримати перелік студентів, які зареєстровані на курси вищого рівня (з більшою кількістю кредитів):
-- Використовуйте підзапит для визначення максимальної кількості кредитів серед усіх курсів, 
-- а потім INNER JOIN для вибору студентів, які зареєстровані на курси з цією кількістю кредитів.

SELECT students.student_name
FROM students
INNER JOIN enrollments ON students.id = enrollments.student_id
INNER JOIN courses ON enrollments.course_id = courses.id
WHERE 
    courses.credits = (
        SELECT MAX(credits)
        FROM courses
    );
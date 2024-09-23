-- Знайти вчителів, які ведуть більше одного курсу:
-- Використовуйте GROUP BY та HAVING, щоб визначити вчителів, які мають кілька записів в таблиці "Courses_Teachers".

SELECT 
  teachers.teacher_name AS teacher_has_several_courses, 
  COUNT(courses_teachers.course_id) AS number_courses
FROM teachers
JOIN courses_teachers ON teachers.id = courses_teachers.teacher_id
GROUP BY teachers.id
HAVING COUNT(courses_teachers.course_id) > 1;

-- Отримати кількість курсів для кожного вчителя:
-- Використовуйте підзапит, щоб підрахувати кількість курсів для кожного вчителя з таблиць "Courses_Teachers" та "Teachers".

SELECT 
  teacher_name,
  (
   SELECT COUNT(*)
   FROM courses_teachers
   WHERE courses_teachers.teacher_id = teachers.id
   ) AS number_courses
FROM teachers;

-- Знайти курси, які не мають вчителів:
-- Використовуйте NOT EXISTS або LEFT JOIN для знаходження курсів, які не мають відповідних записів в таблиці "Courses_Teachers".

SELECT courses.course_name
FROM courses
WHERE 
    NOT EXISTS (
        SELECT 1 
        FROM courses_teachers 
        WHERE courses_teachers.course_id = courses.id
    );

-- ///

SELECT 
    courses.course_name
FROM 
    courses
LEFT JOIN 
    courses_teachers ON courses.id = courses_teachers.course_id
WHERE 
    courses_teachers.course_id IS NULL;

-- Знайти всіх вчителів, які ведуть курси в більш ніж одній категорії:
-- Використовуйте підзапит для визначення вчителів, які мають записи в таблиці "Courses_Teachers" для курсів різних категорій.

SELECT teacher_name 
FROM teachers 
WHERE 
    id IN (
        SELECT teacher_id 
        FROM courses_teachers 
        JOIN courses ON courses_teachers.course_id = courses.id 
        GROUP BY teacher_id 
        HAVING COUNT(DISTINCT courses.category) > 1
    );

-- Знайти всіх вчителів, які ведуть курси з певного предмету:
-- Використовуйте INNER JOIN для з'єднання таблиць "Teachers" та "Courses_Teachers", щоб отримати вчителів, які ведуть курси з певного предмету.

SELECT teachers.teacher_name, courses.course_name
FROM teachers
INNER JOIN courses_teachers ON teachers.id = courses_teachers.teacher_id
INNER JOIN courses ON courses.id = courses_teachers.course_id
WHERE courses.course_name = 'Mathematics'
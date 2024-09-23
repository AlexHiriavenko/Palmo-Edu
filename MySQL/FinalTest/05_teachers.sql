-- 14 Визначити кількість курсів, які веде кожен вчитель

SELECT 
    teachers.teacher_name, 
    COUNT(courses_teachers.course_id) AS course_count
FROM teachers
JOIN courses_teachers ON teachers.id = courses_teachers.teacher_id
GROUP BY teachers.id, teachers.teacher_name;

-- 20. Знайти курси, які не мають жодного вчителя
-- в 04_update_tables.sql для most_popular_course удален учитель чтобы попасть в выборку

SELECT 
    Courses.course_id, 
    Courses.course_name
FROM Courses
LEFT JOIN courses_teachers ON Courses.course_id = courses_teachers.course_id
WHERE courses_teachers.course_id IS NULL;
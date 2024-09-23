-- добавим студента котоый не будет зареган ни на один курс

INSERT INTO Students (student_id, first_name, last_name, birth_date) 
VALUES (6, 'Sarah', 'Connor', '2000-12-01');

-- 8. Оновити кількість кредитів для курсу "Introduction to SQL" на 4

UPDATE Courses
SET credits = 4
WHERE course_name = 'Introduction to SQL';


-- 9.  Додати нового студента із ім'ям "Kate", прізвищем "Johnson" та датою народження "2000-12-18"

INSERT INTO Students (student_id, first_name, last_name, birth_date) 
VALUES (7, 'Kate', 'Johnson', '2000-12-18');

-- 10. Видалити студента з ім'ям "Alex" із таблиці "Students"

DELETE FROM Enrollments
WHERE student_id = (
    SELECT student_id 
    FROM Students 
    WHERE first_name = 'Alex'
    LIMIT 1
);

DELETE FROM Students
WHERE first_name = 'Alex'
LIMIT 1;

-- для выполнения таска 11

CREATE TABLE Grades (
    grade_id INT PRIMARY KEY AUTO_INCREMENT,
    student_id INT,
    course_id INT,
    grade INT
);

-- для таска 13
ALTER TABLE Enrollments 
MODIFY COLUMN enrollment_id INT AUTO_INCREMENT;

INSERT INTO Courses (course_id, course_name, credits) 
VALUES (106, 'most_popular_course', 3);

INSERT INTO Enrollments (student_id, course_id)
SELECT student_id, 106 
FROM Students;

-- для таска 14 из hw 3

CREATE TABLE teachers (
    id INT PRIMARY KEY AUTO_INCREMENT,         
    teacher_name VARCHAR(100) NOT NULL         
);


CREATE TABLE courses_teachers (
    id INT PRIMARY KEY AUTO_INCREMENT,         
    teacher_id INT,                            
    course_id INT                             
);

INSERT INTO teachers (teacher_name)
VALUES 
('Robert Williams'),
('Susan Clark'),
('James Anderson'),
('Patricia Martinez');

INSERT INTO courses_teachers (teacher_id, course_id)
VALUES 
(1, 101),  -- Robert Williams преподает 'Introduction to SQL'
(1, 103),  -- Robert Williams преподает 'Advanced SQL Queries'
(2, 102),  -- Susan Clark преподает 'Database Design'
(3, 104),  -- James Anderson преподает 'Data Modeling'
(4, 101),  -- Patricia Martinez также преподает 'Introduction to SQL'
(4, 105);  -- Patricia Martinez преподает 'SQL Performance Tuning'

-- для таска 15

UPDATE Students
SET birth_date = '2006-12-18'
WHERE first_name = 'Kate' AND last_name = 'Johnson';

-- для таска 16

CREATE TABLE Favorite_Courses (
    id INT PRIMARY KEY AUTO_INCREMENT,
    student_id INT,
    course_id INT
);


INSERT INTO Favorite_Courses (student_id, course_id) VALUES
(1, 101),  -- John Doe любит курс 'Introduction to SQL'
(1, 105),  -- John Doe также любит курс 'SQL Performance Tuning'
(2, 101),  -- Jane Smith любит курс 'Introduction to SQL'
(3, 102),  -- Mark Johnson любит курс 'Database Design'
(4, 103),  -- Emily Williams любит курс 'Advanced SQL Queries'
(6, 102),  -- Sarah Connor любит курс 'Database Design'
(7, 104);  -- Kate Johnson любит курс 'Data Modeling'

-- для таска 17 

ALTER TABLE Courses
ADD COLUMN category VARCHAR(50);

UPDATE Courses 
SET category = 'Database' 
WHERE course_id IN (101, 102, 103);

UPDATE Courses 
SET category = 'Data Science' 
WHERE course_id IN (104, 105);

INSERT INTO Enrollments (student_id, course_id) 
VALUES (1, 103);

-- для таска 20
DELETE FROM courses_teachers
WHERE course_id = 106;
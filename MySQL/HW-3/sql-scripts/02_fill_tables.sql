START TRANSACTION;

-- Вставка данных в таблицу students
INSERT INTO students (student_name, birth_date) 
VALUES 
('John Doe', '2001-05-10'),
('Jane Smith', '2000-12-22'),
('Michael Johnson', '2002-07-19'),
('Emily Davis', '1999-11-03'),
('Sarah Wilson', '2001-02-25'),
('David Brown', '2000-04-15'),
('Sophia Moore', '2002-10-30'),
('Liam Adams', '2001-03-15'),
('Olivia Martinez', '2002-08-09'),
('Noah Thompson', '2000-11-30'),
('Emma Garcia', '2001-07-24'),
('Ava Robinson', '2003-01-12');

-- Вставка данных в таблицу enrollments
INSERT INTO enrollments (student_id, course_id, enrollment_date)
VALUES 
(1, 1, '2023-09-01'),  -- John Doe записан на Mathematics
(1, 2, '2023-09-02'),  -- John Doe записан на Literature
(1, 3, '2023-09-02'),  -- John Doe записан на Physics
(1, 4, '2023-09-04'),  -- John Doe записан на Chemistry
(1, 5, '2023-09-05'),  -- John Doe записан на History
(1, 6, '2023-09-06'),  -- John Doe записан на Astronomy
(2, 3, '2023-09-01'),  -- Jane Smith записана на Physics
(2, 5, '2023-09-05'),  -- Jane Smith записана на History
(3, 4, '2023-09-01'),  -- Michael Johnson записан на Chemistry
(5, 1, '2023-09-02'),  -- Sarah Wilson записана на Mathematics
(6, 3, '2023-09-04'),  -- David Brown записан на Physics
(7, 1, '2023-09-05'),  -- Sophia Moore записана на Mathematics
(7, 5, '2023-09-05'),  -- Sophia Moore записана на History
(8, 1, '2023-09-01'),  -- Liam Adams записан на Mathematics
(8, 2, '2023-09-02'),  -- Liam Adams записан на Literature
(8, 5, '2023-09-02'),  -- Liam Adams записан на History
(9, 1, '2023-09-03'),  -- Olivia Martinez записана на Mathematics
(9, 3, '2023-09-03'),  -- Olivia Martinez записана на Physics
(9, 4, '2023-09-04'),  -- Olivia Martinez записана на Chemistry
(10, 5, '2023-09-05'), -- Noah Thompson записан на History
(11, 1, '2023-09-06'), -- Emma Garcia записана на Mathematics
(11, 2, '2023-09-07'), -- Emma Garcia записана на Literature
(12, 5, '2023-09-09'); -- Ava Robinson записана на History

-- Вставка данных в таблицу grades
INSERT INTO grades (student_id, course_id, grade, grade_date)
VALUES 
(1, 1, 95, '2023-09-10'),  -- John Doe получил 95 по Mathematics
(1, 2, 88, '2023-09-11'),  -- John Doe получил 88 по Literature
(2, 3, 91, '2023-09-10'),  -- Jane Smith получила 91 по Physics
(3, 4, 85, '2023-09-12'),  -- Michael Johnson получил 85 по Chemistry
(1, 6, 93, '2023-09-14'),  -- John Doe получил 93 по Astronomy
(5, 1, 80, '2023-09-15'),  -- Sarah Wilson получила 80 по Mathematics
(6, 3, 78, '2023-09-16'),  -- David Brown получил 78 по Physics
(7, 2, 89, '2023-09-17'),  -- Sophia Moore получила 89 по Literature
(1, 3, 90, '2023-09-12'),  -- John Doe получил 90 по Physics
(1, 4, 92, '2023-09-13'),  -- John Doe получил 92 по Chemistry
(1, 5, 85, '2023-09-15'),  -- John Doe получил 85 по History
(2, 5, 87, '2023-09-14'),  -- Jane Smith получила 87 по History
(8, 1, 75, '2023-09-18'),  -- Liam Adams получил 75 по Mathematics
(8, 2, 80, '2023-09-19'),  -- Liam Adams получил 80 по Literature
(9, 3, 82, '2023-09-20'),  -- Olivia Martinez получила 82 по Physics
(11, 1, 90, '2023-09-21'), -- Emma Garcia получила 90 по Mathematics
(12, 5, 78, '2023-09-22'), -- Ava Robinson получила 78 по History
(7, 1, 84, '2023-09-18'),  -- Sophia Moore получила 84 по Mathematics
(7, 5, 81, '2023-09-19'),  -- Sophia Moore получила 81 по History
(8, 5, 82, '2023-09-20'),  -- Liam Adams получил 82 по History
(9, 1, 86, '2023-09-21'),  -- Olivia Martinez получила 86 по Mathematics
(9, 4, 89, '2023-09-22');  -- Olivia Martinez получила 89 по Chemistry


-- ////////////////////////////////////////////////////////////////////////////////////

-- Вставка данных в таблицу Teachers
INSERT INTO teachers (teacher_name)
VALUES 
('Robert Williams'),
('Susan Clark'),
('James Anderson'),
('Patricia Martinez');

-- Вставка данных в таблицу Courses
INSERT INTO courses (course_name, category, credits)
VALUES 
('Mathematics', 'Science', 4),
('Literature', 'Arts', 3),
('Physics', 'Science', 5),
('Chemistry', 'Science', 4),
('History', 'Arts', 3),
('Astronomy', 'Science', 5);

-- Вставка данных в таблицу Courses_Teachers
INSERT INTO courses_teachers (teacher_id, course_id)
VALUES 
(1, 1),    -- Robert Williams преподает Mathematics, категория 'Science'
(1, 3),    -- Robert Williams преподает Physics, категория 'Science'
(2, 2),    -- Susan Clark преподает Literature, категория 'Arts'
(3, 4),    -- James Anderson преподает Chemistry, категория 'Science'
(4, 1),    -- Patricia Martinez преподает Mathematics, категория 'Science'
(4, 5);    -- Patricia Martinez преподает History, категория 'Arts'
           -- никто не ведет Astronomy


COMMIT;
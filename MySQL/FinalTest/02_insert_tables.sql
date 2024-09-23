INSERT INTO Students (student_id, first_name, last_name, birth_date) VALUES
(1, 'John', 'Doe', '1995-03-15'),
(2, 'Jane', 'Smith', '1998-07-22'),
(3, 'Mark', 'Johnson', '1997-01-10'),
(4, 'Emily', 'Williams', '1999-05-30'),
(5, 'Alex', 'Brown', '1996-09-12');

INSERT INTO Courses (course_id, course_name, credits) VALUES
(101, 'Introduction to SQL', 3),
(102, 'Database Design', 4),
(103, 'Advanced SQL Queries', 5),
(104, 'Data Modeling', 4),
(105, 'SQL Performance Tuning', 6);

INSERT INTO Enrollments (enrollment_id, student_id, course_id) VALUES
(1, 1, 101),
(2, 1, 102),
(3, 2, 103),
(4, 3, 104),
(5, 4, 101),
(6, 4, 103),
(7, 5, 102),
(8, 5, 105);

-- для выполнения таска 11 (Alex уже удален а Sara и Kate добавлены)

INSERT INTO Grades (student_id, course_id, grade) VALUES
(1, 101, 85),  -- John Doe
(1, 102, 90),  -- John Doe
(2, 103, 92),  -- Jane Smith
(3, 104, 88),  -- Mark Johnson
(4, 101, 95),  -- Emily Williams
(4, 103, 91),  -- Emily Williams
(6, 102, 87),  -- Sarah Connor
(7, 105, 93);  -- Kate Johnson
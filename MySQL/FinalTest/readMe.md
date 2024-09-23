# FinalTest MySQL

Таблиця "Students":
CREATE TABLE Students (
student_id INT PRIMARY KEY,
first_name VARCHAR(50),
last_name VARCHAR(50),
birth_date DATE
);

INSERT INTO Students (student_id, first_name, last_name, birth_date) VALUES
(1, 'John', 'Doe', '1995-03-15'),
(2, 'Jane', 'Smith', '1998-07-22'),
(3, 'Mark', 'Johnson', '1997-01-10'),
(4, 'Emily', 'Williams', '1999-05-30'),
(5, 'Alex', 'Brown', '1996-09-12');

Таблиця "Courses":
CREATE TABLE Courses (
course_id INT PRIMARY KEY,
course_name VARCHAR(100),
credits INT
);

INSERT INTO Courses (course_id, course_name, credits) VALUES
(101, 'Introduction to SQL', 3),
(102, 'Database Design', 4),
(103, 'Advanced SQL Queries', 5),
(104, 'Data Modeling', 4),
(105, 'SQL Performance Tuning', 6);

1.Вибрати всіх студентів 2. Вибрати курси з кількістю кредитів більше 4 3. Вибрати імена та прізвища студентів, які народилися після 1996 року 4. Вибрати курси та їхню загальну кількість кредитів 5. Вибрати студентів, які зареєстровані на курси, із сортуванням за прізвищем 6. Підрахувати кількість студентів, які зареєстровані на кожен курс 7. Знайти студентів, які не зареєстровані на жоден курс 8. Оновити кількість кредитів для курсу "Introduction to SQL" на 4 9. Додати нового студента із ім'ям "Kate", прізвищем "Johnson" та датою народження "2000-12-18" 10. Видалити студента з ім'ям "Alex" із таблиці "Students" 11. Знайти студентів, які мають оцінки від 90 і вище 12. Підрахувати середній бал для кожного студента 13. Знайти курси, на які зареєстровані всі студенти 14. Визначити кількість курсів, які веде кожен вчитель 15. Знайти студентів, які вступили в університет до свого 18-річчя 16. Отримати курси, які є улюбленими хоча б у двох студентів 17. Знайти студентів, які зареєстровані на всі курси деякої категорії 18. Визначити найбільший бал серед всіх студентів 19. Вибрати студентів, які зареєстровані на курси більше одного разу 20. Знайти курси, які не мають жодного вчителя

Таблиці "Students", "Courses", та "Enrollments":
CREATE TABLE Students (
student_id INT PRIMARY KEY,
first_name VARCHAR(50),
last_name VARCHAR(50),
birth_date DATE
);

CREATE TABLE Courses (
course_id INT PRIMARY KEY,
course_name VARCHAR(100),
credits INT
);

CREATE TABLE Enrollments (
enrollment_id INT PRIMARY KEY,
student_id INT,
course_id INT,
FOREIGN KEY (student_id) REFERENCES Students(student_id),
FOREIGN KEY (course_id) REFERENCES Courses(course_id)
);

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

21. Отримати імена та прізвища студентів, які зареєстровані на більше ніж один курс
22. Вибрати курси та кількість студентів, які на них зареєстровані
23. Знайти всі пари студентів, які взяли хоча б один спільний курс
24. Отримати список курсів, на які не зареєстровано жодного студента
25. Знайти кількість студентів, які зареєстровані на кожен курс, для курсів із зазначенням кількості

START TRANSACTION;

-- Таблица Students (Студенты)
CREATE TABLE students (
    id INT PRIMARY KEY AUTO_INCREMENT,
    student_name VARCHAR(100) NOT NULL,
    birth_date DATE NOT NULL 
);

-- Таблица Enrollments (Регистрации на курсы)
CREATE TABLE enrollments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    student_id INT,
    course_id INT,
    enrollment_date DATE NOT NULL 
);
-- //////////////////////////////////////////////////////////

-- Таблица Teachers (Преподаватели)
CREATE TABLE teachers (
    id INT PRIMARY KEY AUTO_INCREMENT,         
    teacher_name VARCHAR(100) NOT NULL         
);

-- Таблица Courses (Курсы)
CREATE TABLE courses (
    id INT PRIMARY KEY AUTO_INCREMENT,
    course_name VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    credits INT NOT NULL 
);

-- Таблица Courses_Teachers (Связь между курсами и преподавателями)
CREATE TABLE courses_teachers (
    id INT PRIMARY KEY AUTO_INCREMENT,         
    teacher_id INT,                            
    course_id INT,                             
    FOREIGN KEY (teacher_id) REFERENCES teachers(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
);

CREATE TABLE grades (
    id INT PRIMARY KEY AUTO_INCREMENT,
    student_id INT,
    course_id INT,
    grade INT NOT NULL,
    grade_date DATE NOT NULL
);

COMMIT;
START TRANSACTION;

-- <<< students >>>

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

CREATE TABLE grades (
    id INT PRIMARY KEY AUTO_INCREMENT,
    student_id INT,
    course_id INT,
    grade INT NOT NULL,
    grade_date DATE NOT NULL
);

-- Таблица Courses (Курсы)
CREATE TABLE courses (
    id INT PRIMARY KEY AUTO_INCREMENT,
    course_name VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    credits INT NOT NULL 
);


-- <<< teachers >>>

-- Таблица Teachers (Преподаватели)
CREATE TABLE teachers (
    id INT PRIMARY KEY AUTO_INCREMENT,         
    teacher_name VARCHAR(100) NOT NULL         
);


-- Таблица Courses_Teachers (Связь между курсами и преподавателями)
CREATE TABLE courses_teachers (
    id INT PRIMARY KEY AUTO_INCREMENT,         
    teacher_id INT,                            
    course_id INT,                             
    FOREIGN KEY (teacher_id) REFERENCES teachers(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
);

-- <<< books >>>

-- Таблица Authors (Авторы)
CREATE TABLE authors (
    id INT PRIMARY KEY AUTO_INCREMENT,
    author_name VARCHAR(100) NOT NULL
);

-- Таблица Books (Книги)
CREATE TABLE books (
    id INT PRIMARY KEY AUTO_INCREMENT,
    book_title VARCHAR(100) NOT NULL,
    genre_id INT,
    author_id INT,
    FOREIGN KEY (author_id) REFERENCES authors(id)
);

-- Таблица Genres (Жанры)
CREATE TABLE genres (
    id INT PRIMARY KEY AUTO_INCREMENT,
    genre_name VARCHAR(50) NOT NULL
);

-- Таблица Books_Genres (Связь между книгами и жанрами)
CREATE TABLE books_genres (
    id INT PRIMARY KEY AUTO_INCREMENT,
    book_id INT,
    genre_id INT,
    FOREIGN KEY (book_id) REFERENCES books(id),
    FOREIGN KEY (genre_id) REFERENCES genres(id)
);

-- Таблица Users (Пользователи)
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(100) NOT NULL
);

-- Таблица Favorites (Избранное)
CREATE TABLE favorites (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    book_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (book_id) REFERENCES books(id)
);

-- Таблица user_activity
CREATE TABLE user_activity (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    activity_date DATE NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

COMMIT;
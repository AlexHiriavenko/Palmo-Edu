START TRANSACTION;

-- Заполняем таблицу users
INSERT INTO users (email, fio, area_id) VALUES
('john.doe@gmail.com', 'John Doe', 1),
('jane.smith@yahoo.com', 'Jane Smith', 2),
('robert.johnson@gmail.com', 'Robert Johnson', 3),
('emily.davis@gmail.com', 'Emily Davis', 4),
('michael.brown@hotmail.com', 'Michael Brown', 5),
('william.jones@gmail.com', 'William Jones', 6),
('sophia.miller@yahoo.com', 'Sophia Miller', 7),
('oliver.wilson@gmail.com', 'Oliver Wilson', 8),
('liam.moore@gmail.com', 'Liam Moore', 9),
('emma.taylor@gmail.com', 'Emma Taylor', 10);

-- Заполняем таблицу certificates
INSERT INTO certificates (number, fio, year, user_id, series) VALUES
(12345, 'John Doe', 2020, 1, 'AA'),
(54321, 'Jane Smith', NULL, 2, 'BB'),
(67890, 'Robert Johnson', 2019, 3, 'CC'),
(98765, 'Emily Davis', NULL, 4, 'DD'),
(11223, 'Michael Brown', 2018, 5, 'EE'),
(22334, 'William Jones', NULL, 6, 'FF'),
(33445, 'Sophia Miller', 2021, 7, 'GG'),
(44556, 'Oliver Wilson', NULL, 8, 'HH'),
(55667, 'Liam Moore', 2022, 9, 'II'),
(66778, 'Emma Taylor', 2020, 10, 'JJ');

-- Заполняем таблицу organizations
INSERT INTO organizations (name, count_students, type_id) VALUES
('Greenwood High School', 450, 5),
('Springfield University', 1200, 2),
('Riverdale College', 850, 5),
('Westwood Institute', 600, 4),
('Hill Valley Academy', 700, 5),
('Mountainview College', 500, 3),
('Sunnydale High School', 400, 5),
('Evergreen School', 300, 5),
('Silver Oak University', 1500, 2),
('Palm Grove Institute', 900, 4);

-- Заполняем таблицу practice
INSERT INTO practice (practice_id, rating) VALUES
(1888, 8),
(1889, 7),
(1890, 9),
(1888, 10),
(1891, 6),
(1888, 9),
(1892, 5),
(1888, 7),
(1893, 8),
(1888, 6);

-- Заполняем таблицу news
INSERT INTO news (title, created_at, category_id) VALUES
('New Education Policy Announced', '2023-08-10', 1),
('Local School Wins Championship', '2023-08-12', 2),
('University Expands Campus', '2023-08-15', 1),
('Scholarship Opportunities', '2023-08-18', 3),
('New Library Inauguration', '2023-08-20', 2),
('Science Fair at Riverdale College', '2023-08-22', 1),
('Job Fair Announced', '2023-08-25', 3),
('City to Build New Schools', '2023-08-27', 2),
('Sports Meet at Springfield University', '2023-08-29', 1),
('New Law on Education Funding', '2023-09-01', 3);

-- Заполняем таблицу directors
INSERT INTO directors (name, phones, organization) VALUES
('David Johnson', '555-1234', 'VNZ University'),
('Susan Lee', '555-5678', 'VNZ College'),
('George Brown', '555-9012', 'VNZ Academy'),
('Emily Clark', '555-3456', 'Westwood Institute'),
('Michael Scott', '555-7890', 'Hill Valley Academy'),
('Olivia Davis', '555-6543', 'Greenwood High School'),
('Sophia Johnson', '555-3210', 'Sunnydale High School'),
('Liam Wilson', '555-0987', 'Riverdale College'),
('Emma Taylor', '555-8765', 'Palm Grove Institute'),
('Oliver Moore', '555-4321', 'Silver Oak University');

-- Заполняем таблицу students
INSERT INTO students (surname, birthday) VALUES
('Johnson', '1995-01-15'),
('Smith', '1995-02-20'),
('Brown', '1995-03-25'),
('Taylor', '1995-04-30'),
('Anderson', '1995-05-10'),
('Thomas', '1995-06-05'),
('Jackson', '1995-07-22'),
('White', '1995-08-18'),
('Harris', '1995-09-29'),
('Martin', '1995-10-13');

-- Заполняем таблицу publishes
INSERT INTO publishes (publish_date, body) VALUES
('2023-09-01', 'New policies for school education.'),
('2023-09-02', 'Research opportunities for students.'),
('2023-09-03', 'Government announces new funding.'),
('2023-09-04', 'Educational fair this week.'),
('2023-09-05', 'New collaboration with international universities.'),
('2023-09-06', 'Student exchange programs introduced.'),
('2023-09-07', 'Schools to implement new teaching methods.'),
('2023-09-08', 'Technology in education conference.'),
('2023-09-09', 'Changes in the academic calendar.'),
('2023-09-10', 'New student housing facilities.');

-- Заполняем таблицу genres
INSERT INTO genres (name) VALUES
('Science Fiction'),
('Romance'),
('Thriller'),
('Fantasy'),
('Biography'),
('History'),
('Self-help'),
('Drama'),
('Mystery'),
('Adventure');

-- Заполняем таблицу books
INSERT INTO books (title, genre_id) VALUES
('Dune', 1),
('Pride and Prejudice', 2),
('The Da Vinci Code', 3),
('Harry Potter', 4),
('Steve Jobs', 5),
('The Art of War', 6),
('The Power of Habit', 7),
('Hamlet', 8),
('Sherlock Holmes', 9),
('The Hobbit', 4);

-- Заполняем таблицу areas
INSERT INTO areas (name) VALUES
('California'),
('New York'),
('Texas'),
('Florida'),
('Illinois'),
('Ohio'),
('Georgia'),
('North Carolina'),
('Michigan'),
('Pennsylvania');

-- Заполняем таблицу categories
INSERT INTO categories (name) VALUES
('Education'),
('Sports'),
('Government'),
('Technology'),
('Health'),
('Business'),
('Science'),
('Entertainment'),
('Travel'),
('Lifestyle');

-- Заполняем таблицу cities
INSERT INTO cities (name, area_id) VALUES
('Los Angeles', 1),
('New York City', 2),
('Houston', 3),
('Miami', 4),
('Chicago', 5),
('Cleveland', 6),
('Atlanta', 7),
('Charlotte', 8),
('Detroit', 9),
('Philadelphia', 10);

-- Заполняем таблицу schools
INSERT INTO schools (name, district_id) VALUES
('Greenwood High', 1),
('Riverdale High', 2),
('Sunnydale High', 3),
('Westwood High', 4),
('Evergreen School', 5),
('Hill Valley High', 6),
('Mountainview School', 7),
('Palm Grove School', 8),
('Silver Oak School', 9),
('Springfield High', 10);

-- Заполняем таблицу districts
INSERT INTO districts (name) VALUES
('North District'),
('East District'),
('South District'),
('West District'),
('Central District'),
('Mountain District'),
('Valley District'),
('Coastal District'),
('Urban District'),
('Rural District');

COMMIT;
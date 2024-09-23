-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: db:3306
-- Время создания: Сен 23 2024 г., 17:20
-- Версия сервера: 9.0.1
-- Версия PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `testing_alex_part_1`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Courses`
--

CREATE TABLE `Courses` (
  `course_id` int NOT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `credits` int DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Courses`
--

INSERT INTO `Courses` (`course_id`, `course_name`, `credits`, `category`) VALUES
(101, 'Introduction to SQL', 4, 'Database'),
(102, 'Database Design', 4, 'Database'),
(103, 'Advanced SQL Queries', 5, 'Database'),
(104, 'Data Modeling', 4, 'Data Science'),
(105, 'SQL Performance Tuning', 6, 'Data Science'),
(106, 'most_popular_course', 3, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `courses_teachers`
--

CREATE TABLE `courses_teachers` (
  `id` int NOT NULL,
  `teacher_id` int DEFAULT NULL,
  `course_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `courses_teachers`
--

INSERT INTO `courses_teachers` (`id`, `teacher_id`, `course_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 2, 2),
(4, 3, 4),
(5, 4, 1),
(6, 4, 5),
(7, 1, 101),
(8, 1, 103),
(9, 2, 102),
(10, 3, 104),
(11, 4, 101),
(12, 4, 105);

-- --------------------------------------------------------

--
-- Структура таблицы `Enrollments`
--

CREATE TABLE `Enrollments` (
  `enrollment_id` int NOT NULL,
  `student_id` int DEFAULT NULL,
  `course_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Enrollments`
--

INSERT INTO `Enrollments` (`enrollment_id`, `student_id`, `course_id`) VALUES
(1, 1, 101),
(2, 1, 102),
(3, 2, 103),
(4, 3, 104),
(5, 4, 101),
(6, 4, 103),
(7, 1, 106),
(8, 2, 106),
(9, 3, 106),
(10, 4, 106),
(11, 6, 106),
(12, 7, 106),
(14, 1, 103);

-- --------------------------------------------------------

--
-- Структура таблицы `Favorite_Courses`
--

CREATE TABLE `Favorite_Courses` (
  `id` int NOT NULL,
  `student_id` int DEFAULT NULL,
  `course_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Favorite_Courses`
--

INSERT INTO `Favorite_Courses` (`id`, `student_id`, `course_id`) VALUES
(1, 1, 101),
(2, 1, 105),
(3, 2, 101),
(4, 3, 102),
(5, 4, 103),
(6, 6, 102),
(7, 7, 104);

-- --------------------------------------------------------

--
-- Структура таблицы `Grades`
--

CREATE TABLE `Grades` (
  `grade_id` int NOT NULL,
  `student_id` int DEFAULT NULL,
  `course_id` int DEFAULT NULL,
  `grade` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Grades`
--

INSERT INTO `Grades` (`grade_id`, `student_id`, `course_id`, `grade`) VALUES
(1, 1, 101, 85),
(2, 1, 102, 90),
(3, 2, 103, 92),
(4, 3, 104, 88),
(5, 4, 101, 95),
(6, 4, 103, 91),
(7, 6, 102, 87),
(8, 7, 105, 93);

-- --------------------------------------------------------

--
-- Структура таблицы `Students`
--

CREATE TABLE `Students` (
  `student_id` int NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `birth_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Students`
--

INSERT INTO `Students` (`student_id`, `first_name`, `last_name`, `birth_date`) VALUES
(1, 'John', 'Doe', '1995-03-15'),
(2, 'Jane', 'Smith', '1998-07-22'),
(3, 'Mark', 'Johnson', '1997-01-10'),
(4, 'Emily', 'Williams', '1999-05-30'),
(6, 'Sarah', 'Connor', '2000-12-01'),
(7, 'Kate', 'Johnson', '2006-12-18');

-- --------------------------------------------------------

--
-- Структура таблицы `teachers`
--

CREATE TABLE `teachers` (
  `id` int NOT NULL,
  `teacher_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `teachers`
--

INSERT INTO `teachers` (`id`, `teacher_name`) VALUES
(1, 'Robert Williams'),
(2, 'Susan Clark'),
(3, 'James Anderson'),
(4, 'Patricia Martinez');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Courses`
--
ALTER TABLE `Courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Индексы таблицы `courses_teachers`
--
ALTER TABLE `courses_teachers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Enrollments`
--
ALTER TABLE `Enrollments`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Индексы таблицы `Favorite_Courses`
--
ALTER TABLE `Favorite_Courses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Grades`
--
ALTER TABLE `Grades`
  ADD PRIMARY KEY (`grade_id`);

--
-- Индексы таблицы `Students`
--
ALTER TABLE `Students`
  ADD PRIMARY KEY (`student_id`);

--
-- Индексы таблицы `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `courses_teachers`
--
ALTER TABLE `courses_teachers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `Enrollments`
--
ALTER TABLE `Enrollments`
  MODIFY `enrollment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `Favorite_Courses`
--
ALTER TABLE `Favorite_Courses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `Grades`
--
ALTER TABLE `Grades`
  MODIFY `grade_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Enrollments`
--
ALTER TABLE `Enrollments`
  ADD CONSTRAINT `Enrollments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `Students` (`student_id`),
  ADD CONSTRAINT `Enrollments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `Courses` (`course_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

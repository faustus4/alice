-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.11-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for cai_db
DROP DATABASE IF EXISTS `cai_db`;
CREATE DATABASE IF NOT EXISTS `cai_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `cai_db`;

-- Dumping structure for table cai_db.activities
DROP TABLE IF EXISTS `activities`;
CREATE TABLE IF NOT EXISTS `activities` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) DEFAULT NULL,
  `activity_name` varchar(250) DEFAULT NULL,
  `activity_description` varchar(500) DEFAULT NULL,
  `file_name` varchar(250) DEFAULT NULL,
  `date_updated` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cai_db.activities: ~2 rows (approximately)
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
REPLACE INTO `activities` (`activity_id`, `subject_id`, `activity_name`, `activity_description`, `file_name`, `date_updated`) VALUES
	(1, 1, 'Regula Benifitss', 'test', '1580351485.pdf', '2020-01-30 20:16:02'),
	(2, 1, 'Play With Friends', 'test', '1580288779.pdf', '2020-01-30 10:30:41');
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;

-- Dumping structure for table cai_db.lessons
DROP TABLE IF EXISTS `lessons`;
CREATE TABLE IF NOT EXISTS `lessons` (
  `lesson_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) DEFAULT NULL,
  `lesson_description` varchar(500) DEFAULT NULL,
  `lesson_name` varchar(500) DEFAULT NULL,
  `file_name` varchar(500) DEFAULT NULL,
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`lesson_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cai_db.lessons: ~0 rows (approximately)
/*!40000 ALTER TABLE `lessons` DISABLE KEYS */;
REPLACE INTO `lessons` (`lesson_id`, `subject_id`, `lesson_description`, `lesson_name`, `file_name`, `date_updated`) VALUES
	(3, 1, 'This will teach the student of Bla Bla', 'Dress Making Intro', '1580218715.odp', '2020-01-28 00:23:29'),
	(4, 2, 'CSS Lesson', 'Lesson in CSS', '1580374113.pdf', '2020-01-30 16:48:33'),
	(5, 6, 'Hello', 'PHP Introduction', '1580378127.', '2020-01-30 17:55:27');
/*!40000 ALTER TABLE `lessons` ENABLE KEYS */;

-- Dumping structure for table cai_db.quizzes
DROP TABLE IF EXISTS `quizzes`;
CREATE TABLE IF NOT EXISTS `quizzes` (
  `quiz_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_id` int(11) DEFAULT NULL,
  `question_items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`question_items`)),
  `quiz_name` varchar(250) DEFAULT NULL,
  `date_updated` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`quiz_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cai_db.quizzes: ~5 rows (approximately)
/*!40000 ALTER TABLE `quizzes` DISABLE KEYS */;
REPLACE INTO `quizzes` (`quiz_id`, `subject_id`, `question_items`, `quiz_name`, `date_updated`) VALUES
	(1, 1, '[{"type":"multipleChoice","question":"Sino pumatay kay lapu lapu?","choices":["Layla","Hylos","Cyborg","Angela"],"answer":"C"}]', 'Mobile Legend Quizzes', '2020-01-30 20:08:35'),
	(2, 1, '[{"type":"multipleChoice","question":"What is the name of the main protagonist in BOTW?","choices":["Link","Zelda","Roach","Geralt"],"answer":"A"}]', 'Legend of Zelda Quiz', '2020-01-30 18:00:26'),
	(3, 1, '[{"type":"multipleChoice","question":"n","choices":["j","k","l","h"],"answer":"A"}]', 'Elder Scroll Skyrim', '2020-01-30 18:00:28'),
	(4, 1, '[{"type":"multipleChoice","question":"n","choices":["j","k","l","h"],"answer":"A"}]', 'CSS Quiz #1', '2020-01-29 16:08:29'),
	(5, 1, '[{"type":"multipleChoice","question":"Who is the most handsome dev on KOMO?","choices":["Darwin","Billy","Erwin","Marc"],"answer":"C"},{"type":"trueOrFalse","question":"Is Erwin Handsome?","choices":["","","",""],"answer":"TRUE"}]', 'KOMO Quiz', '2020-01-29 16:16:41'),
	(6, 2, '[{"type":"fillInTheBlank","question":"asdfadsf","choices":["","","",""],"answer":"adfdsf"}]', 'adsfadf', '2020-01-30 20:08:56');
/*!40000 ALTER TABLE `quizzes` ENABLE KEYS */;

-- Dumping structure for table cai_db.students
DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(500) DEFAULT NULL,
  `fname` varchar(500) DEFAULT NULL,
  `mname` varchar(500) DEFAULT NULL,
  `lname` varchar(500) DEFAULT NULL,
  `section` varchar(500) DEFAULT NULL,
  `school_year` varchar(500) DEFAULT NULL,
  `default_password` varchar(500) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cai_db.students: ~2 rows (approximately)
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
REPLACE INTO `students` (`id`, `student_id`, `fname`, `mname`, `lname`, `section`, `school_year`, `default_password`, `password`) VALUES
	(3, '73157', 'Erwin', 'Lirazan', 'Daza', 'SOC1', '2009-2010', '637854', NULL),
	(4, '73156', 'Maria Jessa', 'Navida', 'Daza', 'SOC2', '317964', '317964', NULL);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;

-- Dumping structure for table cai_db.subjects
DROP TABLE IF EXISTS `subjects`;
CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `learning_area` int(11) NOT NULL DEFAULT 0,
  `name` varchar(500) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cai_db.subjects: ~4 rows (approximately)
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
REPLACE INTO `subjects` (`id`, `learning_area`, `name`) VALUES
	(1, 1, 'Dress Making'),
	(2, 1, 'CSS'),
	(3, 1, 'Carpentry'),
	(4, 1, 'Horticulture'),
	(5, 2, 'Javascript'),
	(6, 2, 'PHP');
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;

-- Dumping structure for table cai_db.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cai_db.users: ~0 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `username`, `password`) VALUES
	(1, 'admin', 'admin');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

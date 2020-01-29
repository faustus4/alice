-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.11-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cai_db.lessons: ~0 rows (approximately)
/*!40000 ALTER TABLE `lessons` DISABLE KEYS */;
INSERT INTO `lessons` (`lesson_id`, `subject_id`, `lesson_description`, `lesson_name`, `file_name`, `date_updated`) VALUES
	(3, 0, 'intro to css', 'Javascript Introduction', '1580218715.odp', '2020-01-28 00:23:29');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cai_db.quizzes: ~4 rows (approximately)
/*!40000 ALTER TABLE `quizzes` DISABLE KEYS */;
INSERT INTO `quizzes` (`quiz_id`, `subject_id`, `question_items`, `quiz_name`, `date_updated`) VALUES
	(1, 0, '[{"type":"multipleChoice","question":"n","choices":["j","k","l","h"],"answer":"A"}]', 'fcfg', '2020-01-28 22:53:45'),
	(2, 0, '[{"type":"multipleChoice","question":"n","choices":["j","k","l","h"],"answer":"A"}]', 'fcfg', '2020-01-28 22:55:45'),
	(3, 0, '[{"type":"multipleChoice","question":"n","choices":["j","k","l","h"],"answer":"A"}]', 'fcfg', '2020-01-28 22:56:15'),
	(4, 1, '[{"type":"multipleChoice","question":"n","choices":["j","k","l","h"],"answer":"A"}]', 'fcfg', '2020-01-28 22:56:58');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cai_db.students: ~0 rows (approximately)
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
/*!40000 ALTER TABLE `students` ENABLE KEYS */;

-- Dumping structure for table cai_db.subjects
DROP TABLE IF EXISTS `subjects`;
CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table cai_db.subjects: ~4 rows (approximately)
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
INSERT INTO `subjects` (`id`, `name`) VALUES
	(1, 'Home Economics'),
	(2, 'ICT'),
	(3, 'Industrial Arts'),
	(4, 'AFA');
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
INSERT INTO `users` (`id`, `username`, `password`) VALUES
	(1, 'admin', 'admin');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

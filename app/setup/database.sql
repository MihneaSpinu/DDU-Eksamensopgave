-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moodleeksamen`
--

-- --------------------------------------------------------

CREATE TABLE `school`
(
    `school_ID` INT(11) NOT NULL AUTO_INCREMENT,
    `school_name` VARCHAR(255) NOT NULL,
    `school_adress` VARCHAR(255) NOT NULL,
    `school_zip` INT(11) NOT NULL,
    `school_city` VARCHAR(255) NOT NULL,
    `school_phone` VARCHAR(255) NOT NULL,
    `school_email` VARCHAR(255) NOT NULL,
    `school_page` VARCHAR(255) NOT NULL,

    PRIMARY KEY (`school_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `school` (`school_ID`, `school_name`, `school_adress`, `school_zip`, `school_city`, `school_phone`, `school_email`, `school_page`) VALUES
(1, 'Hansenberg', 'Skovvangen 28', 6000, 'Kolding', '79 32 01 00', 'hansenberg@email.dk', 'hansenberg.dk');

-- --------------------------------------------------------

CREATE TABLE `user_type`
(
    `user_type_ID` INT(11) NOT NULL AUTO_INCREMENT,
    `name`   VARCHAR(255) NOT NULL,
    `permissions` text NOT NULL,

    PRIMARY KEY (`user_type_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user_type` (`user_type_ID`, `name`, `permissions`) VALUES
(1, 'student', '{"edit_homework":0, "edit_submissions":0, "create_schedule":0, "administrate_site":0}'),
(2, 'teacher', '{"edit_homework":1, "edit_submissions":1, "create_schedule":1, "administrate_site":0}'),
(3, 'scheduler', '{"edit_homework":0, "edit_submissions":0, "create_schedule":1, "administrate_site":0}'),
(4, 'censor', '{"edit_homework":0, "edit_submissions":1, "create_schedule":1, "administrate_site":0}'),
(5, 'admin', '{"edit_homework":0, "edit_submissions":0, "create_schedule":0, "administrate_site":1}');

-- --------------------------------------------------------

CREATE TABLE `users`
(
    `uid` INT(11) NOT NULL AUTO_INCREMENT,
    `user_type_ID` INT(11) NOT NULL,
    `school_ID` INT(11) NOT NULL,
    `firstname` VARCHAR(255) NOT NULL,
    `lastname` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `date_created` DATE NOT NULL,
    `written_absence` INT(11) NOT NULL DEFAULT 0,
    
    PRIMARY KEY (`uid`, `user_type_ID`, `school_ID`),
    FOREIGN KEY (`user_type_ID`) REFERENCES `user_type` (`user_type_ID`),
    FOREIGN KEY (`school_ID`) REFERENCES `school` (`school_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`uid`, `user_type_ID`, `school_ID`, `firstname`, `lastname`, `email`, `password`, `date_created`) VALUES
(1, 1, 1, 'Gunnar Máni', 'Jóhannsson', 'gunnarmani@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(2, 2, 1, 'Torsten Skov', 'Fix', 'torstenskov@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21');

-- --------------------------------------------------------

CREATE TABLE `user_sessions`
(
    `session_id` INT(11) NOT NULL AUTO_INCREMENT,
    `uid` INT(11) NOT NULL,
    `session_key` VARCHAR(255) NOT NULL,
    `session_value` VARCHAR(255) NOT NULL,
    `session_expire` DATE NOT NULL,

    PRIMARY KEY (`session_id`, `uid`),
    FOREIGN KEY (`uid`) REFERENCES `users` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `class`
(
    `class_ID` INT(11) NOT NULL AUTO_INCREMENT,
    `school_ID` INT(11) NOT NULL,
    `class_name` VARCHAR(255) NOT NULL,
    `class_teacher_ID` INT(11) NOT NULL,

    PRIMARY KEY (`class_ID`, `school_ID`),
    FOREIGN KEY (`class_teacher_ID`) REFERENCES `users` (`uid`),
    FOREIGN KEY (`school_ID`) REFERENCES `school` (`school_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `subject`
(
    `subject_ID` INT(11) NOT NULL AUTO_INCREMENT,
    `school_ID` INT(11) NOT NULL,
    `subject_name` VARCHAR(255) NOT NULL,

    PRIMARY KEY (`subject_ID`, `school_ID`),
    FOREIGN KEY (`school_ID`) REFERENCES `school` (`school_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `subject` (`subject_ID`, `school_ID`, `subject_name`) VALUES
(1, 1, 'Matematik C'),
(2, 1, 'Matematik B'),
(3, 1, 'Matematik A'),
(4, 1, 'Dansk C'),
(5, 1, 'Dansk B'),
(6, 1, 'Dansk A'),
(7, 1, 'Engelsk C'),
(8, 1, 'Engelsk B'),
(9, 1, 'Engelsk A'),
(10, 1, 'Idehistorie C'),
(11, 1, 'Idehistorie B'),
(12, 1, 'Idehistorie A'),
(13, 1, 'Programmering C'),
(14, 1, 'Programmering B'),
(15, 1, 'Programmering A'),
(16, 1, 'Fysik C'),
(17, 1, 'Fysik B'),
(18, 1, 'Fysik A'),
(19, 1, 'Kemi C'),
(20, 1, 'Kemi B'),
(21, 1, 'Kemi A'),
(22, 1, 'Biologi C'),
(23, 1, 'Biologi B'),
(24, 1, 'Biologi A'),
(25, 1, 'Samfundsfag C'),
(26, 1, 'Samfundsfag B'),
(27, 1, 'Samfundsfag A'),
(28, 1, 'Idræt C'),
(29, 1, 'Idræt B'),
(30, 1, 'Idræt A'),
(31, 1, 'Teknologi C'),
(32, 1, 'Teknologi B'),
(33, 1, 'Teknologi A'),
(34, 1, 'Teknikfag (DDU) A'),
(35, 1, 'Teknikfag (cityg og hyg) A'),
(36, 1, 'Teknikfag (Process) A'),
(37, 1, 'Kommunikation og IT C'),
(38, 1, 'Kommunikation og IT B'),
(39, 1, 'Kommunikation og IT A');

-- --------------------------------------------------------

CREATE TABLE `student_class`
(
    `student_ID` INT(11) NOT NULL,
    `class_ID` INT(11) NOT NULL,

    PRIMARY KEY (`student_ID`, `class_ID`),
    FOREIGN KEY (`student_ID`) REFERENCES `users` (`uid`),
    FOREIGN KEY (`class_ID`) REFERENCES `class` (`class_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `subject_class`
(
    `subject_class_ID` INT(11) NOT NULL AUTO_INCREMENT,
    `subject_ID` INT(11) NOT NULL,
    `class_ID` INT(11) NOT NULL,  
    `subject_teacher_ID` INT(11) NOT NULL,

    PRIMARY KEY (`subject_class_ID`, `subject_ID`),
    FOREIGN KEY (`subject_ID`) REFERENCES `subject` (`subject_ID`),
    FOREIGN KEY (`class_ID`) REFERENCES `class` (`class_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -------------------------------------------------------

-- CREATE TABLE `sections` (
--     `section_ID` INT(11) NOT NULL AUTO_INCREMENT,
--     `section_name` VARCHAR(255) NOT NULL,
--     `parent_section_ID` INT(11),

--     PRIMARY KEY (`section_ID`),
--     FOREIGN KEY (`parent_section_ID`) REFERENCES `sections` (`section_ID`) ON DELETE CASCADE
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- DELIMITER //
-- CREATE TRIGGER `check_parent_section_ID_trigger` BEFORE INSERT ON `sections`
-- FOR EACH ROW
-- BEGIN
--     IF NEW.parent_section_ID = NEW.section_ID THEN
--         SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Parent section ID cannot be the same as section ID';
--     END IF;
-- END//
-- DELIMITER ;

-- ------------------------------------------------------

CREATE TABLE `subject_class_sections` (
    `section_ID` INT(11) NOT NULL AUTO_INCREMENT,
    `subject_class_ID` INT(11) NOT NULL,
    `section_name` VARCHAR(255) NOT NULL,
    `parent_section_ID` INT(11),

    PRIMARY KEY (`section_ID`),
    FOREIGN KEY (`subject_class_ID`) REFERENCES `subject_class` (`subject_class_ID`),
    FOREIGN KEY (`parent_section_ID`) REFERENCES `subject_class_sections` (`section_ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DELIMITER //
CREATE TRIGGER `check_parent_section_ID_trigger` BEFORE INSERT ON `subject_class_sections`
FOR EACH ROW
BEGIN
    IF NEW.parent_section_ID = NEW.section_ID THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Parent section ID cannot be the same as section ID';
    END IF;
END//
DELIMITER ;

-- --------------------------------------------------------

CREATE TABLE `homework`
(
    `homework_ID` INT(11) NOT NULL AUTO_INCREMENT,
    `section_ID` INT(11) NOT NULL,
    `homework_title` VARCHAR(255) NOT NULL,
    `homework_description` VARCHAR(255) NOT NULL,
    `date_created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `due_date` DATETIME NOT NULL,
    `immersion_time` INT(11),
    `comment` VARCHAR(255),
    `group_work` TINYINT(1) NOT NULL DEFAULT 0,
    `hidden` TINYINT(1) NOT NULL DEFAULT 0,
    `homework_file` VARCHAR(255),
    `assigned_by` INT(11) NOT NULL,

    PRIMARY KEY (`homework_ID`, `section_ID`),
    FOREIGN KEY (`section_ID`) REFERENCES `subject_class_sections` (`section_ID`),
    FOREIGN KEY (`assigned_by`) REFERENCES `users` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `submissions`
(
    `homework_ID` INT(11) NOT NULL,
    `student_ID` INT(11) NOT NULL,
    `submission_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `submission_file` VARCHAR(255),
    `feedback_file` VARCHAR(255),
    `comment` VARCHAR(255),
    `grade` VARCHAR(255),
    `marked_by` INT(11),
    `marked_date` DATETIME,

    PRIMARY KEY (`homework_ID`, `student_ID`),
    FOREIGN KEY (`homework_ID`) REFERENCES `homework` (`homework_ID`),
    FOREIGN KEY (`student_ID`) REFERENCES `users` (`uid`),
    FOREIGN KEY (`marked_by`) REFERENCES `users` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `groups`
(
    `group_ID` INT(11) NOT NULL AUTO_INCREMENT,
    `homework_ID` INT(11) NOT NULL,    

    PRIMARY KEY (`group_ID`, `homework_ID`),
    FOREIGN KEY (`homework_ID`) REFERENCES `homework` (`homework_ID`)    
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `students_in_group`
(
    `group_ID` INT(11) NOT NULL,
    `student_ID` INT(11) NOT NULL,

    PRIMARY KEY (`group_ID`, `student_ID`),
    FOREIGN KEY (`group_ID`) REFERENCES `groups` (`group_ID`),
    FOREIGN KEY (`student_ID`) REFERENCES `users` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `section_files`
(
    `section_ID` INT(11) NOT NULL,
    `file_name` VARCHAR(255) NOT NULL,
    `file_path` VARCHAR(255) NOT NULL,

    PRIMARY KEY (`section_ID`),
    FOREIGN KEY (`section_ID`) REFERENCES `subject_class_sections` (`section_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `schedule`
(
    `schedule_ID` INT(11) NOT NULL AUTO_INCREMENT,
    `subject_class_ID` INT(11) NOT NULL,
    `date` DATETIME NOT NULL,
    `period` INT(11) NOT NULL,
    `room` VARCHAR(255) NOT NULL,
    `note` VARCHAR(255),
    `homework` VARCHAR(255),

    PRIMARY KEY (`schedule_ID`),
    FOREIGN KEY (`subject_class_ID`) REFERENCES `subject_class` (`subject_class_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `schedule` (`schedule_ID`, `subject_class_ID`, `date`, `period`, `room`, `note`, `homework`) VALUES
(1, 1, '2024-03-12 08:10:00', 1, 'A1', 'Lektion 1', 'Lav lektierne til næste gang'),
(2, 1, '2024-03-12 09:10:00', 1, 'A1', 'Lektion 2', 'Lav lektierne til næste gang'),
(3, 1, '2024-03-12 10:20:00', 1, 'A1', 'Lektion 3', 'Lav lektierne til næste gang'),
(4, 1, '2024-03-12 11:50:00', 1, 'A1', 'Lektion 4', 'Lav lektierne til næste gang'),
(5, 1, '2024-03-12 13:00:00', 1, 'A1', 'Lektion 5', 'Lav lektierne til næste gang'),
(6, 1, '2024-03-12 14:00:00', 1, 'A1', 'Lektion 6', 'Lav lektierne til næste gang');


-- --------------------------------------------------------

CREATE TABLE `absence`
(
    `student_ID` INT(11) NOT NULL,
    `schedule_ID` INT(11) NOT NULL,
    `allowed` TINYINT(1) NOT NULL DEFAULT 0,
    `five_minutes_late` TINYINT(1) NOT NULL DEFAULT 0,

    PRIMARY KEY (`student_ID`, `schedule_ID`),
    FOREIGN KEY (`student_ID`) REFERENCES `users` (`uid`),
    FOREIGN KEY (`schedule_ID`) REFERENCES `schedule` (`schedule_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `notifications`
(
    `notification_ID` INT(11) NOT NULL AUTO_INCREMENT,
    `uid` INT(11) NOT NULL,
    `notification` VARCHAR(255) NOT NULL,
    `date_created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (`notification_ID`),
    FOREIGN KEY (`uid`) REFERENCES `users` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `messages`
(
    `message_ID` INT(11) NOT NULL AUTO_INCREMENT,
    `from_uid` INT(11) NOT NULL,
    `to_uid` INT(11) NOT NULL,
    `message` VARCHAR(255) NOT NULL,
    `date_created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (`message_ID`),
    FOREIGN KEY (`from_uid`) REFERENCES `users` (`uid`),
    FOREIGN KEY (`to_uid`) REFERENCES `users` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
CREATE TABLE `zip_codes`
(
    `zip_code` INT(11) NOT NULL,
    `city` VARCHAR(255) NOT NULL,

    PRIMARY KEY (`zip_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `school`
(
    `school_ID` INT(11) NOT NULL AUTO_INCREMENT,
    `school_name` VARCHAR(255) NOT NULL,
    `school_adress` VARCHAR(255) NOT NULL,
    `school_zip` INT(11) NOT NULL,
    `school_phone` VARCHAR(255) NOT NULL,
    `school_email` VARCHAR(255) NOT NULL,
    `school_page` VARCHAR(255) NOT NULL,

    PRIMARY KEY (`school_ID`, `school_zip`),
    FOREIGN KEY (`school_zip`) REFERENCES `zip_codes` (`zip_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `user_type`
(
    `user_type_ID` INT(11) NOT NULL AUTO_INCREMENT,
    `name`   VARCHAR(255) NOT NULL,
    `permissions` text NOT NULL,

    PRIMARY KEY (`user_type_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `users`
(
    `uid` INT(11) NOT NULL AUTO_INCREMENT,
    `user_type_ID` INT(11) NOT NULL,
    `school_ID` INT(11) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `initials` VARCHAR(255) NOT NULL DEFAULT '',
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `date_created` DATE NOT NULL,
    `written_absence` INT(11) NOT NULL DEFAULT 0,
    
    PRIMARY KEY (`uid`, `user_type_ID`, `school_ID`),
    FOREIGN KEY (`user_type_ID`) REFERENCES `user_type` (`user_type_ID`),
    FOREIGN KEY (`school_ID`) REFERENCES `school` (`school_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `student_class`
(
    `student_ID` INT(11) NOT NULL,
    `class_ID` INT(11) NOT NULL,

    PRIMARY KEY (`student_ID`, `class_ID`),
    FOREIGN KEY (`student_ID`) REFERENCES `users` (`uid`),
    FOREIGN KEY (`class_ID`) REFERENCES `class` (`class_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `subject`
(
    `subject_ID` INT(11) NOT NULL AUTO_INCREMENT,
    `school_ID` INT(11) NOT NULL,
    `subject_name` VARCHAR(255) NOT NULL,
    `subject_color` VARCHAR(255) NOT NULL DEFAULT '#0e9ecef',

    PRIMARY KEY (`subject_ID`, `school_ID`),
    FOREIGN KEY (`school_ID`) REFERENCES `school` (`school_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `subject_class`
(
    `subject_class_ID` INT(11) NOT NULL AUTO_INCREMENT,
    `subject_ID` INT(11) NOT NULL,
    `class_ID` INT(11) NOT NULL,  
    `subject_teacher_ID` INT(11) NOT NULL,

    PRIMARY KEY (`subject_class_ID`, `subject_ID`, `class_ID`),
    FOREIGN KEY (`subject_ID`) REFERENCES `subject` (`subject_ID`),
    FOREIGN KEY (`class_ID`) REFERENCES `class` (`class_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -------------------------------------------------------

CREATE TABLE `subject_class_sections` (
    `section_ID` INT(11) NOT NULL AUTO_INCREMENT,
    `subject_class_ID` INT(11) NOT NULL,
    `section_name` VARCHAR(255) NOT NULL,
    `section_description` TEXT DEFAULT '',
    `parent_section_ID` INT(11),

    PRIMARY KEY (`section_ID`),
    FOREIGN KEY (`subject_class_ID`) REFERENCES `subject_class` (`subject_class_ID`),
    FOREIGN KEY (`parent_section_ID`) REFERENCES `subject_class_sections` (`section_ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

DELIMITER //
CREATE TRIGGER `check_parent_section_ID_trigger` BEFORE INSERT ON `subject_class_sections`
FOR EACH ROW
BEGIN
    IF NEW.parent_section_ID = NEW.section_ID THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Parent section ID cannot be the same as section ID';
    END IF;
END//

CREATE TRIGGER `create_section_on_new_subject` AFTER INSERT ON `subject_class`
FOR EACH ROW
BEGIN
    INSERT INTO `subject_class_sections` (`subject_class_ID`, `section_name`) VALUES (NEW.subject_class_ID, (SELECT `subject_name` FROM `subject` WHERE `subject_ID` = NEW.subject_ID));
END//

CREATE TRIGGER `delete_section_on_deleted_subject` AFTER DELETE ON `subject_class`
FOR EACH ROW
BEGIN
    DELETE FROM `subject_class_sections` WHERE `subject_class_ID` = OLD.subject_class_ID;
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
    `date_unlocked` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `due_date` DATETIME NOT NULL,
    `immersion_time` INT(11),
    `group_work` TINYINT(1) NOT NULL DEFAULT 0,
    `hidden` TINYINT(1) NOT NULL DEFAULT 0,
    `assigned_by` INT(11) NOT NULL,
    `important` TINYINT(1) NOT NULL DEFAULT 0,

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
    `submission_text` TEXT,
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
    `group_name` VARCHAR(255) NOT NULL,

    PRIMARY KEY (`group_ID`, `homework_ID`),
    FOREIGN KEY (`homework_ID`) REFERENCES `homework` (`homework_ID`)    
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `group_students`
(
    `group_ID` INT(11) NOT NULL,
    `student_ID` INT(11) NOT NULL,

    PRIMARY KEY (`group_ID`, `student_ID`),
    FOREIGN KEY (`group_ID`) REFERENCES `groups` (`group_ID`),
    FOREIGN KEY (`student_ID`) REFERENCES `users` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `file_types`
(
    `file_type_ID` INT(11) NOT NULL AUTO_INCREMENT,
    `file_type` VARCHAR(255) NOT NULL,
    `extension` VARCHAR(255) NOT NULL,

    PRIMARY KEY (`file_type_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `section_files`
(
    `section_file_ID` INT(11) NOT NULL AUTO_INCREMENT,
    `section_ID` INT(11) NOT NULL,
    `file_type_ID` INT(11) NOT NULL,
    `file_name` VARCHAR(255) NOT NULL,
    `date_created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (`section_file_ID`, `file_name`),
    FOREIGN KEY (`section_ID`) REFERENCES `subject_class_sections` (`section_ID`),
    FOREIGN KEY (`file_type_ID`) REFERENCES `file_types` (`file_type_ID`)
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

-- CREATE TABLE `notifications`
-- (
--     `notification_ID` INT(11) NOT NULL AUTO_INCREMENT,
--     `uid` INT(11) NOT NULL,
--     `notification` VARCHAR(255) NOT NULL,
--     `date_created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

--     PRIMARY KEY (`notification_ID`),
--     FOREIGN KEY (`uid`) REFERENCES `users` (`uid`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `messages`
(
    `message_ID` INT(11) NOT NULL AUTO_INCREMENT,
    `from_uid` INT(11) NOT NULL,
    `subject` VARCHAR(255) NOT NULL,
    `message` VARCHAR(255) NOT NULL,
    `date_created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (`message_ID`),
    FOREIGN KEY (`from_uid`) REFERENCES `users` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `message_to_users`
(
    `message_ID` INT(11) NOT NULL,
    `to_uid` INT(11) NOT NULL,
    `user_read` TINYINT(1) NOT NULL DEFAULT 0,

    PRIMARY KEY (`message_ID`, `to_uid`),
    FOREIGN KEY (`message_ID`) REFERENCES `messages` (`message_ID`),
    FOREIGN KEY (`to_uid`) REFERENCES `users` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `message_reply`
(
    `message_ID` INT(11) NOT NULL,
    `from_uid` INT(11) NOT NULL,
    `message` VARCHAR(255) NOT NULL,
    `date_created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (`message_ID`, `from_uid`, `date_created`),
    FOREIGN KEY (`message_ID`) REFERENCES `messages` (`message_ID`),
    FOREIGN KEY (`from_uid`) REFERENCES `users` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

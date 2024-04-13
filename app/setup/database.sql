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

INSERT INTO `users` (`uid`, `user_type_ID`, `school_ID`, `name`, `initials`, `email`, `password`, `date_created`) VALUES
(1, 1, 1, 'Gunnar Máni Jóhannsson', 'GMJ', 'gunnarmani@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(2, 2, 1, 'Torsten Skov Fix', 'thfi', 'torstenskov@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(3, 2, 1, 'Lars Larsen', 'LL', 'larslarsen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21'),
(4, 1, 1, 'Mads Madsen', 'MM', 'madsmadsen@mail.hansenberg.dk', '$2y$10$61NSo7BizpcDsMOn5lfWeezE9nvAgGpf3JpSYLLaxJtMF9h42jCAG', '2024-02-21');

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

INSERT INTO `class` (`class_ID`, `school_ID`, `class_name`, `class_teacher_ID`) VALUES
(1, 1, '3UV', 2);

-- --------------------------------------------------------

CREATE TABLE `student_class`
(
    `student_ID` INT(11) NOT NULL,
    `class_ID` INT(11) NOT NULL,

    PRIMARY KEY (`student_ID`, `class_ID`),
    FOREIGN KEY (`student_ID`) REFERENCES `users` (`uid`),
    FOREIGN KEY (`class_ID`) REFERENCES `class` (`class_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `student_class` (`student_ID`, `class_ID`) VALUES
(1, 1),
(2, 1);

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

INSERT INTO `subject` (`subject_ID`, `school_ID`, `subject_name`, `subject_color`) VALUES
(1, 1, 'Matematik C', '#FFE3C9'), -- Light orange
(2, 1, 'Matematik B', '#FFE3C9'), -- Light orange
(3, 1, 'Matematik A', '#FFE3C9'), -- Light orange
(4, 1, 'Dansk C', '#CCFFF6'), -- Light blue
(5, 1, 'Dansk B', '#CCFFF6'), -- Light blue
(6, 1, 'Dansk A', '#CCFFF6'), -- Light blue
(7, 1, 'Engelsk C', '#C8FFCD'), -- Light green
(8, 1, 'Engelsk B', '#C8FFCD'), -- Light green
(9, 1, 'Engelsk A', '#C8FFCD'), -- Light green
(10, 1, 'Idehistorie C', '#FFD9CC'), -- Light peach
(11, 1, 'Idehistorie B', '#F6CCFF'), -- Light purple
(12, 1, 'Idehistorie A', '#E3C9FF'), -- Light lavender
(13, 1, 'Programmering C', '#CDFFEC'), -- Light mint
(14, 1, 'Programmering B', '#CDFFEC'), -- Light mint
(15, 1, 'Programmering A', '#CDFFEC'), -- Light mint
(16, 1, 'Fysik C', '#FFD9E3'), -- Light rose
(17, 1, 'Fysik B', '#FFD9E3'), -- Light rose
(18, 1, 'Fysik A', '#FFD9E3'), -- Light rose
(19, 1, 'Kemi C', '#CDF6FF'), -- Light cyan
(20, 1, 'Kemi B', '#CDF6FF'), -- Light cyan
(21, 1, 'Kemi A', '#CDF6FF'), -- Light cyan
(22, 1, 'Biologi C', '#ECFFD9'), -- Light lime
(23, 1, 'Biologi B', '#ECFFD9'), -- Light lime
(24, 1, 'Biologi A', '#ECFFD9'), -- Light lime
(25, 1, 'Samfundsfag C', '#FFE3C9'), -- Light orange
(26, 1, 'Samfundsfag B', '#FFE3C9'), -- Light orange
(27, 1, 'Samfundsfag A', '#FFE3C9'), -- Light orange
(28, 1, 'Idræt C', '#CCFFF6'), -- Light blue
(29, 1, 'Idræt B', '#CCFFF6'), -- Light blue
(30, 1, 'Idræt A', '#CCFFF6'), -- Light blue
(31, 1, 'Teknologi C', '#C8FFCD'), -- Light green
(32, 1, 'Teknologi B', '#C8FFCD'), -- Light green
(33, 1, 'Teknologi A', '#C8FFCD'), -- Light green
(34, 1, 'Teknikfag (DDU) A', '#FFD9CC'), -- Light peach
(35, 1, 'Teknikfag (byg og hyg) A', '#FFD9CC'), -- Light peach
(36, 1, 'Teknikfag (Process) A', '#FFD9CC'), -- Light peach
(37, 1, 'Kommunikation og IT C', '#F6CCFF'), -- Light purple
(38, 1, 'Kommunikation og IT B', '#F6CCFF'), -- Light purple
(39, 1, 'Kommunikation og IT A', '#F6CCFF'), -- Light purple
(40, 1, 'Geografi C', '#E3C9FF'), -- Light lavender
(41, 1, 'Historie C', '#E3C9FF'), -- Light lavender
(42, 1, 'Psykologi B', '#E3C9FF'); -- Light lavender

INSERT INTO `subject_class` (`subject_class_ID`, `subject_ID`, `class_ID`, `subject_teacher_ID`) VALUES
(1, 1, 1, 2),
(2, 2, 1, 2),
(3, 3, 1, 2),
(4, 4, 1, 2),
(5, 5, 1, 2),
(6, 6, 1, 2),
(7, 7, 1, 2),
(8, 8, 1, 2),
(9, 9, 1, 2),
(10, 10, 1, 2),
(11, 11, 1, 2),
(12, 12, 1, 2),
(13, 13, 1, 2),
(14, 14, 1, 2),
(15, 15, 1, 2),
(16, 16, 1, 2),
(17, 17, 1, 2),
(18, 18, 1, 2),
(19, 19, 1, 2),
(20, 20, 1, 2),
(21, 21, 1, 2),
(22, 22, 1, 2),
(23, 23, 1, 2),
(24, 24, 1, 2),
(25, 25, 1, 2),
(26, 26, 1, 2),
(27, 27, 1, 2),
(28, 28, 1, 2),
(29, 29, 1, 2),
(30, 30, 1, 2),
(31, 31, 1, 2),
(32, 32, 1, 2),
(33, 33, 1, 2),
(34, 34, 1, 2),
(35, 35, 1, 2),
(36, 36, 1, 2),
(37, 37, 1, 2),
(38, 38, 1, 2),
(39, 39, 1, 2);

INSERT INTO `subject_class_sections` (`section_ID`, `subject_class_ID`, `section_name`, `section_description`, `parent_section_ID`) VALUES
(40, 6, '2. UNGE I DAGENS MEDIEBILLEDE (SERIEANALYSE)', 'Vores brug af sproget kan variere på utroligt mange måder og med lige så mange forskellige betydninger til følge. I valg af enkelte ord kan du vælge at udtrykke dig med idiomer, metaforer, låneord, dialekt og meget andet og i konstruktionen af sætninger kan du gå fra det helt korte til sætninger på mange linjer. Effekterne kan være alt fra, at du giver dit sprog mere liv, til at du virker cool eller gør, at din modtager bedre forstår, hvad du siger. I dette forløb skal vi udforske forskellige måder at variere sproget på i alt fra stand up-shows og satire til holdningskampagner, sangtekster og romanuddrag.', 6);

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
    `important` TINYINT(1) NOT NULL DEFAULT 0,

    PRIMARY KEY (`homework_ID`, `section_ID`),
    FOREIGN KEY (`section_ID`) REFERENCES `subject_class_sections` (`section_ID`),
    FOREIGN KEY (`assigned_by`) REFERENCES `users` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `homework` (`homework_ID`, `section_ID`, `homework_title`, `homework_description`, `due_date`, `immersion_time`, `assigned_by`, `important`) VALUES
(1, 1, 'Lektie 1', 'Lav opgaverne 1-5', '2024-03-12 08:00:00', 60, 2, 1),
(2, 1, 'Lektie 2', 'Lav opgaverne 6-10', '2024-03-12 08:00:00', 60, 2, 0),
(3, 1, 'Lektie 3', 'Lav opgaverne 11-15', '2024-03-12 08:00:00', 60, 2, 1),
(4, 1, 'Lektie 4', 'Lav opgaverne 16-20', '2024-03-12 08:00:00', 60, 2, 0),
(5, 1, 'Lektie 5', 'Lav opgaverne 21-25', '2024-03-12 08:00:00', 60, 2, 1),
(6, 1, 'Lektie 6', 'Lav opgaverne 26-30', '2024-03-12 08:00:00', 60, 2, 0);

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

CREATE TABLE `file_types`
(
    `file_type_ID` INT(11) NOT NULL AUTO_INCREMENT,
    `file_type` VARCHAR(255) NOT NULL,

    PRIMARY KEY (`file_type_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `file_types` (`file_type_ID`, `file_type`) VALUES
(1, 'PDF'),
(2, 'Word'),
(3, 'Excel'),
(4, 'PowerPoint'),
(5, 'Text'),
(6, 'Link'),
(7, 'Zip'),
(8, 'Image'),
(9, 'Video'),
(10, 'Audio'),
(11, 'Other');

-- --------------------------------------------------------

CREATE TABLE `section_files`
(
    `section_ID` INT(11) NOT NULL,
    `file_type_ID` INT(11) NOT NULL,
    `file_name` VARCHAR(255) NOT NULL,

    PRIMARY KEY (`section_ID`),
    FOREIGN KEY (`section_ID`) REFERENCES `subject_class_sections` (`section_ID`),
    FOREIGN KEY (`file_type_ID`) REFERENCES `file_types` (`file_type_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `section_files` (`section_ID`, `file_type_ID`, `file_name`) VALUES
(40, 1, 'Analyse');
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
    `subject` VARCHAR(255) NOT NULL,
    `message` VARCHAR(255) NOT NULL,
    `date_created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (`message_ID`),
    FOREIGN KEY (`from_uid`) REFERENCES `users` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `messages` (`message_ID`, `from_uid`, `subject`, `message`) VALUES
(1, 1, 'Hej Torsten', 'Jeg har et spørgsmål til lektie 1'),
(2, 2, 'Vigtig besked', 'Husk at aflevere lektie 2 inden fredag.'),
(3, 3, 'Godmorgen!', 'Håber du får en god dag!'),
(4, 4, 'Afsked', 'Vi ses i morgen!');

-- --------------------------------------------------------

CREATE TABLE `message_to_users`
(
    `message_ID` INT(11) NOT NULL,
    `to_uid` INT(11) NOT NULL,

    PRIMARY KEY (`message_ID`, `to_uid`),
    FOREIGN KEY (`message_ID`) REFERENCES `messages` (`message_ID`),
    FOREIGN KEY (`to_uid`) REFERENCES `users` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `message_to_users` (`message_ID`, `to_uid`) VALUES
(1, 2),
(2, 1),
(3, 1),
(4, 1);

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

INSERT INTO `message_reply` (`message_ID`, `from_uid`, `message`) VALUES
(1, 2, 'Hej Gunnar, hvad er dit spørgsmål?'),
(1, 1, 'Knækkestof');
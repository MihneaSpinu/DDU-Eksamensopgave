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

CREATE TABLE `bruger_type`
(
    `bruger_type_ID` INT(11) NOT NULL AUTO_INCREMENT,
    `type`   VARCHAR(50) NOT NULL,

    PRIMARY KEY (`bruger_type_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `bruger_type` (`bruger_type_ID`, `type`) VALUES
(1, 'elev'),
(2, 'lærer'),
(3, 'censor'),
(4, 'admin');

-- --------------------------------------------------------

CREATE TABLE `brugere`
(
    `bruger_ID` INT(11) NOT NULL AUTO_INCREMENT,
    `bruger_type_ID` INT(11) NOT NULL,
    `fornavn` VARCHAR(50) NOT NULL,
    `efternavn` VARCHAR(50) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    `password` VARCHAR(50) NOT NULL,
    `oprettelsesdato` DATE NOT NULL,
    
    PRIMARY KEY (`bruger_ID`),
    FOREIGN KEY (`bruger_type_ID`) REFERENCES `bruger_type` (`bruger_type_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `klasse`
(
    `klasse_ID` INT(11) NOT NULL AUTO_INCREMENT,
    `klasse_navn` VARCHAR(50) NOT NULL,
    `klasselærer_ID` INT(11) NOT NULL,

    PRIMARY KEY (`klasse_ID`),
    FOREIGN KEY (`klasselærer_ID`) REFERENCES `brugere` (`bruger_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- INSERT INTO `klasse` (`klasse_ID`, `klasse_navn`, `klasselærer_ID`) VALUES
-- (1, '1.U', '1'),
-- (2, '2.U', '1'),
-- (3, '3.U', '1'),
-- (4, '1.X', '2'),
-- (5, '2.X', '2'),
-- (6, '3.X', '2'),
-- (7, '1.Y', '3'),
-- (8, '2.Y', '3'),
-- (9, '3.Y', '3'),
-- (10, '1.Z', '4'),
-- (11, '2.Z', '4'),
-- (12, '3.Z', '4');

-- --------------------------------------------------------

CREATE TABLE `fag`
(
    `fag_ID` INT(11) NOT NULL AUTO_INCREMENT,
    `fag_navn` VARCHAR(50) NOT NULL,
    `fag_lærer_ID` INT(11) NOT NULL,

    PRIMARY KEY (`fag_ID`),
    FOREIGN KEY (`fag_lærer_ID`) REFERENCES `brugere` (`bruger_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Matematik, dansk, engelsk, idehistorie, programmering, fysik, kemi, biologi, samfundsfag, idræt, teknologi, teknikfag A (DDU, Byg og hyg, process), Komm. IT. Lav 3 af hver fag med C B A niveau, undtagen teknikfag A.


-- --------------------------------------------------------

CREATE TABLE `elev_klasse`
(
    `elev_ID` INT(11) NOT NULL,
    `klasse_ID` INT(11) NOT NULL,

    PRIMARY KEY (`elev_ID`, `klasse_ID`),
    FOREIGN KEY (`elev_ID`) REFERENCES `brugere` (`bruger_ID`),
    FOREIGN KEY (`klasse_ID`) REFERENCES `klasse` (`klasse_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `fag_klasse`
(
    `fag_klasse_ID` INT(11) NOT NULL AUTO_INCREMENT,
    `fag_ID` INT(11) NOT NULL,
    `klasse_ID` INT(11) NOT NULL,

    PRIMARY KEY (`fag_klasse_ID`),
    FOREIGN KEY (`fag_ID`) REFERENCES `fag` (`fag_ID`),
    FOREIGN KEY (`klasse_ID`) REFERENCES `klasse` (`klasse_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- -------------------------------------------------------

CREATE TABLE `emner` (
    `emne_ID` INT(11) NOT NULL AUTO_INCREMENT,
    `emne_navn` VARCHAR(50) NOT NULL,
    `parent_emne_ID` INT(11),

    PRIMARY KEY (`emne_ID`),
    FOREIGN KEY (`parent_emne_ID`) REFERENCES `emner` (`emne_ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ------------------------------------------------------

CREATE TABLE `fag_klasse_emner` (
    `fag_klasse_ID` INT(11) NOT NULL,
    `emne_ID` INT(11) NOT NULL,

    PRIMARY KEY (`fag_klasse_ID`, `emne_ID`),
    FOREIGN KEY (`fag_klasse_ID`) REFERENCES `fag_klasse` (`fag_klasse_ID`),
    FOREIGN KEY (`emne_ID`) REFERENCES `emner` (`emne_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `lektier`
(
    `lektie_ID` INT(11) NOT NULL AUTO_INCREMENT,
    `fag_ID` INT(11) NOT NULL,
    `klasse_ID` INT(11) NOT NULL,
    `lektie_titel` VARCHAR(50) NOT NULL,
    `lektie_beskrivelse` VARCHAR(50) NOT NULL,
    `lektie_dato` DATE NOT NULL,
    `gruppe_arbejde` TINYINT(1) NOT NULL DEFAULT 0,
    `usynlig` TINYINT(1) NOT NULL DEFAULT 0,

    PRIMARY KEY (`lektie_ID`),
    FOREIGN KEY (`fag_ID`) REFERENCES `fag` (`fag_ID`),
    FOREIGN KEY (`klasse_ID`) REFERENCES `klasse` (`klasse_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `afleveringer`
(
    `aflevering_ID` INT(11) NOT NULL AUTO_INCREMENT,
    `lektie_ID` INT(11) NOT NULL,
    `elev_ID` INT(11) NOT NULL,
    `aflevering_dato` DATE NOT NULL,
    `aflevering_fil` VARCHAR(50) NOT NULL,

    PRIMARY KEY (`aflevering_ID`),
    FOREIGN KEY (`lektie_ID`) REFERENCES `lektier` (`lektie_ID`),
    FOREIGN KEY (`elev_ID`) REFERENCES `brugere` (`bruger_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `grupper`
(
    `gruppe_ID` INT(11) NOT NULL AUTO_INCREMENT,
    `lektie_ID` INT(11) NOT NULL,    

    PRIMARY KEY (`gruppe_ID`),
    FOREIGN KEY (`lektie_ID`) REFERENCES `lektier` (`lektie_ID`)    
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

CREATE TABLE `elever_i_gruppe`
(
    `gruppe_ID` INT(11) NOT NULL,
    `elev_ID` INT(11) NOT NULL,

    PRIMARY KEY (`gruppe_ID`, `elev_ID`),
    FOREIGN KEY (`gruppe_ID`) REFERENCES `grupper` (`gruppe_ID`),
    FOREIGN KEY (`elev_ID`) REFERENCES `brugere` (`bruger_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

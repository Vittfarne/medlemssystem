-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2014 at 12:47 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `medlemssystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `joined` datetime NOT NULL,
  `group` int(11) NOT NULL DEFAULT '1',
  `active` int(11) NOT NULL DEFAULT '0',
  `activationcode` varchar(55) NOT NULL,
  `activeyear` datetime NOT NULL,
  `activeuntil` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `salt`, `name`, `phone`, `joined`, `group`, `active`, `activationcode`, `activeyear`, `activeuntil`) VALUES
(1, 'user', 'email@email.com', '76bf68975efe31e706fcafb464ff50a18f37f8e605da09ca0b4a7aa32581b548', 'ÉGmæùx;½-8¾h-¿/Gî¯§¶æ}mpåþO', 'name', '0123456789', '2014-05-22 14:39:12', 2, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, '11ss', 'asss@lol.com', '566d1d3755a4f0aad1ad7be0d95d7aa028bbc52f9468682afb1e6c9ecfe1e58d', 'ÌÊ÷Ä	aÛ=jêík3Iê[Ò|PT‹¶ûiÄª–û Yw', 'Name', '1231231232', '2014-05-22 23:15:45', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'user3', 'password@email.com', 'd0dfd22ecf63638523062e1723c2405d70b6c40527b0ce85dc9c4fd3bf733f72', '§I†¹MÃ0÷NKàAk<Ô²ô„~¹¡ŸM·SÞ¦¾', 'Name', '0123145125', '2014-05-22 23:23:15', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

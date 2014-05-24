SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;



CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `permissions` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;


INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(1, 'User', ''),
(2, 'Administrator', '{\r\n "admin": 1,\r\n "moderator": 1\r\n}');


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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;


INSERT INTO `users` (`id`, `username`, `email`, `password`, `salt`, `name`, `phone`, `joined`, `group`) VALUES
(1, 'user', 'email@email.com', '76bf68975efe31e706fcafb464ff50a18f37f8e605da09ca0b4a7aa32581b548', 'ÉGmæùx;½-8¾h-¿/Gî¯§¶æ}mpåþO', 'name', '0123456789', '2014-05-22 14:39:12', 2),
(2, '11ss', 'asss@lol.com', '566d1d3755a4f0aad1ad7be0d95d7aa028bbc52f9468682afb1e6c9ecfe1e58d', 'ÌÊ÷Ä	aÛ=jêík3Iê[Ò|PT‹¶ûiÄª–û Yw', 'Name', '1231231232', '2014-05-22 23:15:45', 1),
(3, 'user3', 'password@email.com', 'd0dfd22ecf63638523062e1723c2405d70b6c40527b0ce85dc9c4fd3bf733f72', '§I†¹MÃ0÷NKàAk<Ô²ô„~¹¡ŸM·SÞ¦¾', 'Name', '0123145125', '2014-05-22 23:23:15', 1);


CREATE TABLE IF NOT EXISTS `users_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;



INSERT INTO `users_session` (`id`, `user_id`, `hash`) VALUES
(3, 1, 'fba3e95483add74d35552fca3e356e1c6ee7a676bff0962d21430f98fe6ffcea');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2015 alle 13:00
-- Versione del server: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tweb`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `amicizie`
--

CREATE TABLE IF NOT EXISTS `amicizie` (
  `id_a` int(11) NOT NULL AUTO_INCREMENT,
  `user1` varchar(100) NOT NULL,
  `user2` varchar(100) NOT NULL,
  `stato` int(11) NOT NULL,
  PRIMARY KEY (`id_a`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dump dei dati per la tabella `amicizie`
--

INSERT INTO `amicizie` (`id_a`, `user1`, `user2`, `stato`) VALUES
(1, 'felix', 'emanuela', 1),
(2, 'felix', 'marina', 1),
(3, 'antonio', 'felix', 1),
(10, 'riccardo', 'felix', -1),
(11, 'marina', 'emanuela', 1),
(18, 'felix', 'baglio', 1),
(15, 'marina', 'riccardo', 1),
(17, 'baglio', 'marina', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `messaggi_stato`
--

CREATE TABLE IF NOT EXISTS `messaggi_stato` (
  `id_notizia` int(11) NOT NULL AUTO_INCREMENT,
  `notizia` varchar(150) NOT NULL,
  `username` varchar(50) NOT NULL,
  `data` varchar(50) NOT NULL,
  `visibile` int(11) NOT NULL DEFAULT '1',
  `likeC` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_notizia`),
  KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dump dei dati per la tabella `messaggi_stato`
--

INSERT INTO `messaggi_stato` (`id_notizia`, `notizia`, `username`, `data`, `visibile`, `likeC`) VALUES
(0, 'Buongiorno!!!!', 'marina', '2014-10-22 21:50:46', 1, 3),
(1, 'Oggi Ã¨ proprio una bella giornata!', 'felix', '2014-12-15 22:01:48', 1, 3),
(2, 'Domani Ã¨ Natale', 'emanuela', '2014-12-22 11:50:10', 1, 1),
(3, 'Ciaoooooo', 'antonio', '2014-12-23 12:02:36', 1, 2),
(4, 'Sono superstrepitoso!!!!', 'riccardo', '2014-12-23 15:13:41', 1, 4),
(5, 'Lavorando alla grande....', 'felix', '2015-01-29 20:46:43', 0, 5),
(6, 'Bella', 'felix', '2015-02-10 12:25:32', 1, 11),
(9, 'Questo Ã¨ il mio primo post!', 'gertrude', '2015-02-12 11:23:08', 0, 0),
(14, 'Salve!!!', 'emanuela', '2015-02-15 17:02:11', 1, 1),
(10, 'Weeeeeeee', 'riccardo', '2015-02-13 13:15:02', 0, 0),
(11, 'wssss', 'riccardo', '2015-02-13 13:19:42', 0, 0),
(12, 'fffffff', 'riccardo', '2015-02-13 13:20:07', 0, 0),
(13, 'Social molto social', 'brambila', '2015-02-14 15:09:31', 0, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `social_network`
--

CREATE TABLE IF NOT EXISTS `social_network` (
  `id_sn` int(11) NOT NULL AUTO_INCREMENT,
  `id_notizia` int(11) NOT NULL,
  `commenti` varchar(150) NOT NULL,
  `autore` varchar(50) NOT NULL,
  `visibile` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_sn`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=126 ;

--
-- Dump dei dati per la tabella `social_network`
--

INSERT INTO `social_network` (`id_sn`, `id_notizia`, `commenti`, `autore`, `visibile`) VALUES
(116, 3, 'Ciao anche a te.', 'felix', 1),
(117, 1, 'Fantastico!', 'felix', 1),
(118, 2, 'Ormai siamo a febbraio.', 'felix', 1),
(119, 6, 'Weeee', 'felix', 1),
(120, 6, 'Ola', 'emanuela', 1),
(93, 0, 'weiiiii', 'emanuela', 0),
(88, 0, 'anche a me!!!', 'felix', 1),
(113, 4, 'Non Ã¨ vero', 'felix', 1),
(110, 3, 'Ciao!', 'antonio', 0),
(114, 3, 'Ciaoooo', 'emanuela', 0),
(115, 1, 'Mi piace!!', 'emanuela', 1),
(107, 1, 'Anche qui a Torino il sole splende.', 'marina', 1),
(112, 0, 'Hey Riccardo :X:X', 'emanuela', 0),
(111, 2, 'haha', 'emanuela', 1),
(109, 0, 'Buongiorno', 'riccardo', 1),
(108, 2, 'Benissimo!', 'marina', 1),
(122, 6, 'Hey', 'gertrude', 0),
(123, 5, 'Su cosa??', 'brambila', 0),
(124, 13, 'Vero?', 'admin', 0),
(125, 13, 'Fidati che funziona', 'admin', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `social_network_like`
--

CREATE TABLE IF NOT EXISTS `social_network_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_notizia` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `likeC` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_index` (`id_notizia`,`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dump dei dati per la tabella `social_network_like`
--

INSERT INTO `social_network_like` (`id`, `id_notizia`, `username`, `likeC`) VALUES
(13, 5, 'felix', 1),
(12, 6, 'felix', -1),
(14, 3, 'felix', 1),
(15, 1, 'felix', 1),
(16, 2, 'felix', 1),
(17, 0, 'felix', 1),
(18, 4, 'riccardo', 1),
(19, 0, 'riccardo', 1),
(20, 6, 'admin', -1),
(21, 5, 'brambila', 1),
(22, 1, 'brambila', 1),
(23, 13, 'brambila', 1),
(24, 4, 'admin', 1),
(25, 1, 'admin', 1),
(26, 13, 'felix', 1),
(27, 0, 'baglio', 1),
(28, 13, 'admin', 1),
(29, 3, 'admin', 1),
(30, 6, 'marina ', -1),
(31, 4, 'marina ', 1),
(32, 14, 'emanuela', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nome_completo` varchar(50) NOT NULL,
  `messaggio` varchar(150) NOT NULL,
  `url` varchar(50) NOT NULL,
  `immagine` varchar(50) NOT NULL,
  `immagine_grande` varchar(150) NOT NULL,
  `indirizzo` varchar(50) NOT NULL,
  `luogo_nascita` varchar(50) NOT NULL,
  `professione` varchar(50) NOT NULL,
  `lavora_a` varchar(50) NOT NULL,
  `situazione_sentimentale` varchar(50) NOT NULL,
  `seguito` varchar(50) NOT NULL,
  `film` varchar(50) NOT NULL,
  `descrizione` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nome_completo`, `messaggio`, `url`, `immagine`, `immagine_grande`, `indirizzo`, `luogo_nascita`, `professione`, `lavora_a`, `situazione_sentimentale`, `seguito`, `film`, `descrizione`) VALUES
(1, 'felix', 'felix', 'Felix Paul', 'Oh nana Lalala', 'index.php', 'felix_foto_piccola.jpg', 'felix.jpg', 'Milano', 'Pascani, il 22/06/1992', 'uniTo, Dipartimento Informatica', 'TBR Soft', 'Error 404', '150 persone', 'Alluda Majaka', 'A volte dorme di piÃ¹ lo sveglio che il dormiente'),
(7, 'admin', 'admin', 'Admin & Moderatore', 'Modifica il tuo primo messaggio di stato!', '', 'default_piccola.jpg', 'default.jpg', 'Torino', '30/02/1993', 'Moderatore', 'In generale bene', 'Aperta', '0 persone', 'Tre uomini e una gamba', 'Scrivere Ã¨ umano, ma moderare Ã¨ divino!'),
(2, 'emanuela', 'emanuela', 'Emanuela Pezzo', 'Salve!!!', 'emanuela.php', 'ema_foto_piccola.jpg', 'ema_foto.jpg', 'Torino', 'Milano, il 05/06/1992', 'UniTo, Dipartimento Informatica', 'HandM', 'Difficile', '500 persone', 'Frozen', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rhoncus nisi metus, id sagittis purus cursus vitae. Morbi sit amet nibh a magna fermentum facilisis non eget turpis. Ut dignissim nulla lacus, a tristique sapien pellentesque in. Fusce purus urna, posuere ac massa vitae, vestibulum vestibulum diam. Quisque eros dolor, pulvinar non viverra quis, semper ut ligula. Quisque eu dui ante. Maecenas rutrum, nisi vitae scelerisque auctor, turpis elit ullamcorper nulla, nec aliquam lorem massa quis felis. Cras quis purus urna. Fusce eget dui dictum, tempor ipsum vitae, semper urna. Pellentesque lacinia et ipsum eu porta. In cursus justo aliquam tellus malesuada porttitor. Nullam auctor aliquam ultrices. Aliquam bibendum sagittis velit sit amet venenatis. Etiam scelerisque ante eget tortor lobortis scelerisque. Praesent tempus et enim sed commodo. Duis id gravida eros. Fusce vitae risus vitae lorem auctor scelerisque. Class aptent taciti sociosqu ad litora torquent per conubia nostr'),
(15, 'michele', 'michele', 'Michele Melluso', 'Modifica il tuo primo messaggio di stato!', '', 'default_piccola.jpg', 'default.jpg', 'Indirizzo non inserito', 'Luogo di nascita non inserito', 'Professione non inserita', 'Sconosciuto', 'Sconosciuto', '0 persone', 'Nessuna preferenza', 'Cambia la descrizione per farti conoscere meglio!'),
(3, 'antonio', 'antonio', 'Antonio Rava', 'Ciaoooooo', 'antonio.php', 'antonio_foto_piccola.jpg', 'antonio_foto.jpg', 'Rivarolo', 'Rivarolo, il 12/08/1993', 'UniTo, Dipartimento Informatica', 'TBR Soft', 'Single', '75 persone', 'Tartarughe Ninja', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rhoncus nisi metus, id sagittis purus cursus vitae. Morbi sit amet nibh a magna fermentum facilisis non eget turpis. Ut dignissim nulla lacus, a tristique sapien pellentesque in. Fusce purus urna, posuere ac massa vitae, vestibulum vestibulum diam. Quisque eros dolor, pulvinar non viverra quis, semper ut ligula. Quisque eu dui ante. Maecenas rutrum, nisi vitae scelerisque auctor, turpis elit ullamcorper nulla, nec aliquam lorem massa quis felis. Cras quis purus urna. Fusce eget dui dictum, tempor ipsum vitae, semper urna. Pellentesque lacinia et ipsum eu porta. In cursus justo aliquam tellus malesuada porttitor. Nullam auctor aliquam ultrices. Aliquam bibendum sagittis velit sit amet venenatis. Etiam scelerisque ante eget tortor lobortis scelerisque. Praesent tempus et enim sed commodo. Duis id gravida eros. Fusce vitae risus vitae lorem auctor scelerisque. Class aptent taciti sociosqu ad litora torquent per conubia nostr'),
(4, 'marina', 'marina', 'Marina Rossi', 'Bellaaaaaaaaa', 'marina.php', 'marina_foto_piccola.jpg', 'marina_foto.jpg', 'Torino', 'Torino, il 29/07/1993', 'UniTo, Dipartimento Informatica', 'Joy', 'Fidanzata', '9000 persone', 'Aldo Giovanni e Giacomo', 'Ut dignissim dolor sit amet, consectetur adipiscing elit. Quisque rhoncus nisi metus, id sagittis purus cursus vitae. Morbi sit amet nibh a magna fermentum facilisis non eget turpis. Ut dignissim nulla lacus, a tristique sapien pellentesque in. Fusce purus urna, posuere ac massa vitae, vestibulum vestibulum diam. Quisque eros dolor, pulvinar non viverra quis, semper ut ligula. Quisque eu dui ante. Maecenas rutrum, nisi vitae scelerisque auctor, turpis elit ullamcorpe dui dictum, tempor ipsum vitae, semper urna. Pellentesque lacinia et ipsum eu porta. In cursus justo aliquam tellus malesuada porttitor. Nullam auctor aliquam ultrices. Aliquam bibendum sagittis velit sit amet venenatis. Etiam scelerisque ante eget tortor lobortis scelerisque. Praesent tempus et enim sed commodo. Duis id gravida eros. Fusce vitae risus vitae lorem auctor scelerisque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum ante ipsum primis in faucibus orci luc'),
(5, 'riccardo', 'riccardo', 'Riccardo Lagana', 'fffffff', 'riccardo.html', 'riccardo_foto_piccola.jpg', 'riccardo_foto.jpg', 'Milano', 'Borgaro, il 12/10/1983', 'UniTo, Dipartimento Informatica', 'Scai', 'Single', '56 persone', 'Captain America', 'Quisque rhoncus nisi metus, id sagittis purus cursus vitae. Morbi sit amet nibh a magna fermentum facilisis non eget turpis. Ut dignissim nulla lacus, a tristique sapien pellentesque in. Fusce purus urna, posuere ac massa vitae, vestibulum vestibulum diam. Quisque eros dolor, pulvinar non viverra quis, semper ut ligula. Quisque eu dui ante. Maecenas rutrum, nisi vitae scelerisque auctor, turpis elit ullamcorper nulla, nec aliquam lorem massa quis felis. Cras quis purus urna. Fusce eget dui dictum, tempor ipsum vitae, semper urna. Pellentesque lacinia et ipsum eu porta. In cursus justo aliquam tellus malesuada porttitor. Nullam auctor aliquam ultrices. Aliquam bibendum sagittis velit sit amet venenatis. Etiam scelerisque ante eget tortor lobortis scelerisque. Praesent tempus et enim sed commodo. Duis id gravida eros. Fusce vitae risus vitae lorem auctor scelerisque. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum ante ipsum primis i'),
(14, 'zebra', 'asdfg', 'Cataldo Baglio', 'Modifica il tuo primo messaggio di stato!', '', 'default_piccola.jpg', '220px-Aldo_Baglio.jpg', 'Indirizzo non inserito', 'Luogo di nascita non inserito', 'Professione non inserita', 'Sconosciuto', 'Sconosciuto', '0 persone', 'Tre uomini e una gamba', 'Cambia la descrizione per farti conoscere meglio!');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

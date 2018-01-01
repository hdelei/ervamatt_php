-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/01/2018 às 23:29
-- Versão do servidor: 10.1.25-MariaDB
-- Versão do PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `erva`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time DEFAULT '00:00:00',
  `picture` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `agenda`
--

INSERT INTO `agenda` (`id`, `name`, `address`, `date`, `time`, `picture`) VALUES
(53, 'Favela Chic', 'Rua Piauí', '2017-12-30', '20:20:00', 'favela.jpg'),
(50, 'Favela Chic', 'Rua Piauí', '2017-12-30', '20:20:00', 'favela.jpg'),
(51, 'Favela Chic', 'Rua Piauí', '2017-12-30', '20:20:00', 'favela.jpg'),
(2, 'Biergarten Bar', 'Rua 1', '2017-03-29', '10:20:00', '2.jpg'),
(3, 'Porão do Rock', 'Rua 1', '2017-03-28', '10:20:00', 'porao.jpg'),
(46, 'Erva Matt Garage Bar', 'Rua Piauí', '2017-12-29', '20:20:00', 'empty.jpg'),
(47, 'Bar Cu do Padre', 'Rua Piauí', '2018-01-04', '20:20:00', 'cudopadre.jpg'),
(52, 'Favela Chic', 'Rua Piauí', '2017-12-30', '17:20:00', 'favela.jpg'),
(54, 'Favela Chic', 'Rua Piauí', '2017-12-30', '23:20:00', 'favela.jpg'),
(55, 'Favela Chic', 'Rua Piauí', '2017-12-30', '14:20:00', 'favela.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `historia`
--

CREATE TABLE `historia` (
  `id` int(11) NOT NULL,
  `text` varchar(10000) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Hello world'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `historia`
--

INSERT INTO `historia` (`id`, `text`) VALUES
(1, 'História da banda Erva Matt.&nbsp;<p></p><p class=\"recuo\">Em breve...<p/>');

-- --------------------------------------------------------

--
-- Estrutura para tabela `youtube`
--

CREATE TABLE `youtube` (
  `id` int(11) NOT NULL,
  `video_key` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `youtube`
--

INSERT INTO `youtube` (`id`, `video_key`, `title`) VALUES
(37, '4z2DtNW79sQ', 'Bruce Springsteen - Streets of Philadelphia');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `historia`
--
ALTER TABLE `historia`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `youtube`
--
ALTER TABLE `youtube`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `video_key` (`video_key`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT de tabela `historia`
--
ALTER TABLE `historia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de tabela `youtube`
--
ALTER TABLE `youtube`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

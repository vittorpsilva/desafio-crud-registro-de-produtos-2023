-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 04/12/2023 às 23:36
-- Versão do servidor: 8.2.0
-- Versão do PHP: 8.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `vittor`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `nome` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantidade` int NOT NULL,
  `preco` int NOT NULL,
  `descricao` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dia` date NOT NULL,
  `hora` time NOT NULL,
  `ID` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`nome`, `quantidade`, `preco`, `descricao`, `dia`, `hora`, `ID`) VALUES
('Garrafa', 1, 2, 'Garrafa pet de refrigerante', '2023-11-09', '12:00:00', 1),
('Notebook', 10, 4500, 'Notebook Acer Nitro 5 AN515-795J', '2023-11-16', '17:40:16', 2),
('Interface de Áudio', 20, 879, 'Focusrite Scarlett Solo', '2023-10-04', '20:10:45', 3),
('Iphone 15', 5, 5000, 'Apple Iphone 15 vermelho', '2023-09-03', '13:58:40', 4),
('Lampada', 3, 3, 'Conjunto de lampadas', '2023-12-04', '22:38:00', 5),
('Livro', 10, 10, 'Pack de livros', '2023-12-04', '19:49:46', 8);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

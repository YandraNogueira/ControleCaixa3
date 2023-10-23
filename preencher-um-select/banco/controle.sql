-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 16-Out-2023 às 18:32
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `controle`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categoria` varchar(220) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `categoria`) VALUES
(1, 'Oboticario'),
(2, 'Arezzo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sub_categorias_post`
--

DROP TABLE IF EXISTS `sub_categorias_post`;
CREATE TABLE IF NOT EXISTS `sub_categorias_post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_sub_categoria` varchar(220) NOT NULL,
  `categorias_post_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `sub_categorias_post`
--

INSERT INTO `sub_categorias_post` (`id`, `nome_sub_categoria`, `categorias_post_id`) VALUES
(1, 'Oboticario iguatu', 1),
(2, 'Oboticario vd', 1),
(3, 'Arezzo iguatu', 2),
(4, 'Arezzo Rio mar', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tarefas`
--

DROP TABLE IF EXISTS `tarefas`;
CREATE TABLE IF NOT EXISTS `tarefas` (
  `id_tarefas` int NOT NULL AUTO_INCREMENT,
  `cod_categoria` int NOT NULL,
  `cod_subcat` int NOT NULL,
  `tarefa` text NOT NULL,
  `data_realiz` date NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id_tarefas`),
  KEY `cod_categoria` (`cod_categoria`),
  KEY `cod_subcat` (`cod_subcat`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `tarefas`
--

INSERT INTO `tarefas` (`id_tarefas`, `cod_categoria`, `cod_subcat`, `tarefa`, `data_realiz`, `status`) VALUES
(61, 1, 1, 'teste', '2023-10-17', 'Concluído'),
(62, 2, 3, 'teste2', '2023-10-19', 'Pendente'),
(63, 2, 4, 'teste3', '2023-10-24', 'Concluído'),
(64, 2, 3, 'teste4', '2023-10-25', 'Concluído'),
(65, 1, 2, 'teste5', '2023-10-25', 'Pendente');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

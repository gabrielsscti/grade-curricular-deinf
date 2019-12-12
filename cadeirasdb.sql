-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Dez-2019 às 01:27
-- Versão do servidor: 10.4.8-MariaDB
-- versão do PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cadeirasdb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadeira`
--

CREATE TABLE `cadeira` (
  `idCadeira` int(11) NOT NULL,
  `nome` varchar(512) NOT NULL,
  `departamento` varchar(5) NOT NULL,
  `creditos` varchar(10) DEFAULT NULL,
  `codigo` varchar(10) DEFAULT NULL,
  `iseletiva` tinyint(1) NOT NULL DEFAULT 1,
  `grupo` tinyint(4) DEFAULT NULL,
  `periodo` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cadeira`
--

INSERT INTO `cadeira` (`idCadeira`, `nome`, `departamento`, `creditos`, `codigo`, `iseletiva`, `grupo`, `periodo`) VALUES
(1, 'Cálculo diferencial e Integral I', 'MAT', '90.6.0.0', '5589.0', 0, NULL, 1),
(2, 'Algorítmos I', 'INF', '60.4.0.0', '5588.9', 0, NULL, 1),
(3, 'Introdução a\r\nComputação', 'INF', '45.3.0.0', '5587.8', 0, NULL, 1),
(4, 'Algorítmos II', 'INF', '', '5617.7', 1, 1, NULL),
(5, 'Física I', 'FIS', '60.4.0.0', '5591.4', 0, NULL, 2),
(6, 'Cálculo Vetorial e Geometria Analítica', 'MAT', '60.4.0.0', '1019.5', 0, NULL, 1),
(7, 'Linguagem de Programação I', 'INF', '60.2.1.0', '5593.6', 0, NULL, 2),
(8, 'Paradigmas de Programação', 'INF', '60.2.1.0', '5598.1', 0, NULL, 3),
(9, 'Estrutura de Dados II', 'INF', '60.2.1.0', '5596.9', 0, NULL, 4),
(10, 'Compiladores', 'INF', '60.2.1.0', '5596.9', 0, NULL, 5),
(11, 'Inteligência Artificial', 'INF', '60.4.0.0', '5935.8', 0, NULL, 6),
(12, 'Eletiva do Grupo I', 'INF', '60.4.0.0', '', 0, NULL, 7),
(13, 'Monografia I', 'INF', '60.2.1.0', '5596.9', 0, NULL, 8),
(14, 'Monografia II', 'INF', '60.2.1.0', '5596.9', 0, NULL, 9),
(15, 'Metodologia Científica', 'FIL', '60.4.0.4', '0725.0', 0, NULL, 1),
(16, 'Álgebra Linear', 'MAT', '60.4.0.0', '1002.6', 0, NULL, 2),
(17, 'Cálculo diferencial e Integral II', 'MAT', '90.6.0.0', '5594.7', 0, NULL, 2),
(18, 'Matemática discreta e lógica', 'INF', '60.4.0.0', '5595.8', 0, NULL, 2),
(19, 'Eletiva do Grupo II', 'INF', '45.3.0.0', '', 0, NULL, 2),
(20, 'Arquitetura de computadores', 'INF', '60.2.1.0', '5596.9', 0, NULL, 3),
(21, 'Estrutura de Dados I', 'INF', '60.2.1.0', '5597.0', 0, NULL, 3),
(22, 'Cálculo diferencial e Integral III', 'MAT', '90.6.0.0', '5594.7', 0, NULL, 3),
(23, 'Linguagens Formais e Autômatos', 'FIS', '60.4.0.0', '5600.8', 0, NULL, 3),
(24, 'Física II', 'FIS', '60.4.0.0', '5601.9', 0, NULL, 3),
(25, 'Física Experimental I', 'FIS', '30.0.1.0', '5602.0', 0, NULL, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadeiracadeira`
--

CREATE TABLE `cadeiracadeira` (
  `idCadeira` int(11) NOT NULL,
  `idPreRequisito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cadeiracadeira`
--

INSERT INTO `cadeiracadeira` (`idCadeira`, `idPreRequisito`) VALUES
(5, 1),
(7, 2),
(8, 2),
(16, 6),
(17, 1),
(20, 18),
(21, 2),
(21, 3),
(22, 17),
(23, 18),
(24, 5),
(25, 24);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cadeira`
--
ALTER TABLE `cadeira`
  ADD PRIMARY KEY (`idCadeira`),
  ADD UNIQUE KEY `idCadeira_UNIQUE` (`idCadeira`),
  ADD UNIQUE KEY `nome_UNIQUE` (`nome`);

--
-- Índices para tabela `cadeiracadeira`
--
ALTER TABLE `cadeiracadeira`
  ADD PRIMARY KEY (`idCadeira`,`idPreRequisito`),
  ADD KEY `fk_Cadeira_has_Cadeira_Cadeira1_idx` (`idPreRequisito`),
  ADD KEY `fk_Cadeira_has_Cadeira_Cadeira_idx` (`idCadeira`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadeira`
--
ALTER TABLE `cadeira`
  MODIFY `idCadeira` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `cadeiracadeira`
--
ALTER TABLE `cadeiracadeira`
  ADD CONSTRAINT `fk_Cadeira_has_Cadeira_Cadeira` FOREIGN KEY (`idCadeira`) REFERENCES `cadeira` (`idCadeira`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Cadeira_has_Cadeira_Cadeira1` FOREIGN KEY (`idPreRequisito`) REFERENCES `cadeira` (`idCadeira`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

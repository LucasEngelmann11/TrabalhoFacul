-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/11/2023 às 12:00
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_cine`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(25) DEFAULT NULL,
  `sobrenome` varchar(50) DEFAULT NULL,
  `cpf` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dataNascimento` date DEFAULT NULL,
  `senha` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cadastro`
--

INSERT INTO `cadastro` (`id_usuario`, `nome`, `sobrenome`, `cpf`, `email`, `dataNascimento`, `senha`) VALUES
(1, 'teste', 'teste', '12012012010', 'matheusrodocampos@gmail.com', '0000-00-00', 'marcos123'),
(2, 'MATHEUS', 'FERNANDES', '12012012010', 'matheusrodocampos@gmail.com', '0000-00-00', 'teste123'),
(3, '', '', '', '', '0000-00-00', ''),
(4, '', '', '', '', '0000-00-00', ''),
(5, '', '', '', '', '0000-00-00', ''),
(6, 'matheus', 'fernandes', '12012012020', 'mmmma@msmams.com', '0000-00-00', '11111'),
(7, '', '', '', '', '0000-00-00', ''),
(8, 'czcz', 'czcz', '44444444444', 'matheusrodocampos@gmail.com', '0000-00-00', 'teste123'),
(9, '', '', '', '', '0000-00-00', ''),
(10, '', '', '', '', '0000-00-00', ''),
(11, 'teeste', 'teste', '11414141414', 'ronaldo@gmail.com', '0000-00-00', '12345678');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastro`
--
ALTER TABLE `cadastro`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

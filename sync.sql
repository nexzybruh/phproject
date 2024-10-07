-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/10/2024 às 21:48
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sync`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `base`
--

CREATE TABLE `base` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `route` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `base`
--

INSERT INTO `base` (`id`, `name`, `route`) VALUES
(1, 'JBR', 'https://api.syncdata.org/receita/cpf/<token>/<cpf>\nhttps://api.syncdata.org/receita/nome/<token>/<nome>\nhttps://api.syncdata.org/receita/datanasc/<token>/<nome>/<datanasc>'),
(2, 'São Paulo', 'https://api.syncdata.org/sp/cpf/<token>/<cpf>');

-- --------------------------------------------------------

--
-- Estrutura para tabela `jbr_temp`
--

CREATE TABLE `jbr_temp` (
  `CPF` varchar(11) NOT NULL,
  `Nome Completo` varchar(100) DEFAULT NULL,
  `Sexo / Gênero` varchar(10) DEFAULT NULL,
  `Data de Nascimento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `jbr_temp`
--

INSERT INTO `jbr_temp` (`CPF`, `Nome Completo`, `Sexo / Gênero`, `Data de Nascimento`) VALUES
('04225321185', 'Jair Renan Valle Bolsonaro', NULL, '1998-04-10'),
('45317828791', 'Jair Messias Bolsonaro', NULL, '1955-03-21');

-- --------------------------------------------------------

--
-- Estrutura para tabela `limite`
--

CREATE TABLE `limite` (
  `id` int(11) NOT NULL,
  `token` varchar(32) NOT NULL,
  `api_rota` varchar(32) NOT NULL,
  `date` varchar(32) NOT NULL,
  `value` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `limite`
--

INSERT INTO `limite` (`id`, `token`, `api_rota`, `date`, `value`) VALUES
(1, '801e555a5d98d7a16c904ff13ca516d8', 'api_route_placeholder', '2024-10-04', 9);

-- --------------------------------------------------------

--
-- Estrutura para tabela `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `user` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `plano` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `login`
--

INSERT INTO `login` (`id`, `user`, `password`, `plano`) VALUES
(1, 'nexzy', '2734191bc58920674bc6bbbd95bd6162', '2033-10-24');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `token` varchar(32) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `duration` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tokens`
--

INSERT INTO `tokens` (`id`, `token`, `timestamp`, `duration`) VALUES
(1, '801e555a5d98d7a16c904ff13ca516d8', '2024-10-03 19:29:14', '2024-10-31');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `base`
--
ALTER TABLE `base`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `jbr_temp`
--
ALTER TABLE `jbr_temp`
  ADD PRIMARY KEY (`CPF`);

--
-- Índices de tabela `limite`
--
ALTER TABLE `limite`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `limite` ADD FULLTEXT KEY `token` (`token`);

--
-- Índices de tabela `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `base`
--
ALTER TABLE `base`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `limite`
--
ALTER TABLE `limite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3002;

--
-- AUTO_INCREMENT de tabela `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

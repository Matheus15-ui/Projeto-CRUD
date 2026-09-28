-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql113.infinityfree.com
-- Tempo de geração: 04/04/2026 às 11:06
-- Versão do servidor: 11.4.10-MariaDB
-- Versão do PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `if0_40531218_wda_crud`
CREATE DATABASE if0_40531218_wda_crud;
USE if0_40531218_wda_crud;
--

-- --------------------------------------------------------
--
-- Estrutura para tabela `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cpf_cnpj` varchar(15) NOT NULL,
  `birthdate` datetime NOT NULL,
  `address` varchar(255) NOT NULL,
  `hood` varchar(100) NOT NULL,
  `zip_code` varchar(8) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(2) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `mobile` varchar(13) NOT NULL,
  `ie` varchar(15) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `customers`
--

INSERT INTO `customers` (`id`, `name`, `cpf_cnpj`, `birthdate`, `address`, `hood`, `zip_code`, `city`, `state`, `phone`, `mobile`, `ie`, `created`, `modified`) VALUES
(1, 'Fulano de Tal', '123.456.789-00', '1989-01-01 00:00:00', 'Rua da Web, 123', 'Internet', '12345678', 'Teste', 'Te', '15 12345678', '15987654321', '123456', '2016-05-24 00:00:00', '2016-05-24 00:00:00'),
(2, 'Ciclano de Tal', '123.456.789-00', '1989-01-01 00:00:00', 'Rua da Web, 123', 'Internet', '12345678', 'Teste', 'Te', '15 12345678', '15987654321', '123456', '2016-05-24 00:00:00', '2016-05-24 00:00:00'),
(5, 'trnytre5445', '342543253245324', '2002-12-17 00:00:00', 'wergewrge454554', 'erwgewrg', '32444243', 'erwgerwgerw', 'gr', '23423423423', '23143123432', '143241234', '2025-12-02 09:08:46', '2025-12-02 09:09:11');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `endereco` varchar(50) DEFAULT NULL,
  `idade` int(11) DEFAULT NULL,
  `dataNasc` datetime DEFAULT NULL,
  `foto` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `pacientes` (`id`, `nome`, `endereco`, `idade`, `dataNasc`, `foto`) VALUES
(6, 'nenem', 'na sombra de sua mente', 9999, '2025-01-01 00:00:00', 'oCaosRastejante.png'),
(18,'Puro Osso', 'cemitério santo Antônio', 191, '1834-09-10 14:30:00', 'eisqueleto.png'),
(19,'Jarvis', 'rua Jesuina Candita', 1, '2025-01-01 00:00:00', 'desmilinguido.png'),
(20,'Docinho de coco', 'não sei', 1, '0001-01-01 00:00:00', 'ocaosrastejante.jpg'),
(20, 'Desgraçado da Silva', 'numa esquina qualquer', 4, '2022-05-03 13:00:00', 'bolsonaro.png');
-- --------------------------------------------------------

--
-- Estrutura para tabela `pets`
--

CREATE TABLE `pets` (
  `id` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Tutor` varchar(50) NOT NULL,
  `Tipo` varchar(20) NOT NULL,
  `DataNasc` datetime NOT NULL,
  `Foto` varchar(30) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Despejando dados para a tabela `pets`
--

INSERT INTO `pets` (`id`, `Nome`, `Tutor`, `Tipo`, `DataNasc`, `Foto`, `created`, `modified`) VALUES
(6, 'coruja', 'Rogerio', 'Ave', '2025-01-01 00:00:00', '6928582842815-gugu.jpg', '2025-08-28 12:05:00', '2025-11-27 08:54:48'),
(18, 'gato malhado', 'Andre Young', 'gato', '2021-11-11 00:00:00', 'gatoMalhado.jpg', '0000-00-00 00:00:00', '2025-12-01 19:28:38'),
(19, 'cachorro', 'Davy Jones', 'canino', '2025-11-11 00:00:00', 'cachorro.jpg', '0000-00-00 00:00:00', '2025-12-02 06:17:37'),
(20, 'giovasio de azevedo', 'O mago', 'fecal', '2020-12-09 00:00:00', 'giovasio.png', '0000-00-00 00:00:00', '2025-12-02 07:10:42');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `modified` timestamp NULL DEFAULT current_timestamp(),
  `created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `user`, `password`, `foto`, `modified`, `created`) VALUES
(1, 'Adm', 'admin1', '$2y$13$ncicCEkYz/xoWq74TbirKeF0szf2gklrxieOziZdoprR0m53z85Re', 'feliepequebracodigos.png', '2025-12-01 23:14:15', '2025-12-01 23:14:15'),
(10, 'Iberé Tenorio', 'manualDoSubmundo', '$2y$10$OjLv4.gBzxgmUNkepCreSuqOatBaOJrsqz2cP/B36UFl2NvAXGFum', 'ibere.png', '2025-12-02 03:24:37', '2025-12-02 00:24:37'),
(4, 'Fugiru Nakombi', 'fugina', '$2y$13$1EWE8EfozTZUu6PU9.vq..Qicua6sUwkewxkcTu8lC2bcCSYVbaDa', NULL, '2025-12-01 23:14:15', '2025-12-01 23:14:15'),
(9, 'andre young', 'andrezitos', '$2y$10$Y/4Tuha8BxBFaGxy283ax.fPOLH7UKocm6jf2VasN189nL04V0/LO', 'andre.png', '2025-12-02 03:23:50', '2025-12-02 00:23:50'),
(11, 'Davy jones', 'davyJones', '$2y$10$7Kkbh2P1A6wArbSp3R7hoOELhIjS.P.k/.unT7TJazq10rv2dxniW', 'davyjones.jpg', '2025-12-02 03:31:08', '2025-12-02 00:31:08'),
(12, 'mzina', 'mazi', '$2y$10$ww85asJAmAQDNWrrFHAch.QZeszcPnAX5bAdQEgKdJAYTHk245x/G', NULL, '2025-12-02 14:27:27', '2025-12-02 11:27:27'),
(13, 'O Darwin', 'darwin', '$2y$13$ncicCEkYz/xoWq74TbirKeF0szf2gklrxieOziZdoprR0m53z85Re', 'oDarwin.png', '2025-12-02 14:27:27', '2025-12-02 11:27:27'),
(14, 'teste', 'teste', '$2y$10$ZQbgz83e4oSViLMGA9yIneNSoigcX8D/VYTe9U/Xs/UwXhX.9XNfy', 'trollface.png', '2025-12-02 15:11:58', '2025-12-02 12:11:58');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

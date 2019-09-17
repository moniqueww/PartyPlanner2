-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18-Set-2019 às 00:21
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `partyplanner`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`) VALUES
(1, 'Segurança'),
(2, 'Estabelecimento'),
(3, 'Decoração'),
(4, 'Bebidas'),
(5, 'Artista');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estrelas`
--

CREATE TABLE `estrelas` (
  `id` int(11) NOT NULL,
  `id_servico` int(11) NOT NULL,
  `qnt_estrelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
--

CREATE TABLE `eventos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idUsuario` bigint(20) NOT NULL,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` varchar(9999) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idEstabelecimento` int(11) DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `imagem` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no-image.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `eventos`
--

INSERT INTO `eventos` (`id`, `idUsuario`, `nome`, `descricao`, `idEstabelecimento`, `status`, `imagem`) VALUES
(127, 20, 'aaaaa', '', 31, 1, '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `evento_artista`
--

CREATE TABLE `evento_artista` (
  `id` int(11) NOT NULL,
  `idEvento` int(11) NOT NULL,
  `idServico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `evento_artista`
--

INSERT INTO `evento_artista` (`id`, `idEvento`, `idServico`) VALUES
(5, 127, 23),
(12, 127, 24);

-- --------------------------------------------------------

--
-- Estrutura da tabela `evento_preco`
--

CREATE TABLE `evento_preco` (
  `id` int(11) NOT NULL,
  `idEvento` int(11) NOT NULL,
  `valor` float NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `evento_preco`
--

INSERT INTO `evento_preco` (`id`, `idEvento`, `valor`, `nome`, `descricao`) VALUES
(4, 127, 223, 'Normal', 'awdawdawdawdawd');

-- --------------------------------------------------------

--
-- Estrutura da tabela `evento_representante`
--

CREATE TABLE `evento_representante` (
  `id` int(11) NOT NULL,
  `idEvento` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `evento_servico`
--

CREATE TABLE `evento_servico` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idEvento` bigint(20) UNSIGNED NOT NULL,
  `idServico` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `quadro`
--

CREATE TABLE `quadro` (
  `id` int(11) NOT NULL,
  `idEvento` int(11) NOT NULL,
  `idServico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `quadro`
--

INSERT INTO `quadro` (`id`, `idEvento`, `idServico`) VALUES
(11, 127, 2),
(12, 127, 9),
(13, 127, 13),
(14, 127, 8),
(15, 127, 15),
(17, 127, 23);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` bigint(20) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `tipo` char(1) NOT NULL,
  `cnpj` char(14) DEFAULT NULL,
  `telefone` bigint(20) DEFAULT NULL,
  `idCategoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `tipo`, `cnpj`, `telefone`, `idCategoria`) VALUES
(1, 'Segurança LTDA', 'emailteste@gmail.com', 'senha123', 'S', '98217389', 5434543454, 1),
(2, 'Bebidas LTDA', 'emailteste2@gmail.com', 'senha1234', 'S', '127836', 5433443344, 4),
(5, 'Decoração LTDA', 'emailteste4@gmail.com', 'senha123', 'S', '213123123', 5434556677, 3),
(8, 'Segurança 2 LTDA', 'emailteste2332@gmail.com', 'senha123', 'S', '123123123', 5434543454, 1),
(9, 'Bebidas 2 LTDA', 'emailteste128@gmail.com', 'senha123', 'S', '12312321', 5434543454, 4),
(10, 'Decoração 2 LTDA', 'emailteste218736@gmail.com', 'senha123', 'S', '1298371298', 5434543454, 3),
(11, 'Serviço 1', 'servico@gmail.com', 'senha 123', 'S', '12345678909876', 5434543454, 1),
(13, 'servico 2', 'servico2@gmail.com', 'senha123', 'S', '12345678909876', 5434543454, 2),
(14, 'servico 3', 'servico3@gmail.com', 'senha123', 'S', '12345678909876', 5434543454, 3),
(15, 'SERVICO4', 'servico4@gmail.com', 'senha123', 'S', '12345678909876', 5434543454, 4),
(16, 'servico 5', 'servico5@gmail.com', 'senha123', 'S', '12345678909876', 5434543454, 5),
(17, 'servico 6', 'servico6@gmail.com', 'senha123', 'S', '12345678909876', 5434543454, 4),
(18, 'servico 7', 'servico7@gmail.com', 'senha123', 'S', '12345678909876', 5434543454, 3),
(19, 'servico 7', 'servico7@gmail.com', 'senha123', 'S', '12345678909876', 5434543453, 2),
(20, 'Teste', 'teste', '123', 'O', NULL, NULL, NULL),
(22, 'Dj khalid fodase', 'ajklw@awkjdyh', '123', 'S', '12093712378', 129873617823, 5),
(23, 'Aviccii', 'avitifodase@akwjd', '123', 'S', '123987612387', 1982347789124, 5),
(24, 'Deivid gueta', 'deivid@wajdhjk', '123', 'S', '217367812368', 123124214, 5),
(25, 'Chatuba', '29837@218937', '123', 'S', '123124124', 123123124, 5),
(26, 'Grégori', 'gregori', 'gregori123', 'O', NULL, NULL, NULL),
(27, 'Monique', 'monique', 'monique123', 'O', NULL, NULL, NULL),
(28, 'Lorenzo', 'lorenzo', 'lorenzo123', 'O', NULL, NULL, NULL),
(29, 'Guilherme', 'guilherme', 'guilherme123', 'O', NULL, NULL, NULL),
(30, 'Pedro Lucas', 'pedro', 'pedro123', 'O', NULL, NULL, NULL),
(31, 'Cultive Bar', 'cultivebar@gmail.com', '123', 'S', '23534534646', 54996233793, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estrelas`
--
ALTER TABLE `estrelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evento_artista`
--
ALTER TABLE `evento_artista`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evento_preco`
--
ALTER TABLE `evento_preco`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evento_representante`
--
ALTER TABLE `evento_representante`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evento_servico`
--
ALTER TABLE `evento_servico`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quadro`
--
ALTER TABLE `quadro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `estrelas`
--
ALTER TABLE `estrelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `evento_artista`
--
ALTER TABLE `evento_artista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `evento_preco`
--
ALTER TABLE `evento_preco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `evento_representante`
--
ALTER TABLE `evento_representante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `evento_servico`
--
ALTER TABLE `evento_servico`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quadro`
--
ALTER TABLE `quadro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 25-Set-2019 às 06:36
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
  `idServico` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `qtdEstrelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
--

CREATE TABLE `eventos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idUsuario` bigint(20) NOT NULL,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idEstabelecimento` int(11) DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `imagem` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no-image.png',
  `visitas` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `eventos`
--

INSERT INTO `eventos` (`id`, `idUsuario`, `nome`, `descricao`, `idEstabelecimento`, `status`, `imagem`, `visitas`) VALUES
(132, 36, 'NEON BEATS', 'É uma festa neon muito brilhante e fantástica!', 42, 1, 'molde-abstrato-de-neon-do-partido-do-partido_1370-164.jpg', 0),
(135, 35, 'NEON BEATS PT. 2', 'Festa muito boa melhor que a do guilherme', 41, 1, 'modelo-de-fundo-neon-circle-party_1370-165.jpg', 0);

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
(50, 132, 44),
(51, 132, 48),
(52, 135, 47),
(53, 135, 45);

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
(21, 132, 20, 'Normal', 'Apenas acesso para pista de baixo e sem atrativos'),
(22, 132, 30, 'Vip', 'Acesso para todas pistas e atrativos'),
(23, 135, 25, 'Padrão', 'Preço unitário para tudo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `evento_representante`
--

CREATE TABLE `evento_representante` (
  `id` int(11) NOT NULL,
  `idEvento` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `evento_representante`
--

INSERT INTO `evento_representante` (`id`, `idEvento`, `idUsuario`) VALUES
(17, 132, 34),
(18, 135, 37);

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
-- Estrutura da tabela `favorita_evento`
--

CREATE TABLE `favorita_evento` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idEvento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `favorita_evento`
--

INSERT INTO `favorita_evento` (`id`, `idUsuario`, `idEvento`) VALUES
(17, 36, 132);

-- --------------------------------------------------------

--
-- Estrutura da tabela `favorita_servico`
--

CREATE TABLE `favorita_servico` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idServico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `publicacao`
--

CREATE TABLE `publicacao` (
  `id` int(11) NOT NULL,
  `idEvento` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descricao` varchar(2000) NOT NULL,
  `imagem` varchar(2000) DEFAULT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `publicacao`
--

INSERT INTO `publicacao` (`id`, `idEvento`, `titulo`, `descricao`, `imagem`, `data`) VALUES
(12, 132, 'Minha festa é muito melhor', 'Vi que o Lorenzo copiou a minha festa e ainda teve audácia de dizer que a dele vai ser melhor, mas é mentira. Não tem como criar uma festa melhor que essa.', '', '2019-09-25');

-- --------------------------------------------------------

--
-- Estrutura da tabela `quadro`
--

CREATE TABLE `quadro` (
  `id` int(11) NOT NULL,
  `idEvento` int(11) NOT NULL,
  `idServico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `idCategoria` int(11) DEFAULT NULL,
  `imagem` varchar(200) NOT NULL DEFAULT 'no-image.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `tipo`, `cnpj`, `telefone`, `idCategoria`, `imagem`) VALUES
(33, 'Grégori', 'gregori@gmail.com', 'gregori123', 'O', NULL, NULL, NULL, '20190925_004311.jpg'),
(34, 'Monique', 'monique@gmail.com', 'monique123', 'O', NULL, NULL, NULL, 'no-image.png'),
(35, 'Lorenzo', 'lorenzo@gmail.com', 'lorenzo123', 'O', NULL, NULL, NULL, '20190925_004015.jpg'),
(36, 'Guilherme', 'guilherme@gmail.com', 'guilherme123', 'O', NULL, NULL, NULL, '20190925_004004.jpg'),
(37, 'Pedro lucas', 'pedrolucas@gmail.com', 'pedrolucas123', 'O', NULL, NULL, NULL, 'no-image.png'),
(38, 'Espaço para Eventos Giuseppe Toniolo', 'toniolo@gmail.com', '123', 'S', '', 5434543454, 2, '19800887_1738456539785817_3600936300851680511_o.jpg'),
(39, 'Benestare', 'benestare@gmail.com', '123', 'S', '', 5434539155, 2, '4_13_168717-1562344358.jpg'),
(40, 'Fundaparque', 'fundaparque@gmail.com', '123', 'S', '', 182736237, 2, 'fundaparque-585x384.jpg'),
(41, 'Cultive Bar', 'cultive@gmail.com', '123', 'S', '', 1234124, 2, 'cultive-bar.jpg'),
(42, 'Buteco 63', 'buteco@gmail.com', '123', 'S', '', 12341421, 2, '14519814_bZFQm6k9TC8_mJfutKLPjlvlQbOtl7e4JBHnRKDNARY.jpg'),
(43, 'Eminem', 'eminem@gmail.com', '123', 'S', '', 128736124, 5, 'eminem_photo_by_dave_j_hogan_getty_images_entertainment_getty_187596325.jpg'),
(44, 'Marshmello', 'marshmello@gmail.com', '123', 'S', '', 124124124, 5, 'ceQbB4LB_400x400.jpg'),
(45, 'J. Cole', 'jcole@gmail.com', '123', 'S', '', 124124124, 5, '500x500.jpg'),
(46, 'Anitta', 'anitta@gmail.com', '123', 'S', '', 124124124, 5, 'anitta-consulado-e1499192108725-620x450.jpg'),
(47, 'Twenty One Pilots', 't1pilots@gmail.com', '123', 'S', '', 182647, 5, 'f8e28a81feb9baa0fbc3d69e12587755745a122d.jpg'),
(48, 'Dj Rogério', 'djrogerio@gmail.com', '123', 'S', '', 12873612, 5, '292444-271529096284287-1416388445-n.jpg'),
(49, 'Nome Cantor', 'nomecantor@gmail.com', '123', 'S', '', 15423532, 5, 'no-image.png'),
(50, 'Artista desconhecido', 'artistadesconhecido@gmail.com', '123', 'S', '124124214', 124124124, 5, 'no-image.png');

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
-- Indexes for table `favorita_evento`
--
ALTER TABLE `favorita_evento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorita_servico`
--
ALTER TABLE `favorita_servico`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publicacao`
--
ALTER TABLE `publicacao`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `evento_artista`
--
ALTER TABLE `evento_artista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `evento_preco`
--
ALTER TABLE `evento_preco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `evento_representante`
--
ALTER TABLE `evento_representante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `evento_servico`
--
ALTER TABLE `evento_servico`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorita_evento`
--
ALTER TABLE `favorita_evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `favorita_servico`
--
ALTER TABLE `favorita_servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `publicacao`
--
ALTER TABLE `publicacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `quadro`
--
ALTER TABLE `quadro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 13-Ago-2019 às 21:04
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
-- Estrutura da tabela `eventos`
--

CREATE TABLE `eventos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idUsuario` bigint(20) NOT NULL,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `eventos`
--

INSERT INTO `eventos` (`id`, `idUsuario`, `nome`, `descricao`, `status`) VALUES
(41, 1, 'Evento teste 1', 'Descrição teste para evento teste 1', 0),
(42, 1, 'Festa 3', 'Uma festa para jovens e jovenas do brasul e do rio grande do sulq2ea2qed2', 0),
(43, 1, 'Evento teste 3', NULL, 0),
(45, 4, 'Evento teste 310', NULL, 0),
(46, 6, 'Meu evento', NULL, 0),
(47, 6, 'teste 1 2', NULL, 0),
(48, 7, 'Evento teste Grégori', '', 1),
(56, 7, 'Novo evento teste', NULL, 0),
(57, 7, 'Outro evento', NULL, 0),
(70, 20, 'Novo evento', NULL, 0),
(71, 20, 'Novo teste', NULL, 0),
(72, 20, 'aaaaaaaaa', NULL, 0),
(73, 21, 'Evento teste', '', 0),
(74, 20, 'awdwad', NULL, 0),
(75, 20, 'aaaa', NULL, 0),
(76, 20, 'Teste publica', '1233', 1),
(77, 20, 'aaa', NULL, 0),
(78, 20, 'aaasdadwer4352', 'descricao a9ujs kakas idis as da s dosidsk soaos dkdu skais dpd s', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `evento_servico`
--

CREATE TABLE `evento_servico` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idEvento` bigint(20) UNSIGNED NOT NULL,
  `idServico` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `evento_servico`
--

INSERT INTO `evento_servico` (`id`, `idEvento`, `idServico`) VALUES
(1, 42, 2),
(4, 41, 1),
(5, 42, 1),
(6, 41, 2),
(7, 46, 2),
(8, 46, 1),
(9, 46, 5),
(10, 47, 2),
(11, 47, 5),
(12, 48, 1),
(13, 48, 2),
(14, 48, 10),
(15, 48, 8),
(16, 48, 9),
(17, 48, 5),
(18, 56, 5),
(19, 56, 1),
(20, 56, 10),
(21, 56, 8),
(22, 56, 2),
(23, 56, 19),
(29, 57, 10),
(30, 57, 8),
(31, 57, 14),
(74, 70, 5),
(75, 71, 17),
(76, 71, 16),
(77, 71, 1),
(78, 72, 8),
(79, 70, 16),
(80, 70, 1),
(81, 70, 8),
(82, 70, 11),
(83, 70, 14),
(84, 70, 19),
(85, 70, 13),
(86, 74, 1),
(87, 74, 11),
(88, 74, 8),
(89, 74, 13),
(90, 74, 16),
(91, 74, 19),
(92, 74, 10),
(93, 75, 8),
(94, 75, 16),
(102, 78, 1),
(103, 78, 8),
(104, 78, 13);

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_05_05_182522_create_servicos_table', 1),
(4, '2019_05_05_220641_create_organizadors_table', 1),
(5, '2019_06_02_175704_create_categorias_table', 1),
(6, '2019_06_10_194432_create_eventos_table', 1),
(7, '2019_06_16_194006_create_quadros_table', 1),
(8, '2019_06_16_200831_create_quadro_servs_table', 1),
(9, '2019_07_08_191853_create_evento_servico_table', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `organizadors`
--

CREATE TABLE `organizadors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `celular` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomeorg` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `quadros`
--

CREATE TABLE `quadros` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `quadro_servs`
--

CREATE TABLE `quadro_servs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_quadro` bigint(20) UNSIGNED NOT NULL,
  `id_serv` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos`
--

CREATE TABLE `servicos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnpj` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idCategoria` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `servicos`
--

INSERT INTO `servicos` (`id`, `name`, `email`, `cnpj`, `senha`, `idCategoria`) VALUES
(1, 'Segurança LTDA', 'emailteste@gmail.com', '21983719283', 'senha123', 0),
(2, 'Bebidas e Alimentos LTDA', 'emailteste2@gmail.com', '219837982173', 'senha1234', 0);

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
(7, 'Partyplanner', 'partyplanner', 'partyplanner123', 'O', NULL, NULL, NULL),
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
(21, 'gregori teste', 'gregori@g', '123', 'O', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evento_servico`
--
ALTER TABLE `evento_servico`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organizadors`
--
ALTER TABLE `organizadors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `quadros`
--
ALTER TABLE `quadros`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quadro_servs`
--
ALTER TABLE `quadro_servs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quadro_servs_id_quadro_foreign` (`id_quadro`),
  ADD KEY `quadro_servs_id_serv_foreign` (`id_serv`);

--
-- Indexes for table `servicos`
--
ALTER TABLE `servicos`
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
-- AUTO_INCREMENT for table `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `evento_servico`
--
ALTER TABLE `evento_servico`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `organizadors`
--
ALTER TABLE `organizadors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quadros`
--
ALTER TABLE `quadros`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quadro_servs`
--
ALTER TABLE `quadro_servs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `servicos`
--
ALTER TABLE `servicos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `quadro_servs`
--
ALTER TABLE `quadro_servs`
  ADD CONSTRAINT `quadro_servs_id_quadro_foreign` FOREIGN KEY (`id_quadro`) REFERENCES `quadros` (`id`),
  ADD CONSTRAINT `quadro_servs_id_serv_foreign` FOREIGN KEY (`id_serv`) REFERENCES `servicos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

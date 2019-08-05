-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 05-Ago-2019 às 21:07
-- Versão do servidor: 10.1.30-MariaDB
-- PHP Version: 7.2.1

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
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
--

CREATE TABLE `eventos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idUsuario` bigint(20) NOT NULL,
  `nome` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `eventos`
--

INSERT INTO `eventos` (`id`, `idUsuario`, `nome`, `descricao`) VALUES
(41, 1, 'Evento teste 1', 'Descrição teste para evento teste 1'),
(42, 1, 'Festa 3', 'Uma festa para jovens e jovenas do brasul e do rio grande do sulq2ea2qed2'),
(43, 1, 'Evento teste 3', NULL),
(45, 4, 'Evento teste 310', NULL),
(46, 6, 'Meu evento', NULL),
(47, 6, 'teste 1 2', NULL),
(48, 7, 'Evento teste Grégori', NULL);

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
(15, 48, 8);

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
  `categoria` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `servicos`
--

INSERT INTO `servicos` (`id`, `name`, `email`, `cnpj`, `senha`, `categoria`) VALUES
(1, 'Segurança LTDA', 'emailteste@gmail.com', '21983719283', 'senha123', 'Segurança'),
(2, 'Bebidas e Alimentos LTDA', 'emailteste2@gmail.com', '219837982173', 'senha1234', 'Alimento');

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
  `telefone` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `tipo`, `cnpj`, `telefone`) VALUES
(1, 'Segurança LTDA', 'emailteste@gmail.com', 'senha123', 'S', '98217389', 5434543454),
(2, 'Bebidas LTDA', 'emailteste2@gmail.com', 'senha1234', 'S', '127836', 5433443344),
(5, 'Decoração LTDA', 'emailteste4@gmail.com', 'senha123', 'S', '213123123', 5434556677),
(7, 'Partyplanner', 'partyplanner@gmail.com', 'partyplanner123', 'O', NULL, NULL),
(8, 'Segurança 2 LTDA', 'emailteste2332@gmail.com', 'senha123', 'S', '123123123', 5434543454),
(9, 'Bebidas 2 LTDA', 'emailteste128@gmail.com', 'senha123', 'S', '12312321', 5434543454),
(10, 'Decoração 2 LTDA', 'emailteste218736@gmail.com', 'senha123', 'S', '1298371298', 5434543454);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `evento_servico`
--
ALTER TABLE `evento_servico`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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

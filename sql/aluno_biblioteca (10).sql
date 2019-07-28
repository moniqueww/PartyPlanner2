-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 10-Dez-2018 às 01:17
-- Versão do servidor: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aluno_biblioteca`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `nome` varchar(100) NOT NULL,
  `matricula` char(12) NOT NULL,
  `curso` varchar(50) NOT NULL,
  `turma` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`nome`, `matricula`, `curso`, `turma`, `email`) VALUES
('Cassio', '201110030029', 'Informática', '2º ano', 'awd@gmail.com'),
('Kleber', '201530040016', 'Enologia', '2º ano', 'awd@awd.com'),
('Grégori P', '201710040018', 'Informática', '2º ano', 'greogri@gmailc.om'),
('Guilherme', '201710040019', 'Agropecuária', '3º ano A', 'gui@gmail.com'),
('Lorenzo', '201710040020', 'Meio Ambiente', '1º ano', 'lorenzo@gmail.com'),
('Ana Clara', '201710040021', 'Agropecuária', '2º ano B', 'awdawd@gmail.com'),
('Maria', '201710040022', 'Enologia', '1º ano', 'AWD@GMAIOÇ.COM'),
('Leonciop', '201710040088', 'Meio Ambiente', '2º ano', 'gregori@gmail.com'),
('Amanda', '201710050092', 'Enologia', '2º ano', 'a@awkd.com'),
('Jose', '201740010023', 'Informática', '3º ano', 'jose@gmail.com'),
('Paulo C', '201940050060', 'Meio Ambiente', '3º ano', 'awdawd@a.com'),
('dsadasd', '23131231231', 'Enologia', '1º ano', 'sdaddasd');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nome`) VALUES
(7, 'Matemática'),
(8, 'Geografia'),
(9, 'Inglês'),
(10, 'Português'),
(11, 'Espanhol'),
(12, 'Química'),
(13, 'Física'),
(14, 'História'),
(15, 'Sociologia'),
(16, 'Literatura'),
(17, 'Biologia'),
(18, 'Filosofia'),
(19, 'Artes');

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`id`, `nome`) VALUES
(1, 'Informática'),
(2, 'Agropecuária'),
(3, 'Enologia'),
(4, 'Meio Ambiente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `emprestimo`
--

CREATE TABLE `emprestimo` (
  `id` int(11) NOT NULL,
  `data_emprestimo` date NOT NULL,
  `data_devolucao` date NOT NULL,
  `id_aluno` char(12) NOT NULL,
  `id_livro` char(6) NOT NULL,
  `funcionario` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `emprestimo`
--

INSERT INTO `emprestimo` (`id`, `data_emprestimo`, `data_devolucao`, `id_aluno`, `id_livro`, `funcionario`, `status`) VALUES
(60, '2018-11-16', '0000-00-00', '201710040021', 'M1-001', 'admin', 0),
(61, '2018-11-16', '0000-00-00', '201710040019', 'M1-003', 'admin', 1),
(62, '2018-11-17', '0000-00-00', '201710040021', 'M1-006', 'admin', 1),
(63, '2018-11-17', '0000-00-00', '201710040018', 'M1-001', 'admin', 1),
(64, '2018-12-10', '0000-00-00', '201530040016', 'M1-011', 'admin', 1),
(65, '2018-12-10', '0000-00-00', '201940050060', 'M1-012', 'admin', 1),
(66, '2018-12-10', '0000-00-00', '201110030029', 'M1-013', 'admin', 1),
(67, '2018-12-10', '0000-00-00', '201710040022', 'M1-014', 'admin', 1),
(68, '2018-12-10', '0000-00-00', '23131231231', 'M1-015', 'admin', 1),
(69, '2018-12-10', '0000-00-00', '201710040088', 'M1-010', 'admin', 1),
(70, '2018-12-10', '0000-00-00', '201710040020', 'M1-009', 'admin', 1),
(71, '2018-12-10', '0000-00-00', '201710040020', 'M1-008', 'admin', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `exemplar`
--

CREATE TABLE `exemplar` (
  `codigo` char(6) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `isbn` char(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `exemplar`
--

INSERT INTO `exemplar` (`codigo`, `estado`, `isbn`) VALUES
('M1-001', 0, '1234567890987'),
('M1-002', 1, '1234567890987'),
('M1-003', 0, '1234567890987'),
('M1-004', 1, '1234567890987'),
('M1-005', 1, '1234567890987'),
('M1-006', 0, '1234567890987'),
('M1-007', 1, '1234567890987'),
('M1-008', 0, '1234567890987'),
('M1-009', 0, '1234567890987'),
('M1-010', 0, '1234567890987'),
('M1-011', 0, '1234567890987'),
('M1-012', 0, '1234567890987'),
('M1-013', 0, '1234567890987'),
('M1-014', 0, '1234567890987'),
('M1-015', 0, '1234567890987');

-- --------------------------------------------------------

--
-- Estrutura da tabela `livro`
--

CREATE TABLE `livro` (
  `isbn` char(13) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `volume` int(11) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `foto_livro` varchar(50) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `livro`
--

INSERT INTO `livro` (`isbn`, `nome`, `volume`, `autor`, `foto_livro`, `id_categoria`, `quantidade`) VALUES
('1234567890987', 'Livro de Matemática', 1, 'awdwd', 'Jogo-livro-futebol.jpg', 7, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`id`, `nome`) VALUES
(1, '1º ano'),
(2, '1º ano A'),
(3, '1º ano B'),
(4, '2º ano'),
(5, '2º ano A'),
(6, '2º ano B'),
(7, '3º ano'),
(8, '3º ano A'),
(9, '3º ano B');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `senha` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `login`, `senha`) VALUES
(1, 'admin', '$2a$08$Cf1f11ePArKlBJomM0F6a.S0UlqLOqj86iQfgPSVn5cYz0lJGIA22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`matricula`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_aluno` (`id_aluno`),
  ADD KEY `id_livro` (`id_livro`);

--
-- Indexes for table `exemplar`
--
ALTER TABLE `exemplar`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `livro`
--
ALTER TABLE `livro`
  ADD PRIMARY KEY (`isbn`);

--
-- Indexes for table `turma`
--
ALTER TABLE `turma`
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
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `emprestimo`
--
ALTER TABLE `emprestimo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `turma`
--
ALTER TABLE `turma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

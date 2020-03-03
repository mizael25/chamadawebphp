-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 02-Dez-2019 às 22:51
-- Versão do servidor: 10.1.35-MariaDB
-- versão do PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evolucao`
--

-- --------------------------------------------------------
create database evolucao;
use evolucao;
--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `alunoID` int(11) NOT NULL,
  `nomealuno` varchar(255) NOT NULL,
  `datanascimento_aluno` date NOT NULL,
  `imagemaluno` varchar(45) DEFAULT NULL,
  `nivel` int(11) NOT NULL DEFAULT '1',
  `nomeresponsavel` varchar(45) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `email` varchar(50) NOT NULL,
  `endereco` varchar(45) NOT NULL,
  `complemento` varchar(45) DEFAULT NULL,
  `numero` varchar(45) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `estadoID` tinyint(3) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `telefone` varchar(10) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`alunoID`, `nomealuno`, `datanascimento_aluno`, `imagemaluno`, `nivel`, `nomeresponsavel`, `cpf`, `email`, `endereco`, `complemento`, `numero`, `cidade`, `estadoID`, `cep`, `telefone`, `usuario`, `senha`) VALUES
(2, 'Francisco Mizael', '1999-06-10', NULL, 1, 'Francisco Carlos', '700.063.777-35', 'mizael.f@hotmail.com', 'Qa 8 mr 1', 'Rua', '12', 'Planaltina', 9, '73.752-107', '993529420', 'a157', '123456');

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos_turmamodalidade`
--

CREATE TABLE `alunos_turmamodalidade` (
  `alunoturmamodalidadeID` int(11) NOT NULL,
  `turmamodalidadeID` int(11) NOT NULL,
  `alunocod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `alunos_turmamodalidade`
--

INSERT INTO `alunos_turmamodalidade` (`alunoturmamodalidadeID`, `turmamodalidadeID`, `alunocod`) VALUES
(13, 32, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `bilhetes`
--

CREATE TABLE `bilhetes` (
  `bilhetesID` int(11) NOT NULL,
  `nomebilhete` varchar(45) NOT NULL,
  `recado` varchar(255) NOT NULL,
  `arquivo` varchar(45) DEFAULT NULL,
  `data` datetime NOT NULL,
  `usuarioid` int(11) NOT NULL,
  `turma_alunos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `bilhetes`
--

INSERT INTO `bilhetes` (`bilhetesID`, `nomebilhete`, `recado`, `arquivo`, `data`, `usuarioid`, `turma_alunos`) VALUES
(2, 'Não Haverá Aula', 'Não haverá aula no dia 31/12/2018', NULL, '2018-12-13 14:00:00', 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `chamadas`
--

CREATE TABLE `chamadas` (
  `chamadaID` int(11) NOT NULL,
  `alunoturmamodalidade_id` int(11) NOT NULL,
  `dataatual` date NOT NULL,
  `presenca` tinyint(1) DEFAULT '0',
  `desempenho` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `desempenho`
--

CREATE TABLE `desempenho` (
  `desempenhoID` int(11) NOT NULL,
  `nomedesempenho` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `desempenho`
--

INSERT INTO `desempenho` (`desempenhoID`, `nomedesempenho`) VALUES
(1, 'Bom'),
(2, 'Muito Bom'),
(3, 'Ótimo'),
(4, 'Excelente'),
(5, 'Perfeito'),
(6, 'Não descrito');

-- --------------------------------------------------------

--
-- Estrutura da tabela `diasemana`
--

CREATE TABLE `diasemana` (
  `diaID` int(11) NOT NULL,
  `dia` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `diasemana`
--

INSERT INTO `diasemana` (`diaID`, `dia`) VALUES
(1, 'Segunda'),
(2, 'Terça'),
(3, 'Quarta'),
(4, 'Quinta'),
(5, 'Sexta'),
(6, 'Sábado'),
(7, 'Domingo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estados`
--

CREATE TABLE `estados` (
  `estadoID` tinyint(3) NOT NULL,
  `nomeestado` char(20) NOT NULL DEFAULT '0',
  `sigla` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estados`
--

INSERT INTO `estados` (`estadoID`, `nomeestado`, `sigla`) VALUES
(1, 'Acre', 'AC'),
(2, 'Alagoas', 'AL'),
(3, 'Amapá', 'AP'),
(4, 'Amazonas', 'AM'),
(5, 'Bahia', 'BA'),
(6, 'Ceará', 'CE'),
(7, 'Distrito Federal', 'DF'),
(8, 'Espírito Santo', 'ES'),
(9, 'Goiás', 'GO'),
(10, 'Maranhão', 'MA'),
(11, 'Mato Grosso', 'MT'),
(12, 'Mato Grosso do Sul', 'MS'),
(13, 'Minas Gerais', 'MG'),
(14, 'Pará', 'PA'),
(15, 'Paraíba', 'PB'),
(16, 'Paraná', 'PR'),
(17, 'Pernambuco', 'PE'),
(18, 'Piauí', 'PI'),
(19, 'RG do Norte', 'RN'),
(20, 'RG do Sul', 'RS'),
(21, 'Rio de Janeiro', 'RJ'),
(22, 'Rondônia', 'RO'),
(23, 'Roraima', 'RA'),
(24, 'Santa Catarina', 'SC'),
(25, 'São Paulo', 'SP');

-- --------------------------------------------------------

--
-- Estrutura da tabela `horarios`
--

CREATE TABLE `horarios` (
  `horarioid` int(11) NOT NULL,
  `horarioinicial` time NOT NULL,
  `horariofinal` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `horarios`
--

INSERT INTO `horarios` (`horarioid`, `horarioinicial`, `horariofinal`) VALUES
(1, '14:00:00', '16:00:00'),
(2, '16:00:00', '18:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modalidades`
--

CREATE TABLE `modalidades` (
  `modalidadeID` int(11) NOT NULL,
  `nomemodalidade` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `modalidades`
--

INSERT INTO `modalidades` (`modalidadeID`, `nomemodalidade`) VALUES
(1, 'Futsal'),
(2, 'Basquete');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modalidadesalunos`
--

CREATE TABLE `modalidadesalunos` (
  `modalidadesalunosID` int(11) NOT NULL,
  `alunoid` int(11) NOT NULL,
  `modalidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `modalidadesalunos`
--

INSERT INTO `modalidadesalunos` (`modalidadesalunosID`, `alunoid`, `modalidade`) VALUES
(1, 2, 2),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `niveis`
--

CREATE TABLE `niveis` (
  `nivelID` int(11) NOT NULL,
  `nomenivel` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `niveis`
--

INSERT INTO `niveis` (`nivelID`, `nomenivel`) VALUES
(1, 'user'),
(2, 'teacher'),
(3, 'professional'),
(4, 'master');

-- --------------------------------------------------------

--
-- Estrutura da tabela `professores`
--

CREATE TABLE `professores` (
  `professorID` int(11) NOT NULL,
  `nomeprofessor` varchar(45) NOT NULL,
  `datanascimento` date NOT NULL,
  `imagemprofessor` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `nivel` int(11) DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `professores`
--

INSERT INTO `professores` (`professorID`, `nomeprofessor`, `datanascimento`, `imagemprofessor`, `email`, `usuario`, `senha`, `nivel`) VALUES
(1, 'Raman', '1980-05-07', NULL, 'raman.fk@hotmail.com', 'raman', '123456789', 2),
(2, 'Cristiano Silva', '1990-11-11', NULL, 'cris.ronaldo@gmail.com', 'cris', '195980', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turmamodalidades`
--

CREATE TABLE `turmamodalidades` (
  `turmamodalidadesID` int(11) NOT NULL,
  `turmaid` int(11) NOT NULL,
  `modalidadeid` int(11) NOT NULL,
  `professorid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `turmamodalidades`
--

INSERT INTO `turmamodalidades` (`turmamodalidadesID`, `turmaid`, `modalidadeid`, `professorid`) VALUES
(1, 13, 1, 1),
(30, 5, 1, 1),
(31, 7, 2, 1),
(32, 1, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `turmas`
--

CREATE TABLE `turmas` (
  `turmaID` int(11) NOT NULL,
  `horario` int(11) NOT NULL,
  `diasemana` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `turmas`
--

INSERT INTO `turmas` (`turmaID`, `horario`, `diasemana`) VALUES
(1, 1, 1),
(2, 1, 5),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 2),
(10, 2, 3),
(11, 1, 6),
(12, 2, 6),
(13, 2, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `usuarioID` int(11) NOT NULL,
  `user` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `nivelID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`usuarioID`, `user`, `password`, `nivelID`) VALUES
(1, 'master', '1006', 4),
(2, 'ak', '1234', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`alunoID`),
  ADD KEY `alunos_niveis_nivel_id_idx` (`nivel`),
  ADD KEY `alunos_estados_estado_id_idx` (`estadoID`);

--
-- Indexes for table `alunos_turmamodalidade`
--
ALTER TABLE `alunos_turmamodalidade`
  ADD PRIMARY KEY (`alunoturmamodalidadeID`),
  ADD KEY `alunos_turmamodalidade_alunos_aluno_id` (`alunocod`),
  ADD KEY `alunosturmamodalidade_turmamodalidade_tm_ID` (`turmamodalidadeID`);

--
-- Indexes for table `bilhetes`
--
ALTER TABLE `bilhetes`
  ADD PRIMARY KEY (`bilhetesID`),
  ADD KEY `bilhetes_usuarios_usuario_id_idx` (`usuarioid`),
  ADD KEY `bilhetes_turma_alunos_idx` (`turma_alunos`);

--
-- Indexes for table `chamadas`
--
ALTER TABLE `chamadas`
  ADD PRIMARY KEY (`chamadaID`),
  ADD KEY `chamadas_desempenho_desempenho_id_idx` (`desempenho`),
  ADD KEY `chamadas_alunoturmamodalidades_atm_id` (`alunoturmamodalidade_id`);

--
-- Indexes for table `desempenho`
--
ALTER TABLE `desempenho`
  ADD PRIMARY KEY (`desempenhoID`);

--
-- Indexes for table `diasemana`
--
ALTER TABLE `diasemana`
  ADD PRIMARY KEY (`diaID`);

--
-- Indexes for table `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`estadoID`);

--
-- Indexes for table `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`horarioid`);

--
-- Indexes for table `modalidades`
--
ALTER TABLE `modalidades`
  ADD PRIMARY KEY (`modalidadeID`);

--
-- Indexes for table `modalidadesalunos`
--
ALTER TABLE `modalidadesalunos`
  ADD PRIMARY KEY (`modalidadesalunosID`),
  ADD KEY `modalidadesalunos_alunos_aluno_id_idx` (`alunoid`),
  ADD KEY `modalidadesalunos_modalidades_modalidade_id_idx` (`modalidade`);

--
-- Indexes for table `niveis`
--
ALTER TABLE `niveis`
  ADD PRIMARY KEY (`nivelID`);

--
-- Indexes for table `professores`
--
ALTER TABLE `professores`
  ADD PRIMARY KEY (`professorID`),
  ADD KEY `professores_niveis_nivel_id_idx` (`nivel`);

--
-- Indexes for table `turmamodalidades`
--
ALTER TABLE `turmamodalidades`
  ADD PRIMARY KEY (`turmamodalidadesID`),
  ADD KEY `turmamodalidades_turmas_turma_id_idx` (`turmaid`),
  ADD KEY `turmamodalidades_modalidades_modalidade_id_idx` (`modalidadeid`),
  ADD KEY `turmamodalidades_professores_professor_id_idx` (`professorid`);

--
-- Indexes for table `turmas`
--
ALTER TABLE `turmas`
  ADD PRIMARY KEY (`turmaID`),
  ADD KEY `turmas_diasemana_dia_id_idx` (`diasemana`),
  ADD KEY `turmas_horarios_horario_id_idx` (`horario`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuarioID`),
  ADD KEY `usuarios_niveis_nivel_id_idx` (`nivelID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alunos`
--
ALTER TABLE `alunos`
  MODIFY `alunoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `alunos_turmamodalidade`
--
ALTER TABLE `alunos_turmamodalidade`
  MODIFY `alunoturmamodalidadeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `bilhetes`
--
ALTER TABLE `bilhetes`
  MODIFY `bilhetesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chamadas`
--
ALTER TABLE `chamadas`
  MODIFY `chamadaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `desempenho`
--
ALTER TABLE `desempenho`
  MODIFY `desempenhoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `diasemana`
--
ALTER TABLE `diasemana`
  MODIFY `diaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `estados`
--
ALTER TABLE `estados`
  MODIFY `estadoID` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `horarios`
--
ALTER TABLE `horarios`
  MODIFY `horarioid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `modalidades`
--
ALTER TABLE `modalidades`
  MODIFY `modalidadeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `modalidadesalunos`
--
ALTER TABLE `modalidadesalunos`
  MODIFY `modalidadesalunosID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `niveis`
--
ALTER TABLE `niveis`
  MODIFY `nivelID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `professores`
--
ALTER TABLE `professores`
  MODIFY `professorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `turmamodalidades`
--
ALTER TABLE `turmamodalidades`
  MODIFY `turmamodalidadesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `turmas`
--
ALTER TABLE `turmas`
  MODIFY `turmaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuarioID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `alunos`
--
ALTER TABLE `alunos`
  ADD CONSTRAINT `alunos_estados_estado_id` FOREIGN KEY (`estadoID`) REFERENCES `estados` (`estadoID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `alunos_niveis_nivel_id` FOREIGN KEY (`nivel`) REFERENCES `niveis` (`nivelID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `alunos_turmamodalidade`
--
ALTER TABLE `alunos_turmamodalidade`
  ADD CONSTRAINT `alunos_turmamodalidade_alunos_aluno_id` FOREIGN KEY (`alunocod`) REFERENCES `alunos` (`alunoID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alunosturmamodalidade_turmamodalidade_tm_ID` FOREIGN KEY (`turmamodalidadeID`) REFERENCES `turmamodalidades` (`turmamodalidadesID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `bilhetes`
--
ALTER TABLE `bilhetes`
  ADD CONSTRAINT `bilhetes_turma_modalidades` FOREIGN KEY (`turma_alunos`) REFERENCES `turmamodalidades` (`turmamodalidadesID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bilhetes_usuarios_usuario_id` FOREIGN KEY (`usuarioid`) REFERENCES `usuarios` (`usuarioID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `chamadas`
--
ALTER TABLE `chamadas`
  ADD CONSTRAINT `chamadas_alunoturmamodalidades_atm_id` FOREIGN KEY (`alunoturmamodalidade_id`) REFERENCES `alunos_turmamodalidade` (`alunoturmamodalidadeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chamadas_desempenho_desempenho_id` FOREIGN KEY (`desempenho`) REFERENCES `desempenho` (`desempenhoID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `modalidadesalunos`
--
ALTER TABLE `modalidadesalunos`
  ADD CONSTRAINT `modalidadesalunos_alunos_aluno_id` FOREIGN KEY (`alunoid`) REFERENCES `alunos` (`alunoID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `modalidadesalunos_modalidades_modalidade_id` FOREIGN KEY (`modalidade`) REFERENCES `modalidades` (`modalidadeID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `professores`
--
ALTER TABLE `professores`
  ADD CONSTRAINT `professores_niveis_nivel_id` FOREIGN KEY (`nivel`) REFERENCES `niveis` (`nivelID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `turmamodalidades`
--
ALTER TABLE `turmamodalidades`
  ADD CONSTRAINT `turmamodalidades_modalidades_modalidade_id` FOREIGN KEY (`modalidadeid`) REFERENCES `modalidades` (`modalidadeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `turmamodalidades_professores_professor_id` FOREIGN KEY (`professorid`) REFERENCES `professores` (`professorID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `turmamodalidades_turmas_turma_id` FOREIGN KEY (`turmaid`) REFERENCES `turmas` (`turmaID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `turmas`
--
ALTER TABLE `turmas`
  ADD CONSTRAINT `turmas_diasemana_dia_id` FOREIGN KEY (`diasemana`) REFERENCES `diasemana` (`diaID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `turmas_horarios_horario_id` FOREIGN KEY (`horario`) REFERENCES `horarios` (`horarioid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_niveis_nivel_id` FOREIGN KEY (`nivelID`) REFERENCES `niveis` (`nivelID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

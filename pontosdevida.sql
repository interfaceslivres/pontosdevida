-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 03/10/2019 às 13:57
-- Versão do servidor: 5.7.27-0ubuntu0.16.04.1
-- Versão do PHP: 7.0.33-0ubuntu0.16.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `pontosdevida`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `alocacao`
--

CREATE TABLE `alocacao` (
  `usuario` varchar(50) NOT NULL,
  `id_cla` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `amigo`
--

CREATE TABLE `amigo` (
  `usuario1` varchar(50) NOT NULL,
  `usuario2` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cla`
--

CREATE TABLE `cla` (
  `nome` varchar(50) NOT NULL,
  `id_cla` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `lider` varchar(50) NOT NULL,
  `caminho_foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cla_conquista`
--

CREATE TABLE `cla_conquista` (
  `id_cla` int(11) NOT NULL,
  `conquista` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `conquista`
--

CREATE TABLE `conquista` (
  `nome` varchar(50) NOT NULL,
  `icone` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `doacao`
--

CREATE TABLE `doacao` (
  `id_doacao` int(11) NOT NULL,
  `doador` varchar(50) NOT NULL,
  `id_local` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `figurinha`
--

CREATE TABLE `figurinha` (
  `id_figurinha` int(11) NOT NULL,
  `posicao` int(11) NOT NULL,
  `tabuleiro` int(11) NOT NULL,
  `fixa` tinyint(1) NOT NULL,
  `dono` varchar(50) NOT NULL,
  `template` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `figurinha`
--

INSERT INTO `figurinha` (`id_figurinha`, `posicao`, `tabuleiro`, `fixa`, `dono`, `template`) VALUES
(1, 6, 1, 1, 'paulohsms', 'Nosferaaato!?'),
(2, 1, 1, 1, 'paulohsms', 'educacao'),
(3, 14, 1, 1, 'paulohsms', 'inspiracao'),
(4, 8, 1, 0, 'paulohsms', 'inspiracao'),
(5, 9, 1, 0, 'paulohsms', 'informacao');

-- --------------------------------------------------------

--
-- Estrutura para tabela `figurinha_cla`
--

CREATE TABLE `figurinha_cla` (
  `id_figcla` int(11) NOT NULL,
  `template` varchar(50) NOT NULL,
  `id_cla` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `local`
--

CREATE TABLE `local` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagem`
--

CREATE TABLE `mensagem` (
  `id_mensagem` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `texto` varchar(255) NOT NULL,
  `remetente` varchar(50) NOT NULL,
  `id_cla` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `notifica`
--

CREATE TABLE `notifica` (
  `usuario` varchar(50) NOT NULL,
  `id_not` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `template`
--

CREATE TABLE `template` (
  `nome` varchar(50) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `template`
--

INSERT INTO `template` (`nome`, `descricao`, `imagem`, `tipo`) VALUES
('educacao', 'dasdasdasdasdasdasdas!', '03gaspar.jpg', 5),
('informacao', 'Depois de doar sangue, é crucial que você aumente o volume de líquidos ingeridos, sobretudo nas primeiras 24 horas. Capriche na ingestão de água mineral ou outra bebida de sua preferência para auxiliar na reposição do volume perdido na doação!', '03water.jpg', 3),
('inspiracao', 'uuuuuuuuuuu uuuuuuuuuuuu uuuuuuuu', '03obsequio.jpg', 9),
('Nosferaaato!?', 'Os vampiros da Saga Crepúsculo precisam de sangue para sobreviver, e os pacientes dos hospitais locais também. Seja você do time Jacob ou do time Edward, todos os fãs concordam sobre a importância de salvar vidas!', '03vampirinho.jpg', 16);

-- --------------------------------------------------------

--
-- Estrutura para tabela `template_not`
--

CREATE TABLE `template_not` (
  `id_not` int(11) NOT NULL,
  `texto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `login_usuario` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `oauth` tinyint(1) NOT NULL,
  `smtoggle` tinyint(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `biografia` varchar(255) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `privacidade` tinyint(1) NOT NULL,
  `tipo_sangue` varchar(20) DEFAULT NULL,
  `nivel` int(11) NOT NULL,
  `tempo_retorno` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `usuario`
--

INSERT INTO `usuario` (`login_usuario`, `senha`, `oauth`, `smtoggle`, `email`, `nome`, `biografia`, `data_nascimento`, `privacidade`, `tipo_sangue`, `nivel`, `tempo_retorno`, `foto`) VALUES
('', '827ccb0eea8a706c4c34a16891f84e7b', 0, 0, 'paulo', 'Paulo Henrique Serrano', '', '1991-01-01', 0, '', 10, NULL, 'img/cachorro.jpg'),
('mateusdanton4299', '202cb962ac59075b964b07152d234b70', 0, 0, 'm@m.com', 'mateus', 'teste', '1993-02-19', 0, 'o-', 10, NULL, NULL),
('paulohsms', '7137f2f848759cf73efdb4ced1edc119', 0, 0, 'paulo@gmail.com', 'Paulo Henrique Serrano', '', '1991-01-01', 0, '', 10, NULL, 'img/cachorro.jpg');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `alocacao`
--
ALTER TABLE `alocacao`
  ADD PRIMARY KEY (`usuario`),
  ADD KEY `id_cla` (`id_cla`);

--
-- Índices de tabela `amigo`
--
ALTER TABLE `amigo`
  ADD PRIMARY KEY (`usuario1`,`usuario2`),
  ADD KEY `usuario2` (`usuario2`);

--
-- Índices de tabela `cla`
--
ALTER TABLE `cla`
  ADD PRIMARY KEY (`id_cla`),
  ADD KEY `lider` (`lider`);

--
-- Índices de tabela `cla_conquista`
--
ALTER TABLE `cla_conquista`
  ADD PRIMARY KEY (`id_cla`,`conquista`),
  ADD KEY `conquista` (`conquista`);

--
-- Índices de tabela `conquista`
--
ALTER TABLE `conquista`
  ADD PRIMARY KEY (`nome`);

--
-- Índices de tabela `doacao`
--
ALTER TABLE `doacao`
  ADD PRIMARY KEY (`id_doacao`),
  ADD KEY `doador` (`doador`),
  ADD KEY `id_local` (`id_local`);

--
-- Índices de tabela `figurinha`
--
ALTER TABLE `figurinha`
  ADD PRIMARY KEY (`id_figurinha`),
  ADD KEY `dono` (`dono`),
  ADD KEY `template` (`template`);

--
-- Índices de tabela `figurinha_cla`
--
ALTER TABLE `figurinha_cla`
  ADD PRIMARY KEY (`id_figcla`),
  ADD KEY `template` (`template`),
  ADD KEY `id_cla` (`id_cla`);

--
-- Índices de tabela `local`
--
ALTER TABLE `local`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `mensagem`
--
ALTER TABLE `mensagem`
  ADD PRIMARY KEY (`id_mensagem`),
  ADD KEY `remetente` (`remetente`),
  ADD KEY `id_cla` (`id_cla`);

--
-- Índices de tabela `notifica`
--
ALTER TABLE `notifica`
  ADD KEY `usuario` (`usuario`);

--
-- Índices de tabela `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`nome`);

--
-- Índices de tabela `template_not`
--
ALTER TABLE `template_not`
  ADD PRIMARY KEY (`id_not`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`login_usuario`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `cla`
--
ALTER TABLE `cla`
  MODIFY `id_cla` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `doacao`
--
ALTER TABLE `doacao`
  MODIFY `id_doacao` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `figurinha`
--
ALTER TABLE `figurinha`
  MODIFY `id_figurinha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de tabela `figurinha_cla`
--
ALTER TABLE `figurinha_cla`
  MODIFY `id_figcla` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `local`
--
ALTER TABLE `local`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `mensagem`
--
ALTER TABLE `mensagem`
  MODIFY `id_mensagem` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `template_not`
--
ALTER TABLE `template_not`
  MODIFY `id_not` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `alocacao`
--
ALTER TABLE `alocacao`
  ADD CONSTRAINT `alocacao_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`login_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `alocacao_ibfk_2` FOREIGN KEY (`id_cla`) REFERENCES `cla` (`id_cla`) ON DELETE CASCADE;

--
-- Restrições para tabelas `amigo`
--
ALTER TABLE `amigo`
  ADD CONSTRAINT `amigo_ibfk_1` FOREIGN KEY (`usuario1`) REFERENCES `usuario` (`login_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `amigo_ibfk_2` FOREIGN KEY (`usuario2`) REFERENCES `usuario` (`login_usuario`) ON DELETE CASCADE;

--
-- Restrições para tabelas `cla`
--
ALTER TABLE `cla`
  ADD CONSTRAINT `cla_ibfk_1` FOREIGN KEY (`lider`) REFERENCES `usuario` (`login_usuario`) ON DELETE CASCADE;

--
-- Restrições para tabelas `cla_conquista`
--
ALTER TABLE `cla_conquista`
  ADD CONSTRAINT `cla_conquista_ibfk_1` FOREIGN KEY (`id_cla`) REFERENCES `cla` (`id_cla`) ON DELETE CASCADE,
  ADD CONSTRAINT `cla_conquista_ibfk_2` FOREIGN KEY (`conquista`) REFERENCES `conquista` (`nome`) ON DELETE CASCADE;

--
-- Restrições para tabelas `doacao`
--
ALTER TABLE `doacao`
  ADD CONSTRAINT `doacao_ibfk_1` FOREIGN KEY (`doador`) REFERENCES `usuario` (`login_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `doacao_ibfk_2` FOREIGN KEY (`id_local`) REFERENCES `local` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `figurinha`
--
ALTER TABLE `figurinha`
  ADD CONSTRAINT `figurinha_ibfk_1` FOREIGN KEY (`dono`) REFERENCES `usuario` (`login_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `figurinha_ibfk_2` FOREIGN KEY (`template`) REFERENCES `template` (`nome`) ON DELETE CASCADE;

--
-- Restrições para tabelas `figurinha_cla`
--
ALTER TABLE `figurinha_cla`
  ADD CONSTRAINT `figurinha_cla_ibfk_1` FOREIGN KEY (`template`) REFERENCES `template` (`nome`) ON DELETE CASCADE,
  ADD CONSTRAINT `figurinha_cla_ibfk_2` FOREIGN KEY (`id_cla`) REFERENCES `cla` (`id_cla`) ON DELETE CASCADE;

--
-- Restrições para tabelas `mensagem`
--
ALTER TABLE `mensagem`
  ADD CONSTRAINT `mensagem_ibfk_1` FOREIGN KEY (`remetente`) REFERENCES `usuario` (`login_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `mensagem_ibfk_2` FOREIGN KEY (`id_cla`) REFERENCES `cla` (`id_cla`) ON DELETE CASCADE;

--
-- Restrições para tabelas `notifica`
--
ALTER TABLE `notifica`
  ADD CONSTRAINT `notifica_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`login_usuario`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

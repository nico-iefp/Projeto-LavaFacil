-- --------------------------------------------------------
-- Anfitrião:                    127.0.0.1
-- Versão do servidor:           8.0.46 - MySQL Community Server - GPL
-- SO do servidor:               Win64
-- HeidiSQL Versão:              12.17.0.7270
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- A despejar estrutura da base de dados para lavafacil
CREATE DATABASE IF NOT EXISTS `lavafacil` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `lavafacil`;

-- A despejar estrutura para tabela lavafacil.admins
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `criado_em` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- A despejar dados para tabela lavafacil.admins: ~1 rows (aproximadamente)
INSERT INTO `admins` (`id`, `nome`, `email`, `password`, `criado_em`) VALUES
	(1, 'adminlavafacil', 'adminlavafacil@gmail.com', '$2y$10$IEB2YU/twAkj2PBd26Gy7u8.d1uyWz/23mHNmaEtTYWNgKJJlDAwO', '2026-09-20 22:11:39');

-- A despejar estrutura para tabela lavafacil.agendamentos
CREATE TABLE IF NOT EXISTS `agendamentos` (
  `id_agendamento` int NOT NULL AUTO_INCREMENT,
  `id_cliente` int DEFAULT NULL,
  `tipo_servico` int DEFAULT NULL,
  `estado_agendamento` int DEFAULT NULL,
  `colaborador` int DEFAULT NULL,
  `valor` decimal(8,2) DEFAULT NULL,
  `peso` decimal(6,2) DEFAULT NULL,
  `local` varchar(150) DEFAULT NULL,
  `data_hora` datetime DEFAULT NULL,
  `descricao` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_agendamento`),
  KEY `tipoServico` (`tipo_servico`),
  KEY `estadoAgendamento` (`estado_agendamento`),
  KEY `fk_agendamento_cliente` (`id_cliente`),
  KEY `fk_agendamentos_colaborador` (`colaborador`),
  CONSTRAINT `estadoAgendamento` FOREIGN KEY (`estado_agendamento`) REFERENCES `estados_pedidos` (`id_estado`),
  CONSTRAINT `fk_agendamento_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  CONSTRAINT `fk_agendamentos_colaborador` FOREIGN KEY (`colaborador`) REFERENCES `colaboradores` (`id_colaborador`),
  CONSTRAINT `tipoServico` FOREIGN KEY (`tipo_servico`) REFERENCES `tipos_servicos` (`cod_tiposervico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela lavafacil.agendamentos: ~0 rows (aproximadamente)

-- A despejar estrutura para tabela lavafacil.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `num_telefone` varchar(20) DEFAULT NULL,
  `morada_1` varchar(150) DEFAULT NULL,
  `morada_2` varchar(150) DEFAULT NULL,
  `morada_3` varchar(150) DEFAULT NULL,
  `qtd_pedidos` int DEFAULT NULL,
  `total_gasto` float DEFAULT NULL,
  `tipo_cliente` int DEFAULT NULL,
  `observacoes` text,
  `pontos_fidelidade` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tipo_cliente` (`tipo_cliente`),
  CONSTRAINT `tipoCliente` FOREIGN KEY (`tipo_cliente`) REFERENCES `tipo_cliente` (`cod_tipocliente`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela lavafacil.clientes: ~36 rows (aproximadamente)
INSERT INTO `clientes` (`id`, `nome`, `email`, `password`, `num_telefone`, `morada_1`, `morada_2`, `morada_3`, `qtd_pedidos`, `total_gasto`, `tipo_cliente`, `observacoes`, `pontos_fidelidade`) VALUES
	(1, 'Ana Pinto', 'ana.pinto@email.pt ', '81dc9bdb52d04dc20036dbd8313ed055', '+351 210 601 001 ', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
	(2, 'Maria Joana', 'maria.joana@email.pt ', NULL, '+351 210 601 002 ', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
	(3, 'Roberto Ferreira', 'roberto.ferreira@email.pt ', NULL, '+351 210 601 003 ', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
	(4, 'Joana Ferreira  ', 'joana.ferreira@email.pt ', NULL, '+351 210 601 004', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
	(5, 'Lar Quinta da Ponte', 'geral@larquintadaponte.pt', NULL, '+351 210 601 005', NULL, NULL, NULL, NULL, NULL, 2, NULL, 0),
	(6, 'Restaurante “A Ribeira”  ', 'reservas@aribeira.pt', NULL, '+351 210 601 006', NULL, NULL, NULL, NULL, NULL, 2, NULL, 0),
	(7, 'Restaurante Almansor', 'contacto@restaurantealmansor.pt', NULL, '+351 210 601 009', NULL, NULL, NULL, NULL, NULL, 2, NULL, 0),
	(8, 'Secade Beauty, Lda.  ', 'geral@secadebeauty.pt', NULL, '+351 210 601 049', NULL, NULL, NULL, NULL, NULL, 2, NULL, 0),
	(9, 'Hélia Tavares  ', 'helia.tavares@email.pt', NULL, '+351 210 601 010', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
	(10, 'Cátia Ferreira', 'catia.ferreira@email.pt', NULL, '+351 210 601 011', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
	(11, 'Lurdes Pinguincha', 'lurdes.pinguincha@email.pt', NULL, '+351 210 601 012', NULL, NULL, NULL, NULL, NULL, 1, 'Prefere lavagem com amaciador orgânico.', 12),
	(12, 'Gustavo Almeida', 'gustavo.almeida@email.pt', NULL, '+351 210 601 014', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
	(13, 'Afonso Henriques', 'afonso.henriques@email.pt', NULL, '+351 210 601 015', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
	(14, 'Gonçalo Medronheira ', 'goncalo.medronheira@email.pt', NULL, '+351 210 601 016', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
	(15, 'Tiago Carriço', 'tiago.carrico@email.pt', NULL, '+351 210 601 017', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
	(16, 'Filipe Correia ', 'filipe.correia@email.pt', NULL, '+351 210 601 018', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
	(17, 'Lara Silva', 'lara.silva@email.pt', NULL, '+351 210 601 019', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
	(18, 'Leonor Lopes ', 'leonor.lopes@email.pt', NULL, '+351 210 601 020', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
	(19, 'Júlio Fonseca', 'julio.fonseca@email.pt', NULL, '+351 210 601 021', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
	(20, 'Heloísa Gonçalves', 'heloisa.goncalves@email.pt', NULL, '+351 210 601 022', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
	(21, 'Joana Matos', 'joana.matos@email.pt', NULL, '+351 210 601 023', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
	(22, 'Ana Murteira', 'ana.murteira@email.pt', NULL, '+351 210 601 024', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
	(23, 'Lar O Pequenino', 'geral@laropequenino.pt', NULL, '+351 210 601 026', NULL, NULL, NULL, NULL, NULL, 2, NULL, 0),
	(24, 'Filipa Galinha ', 'filipa.galinha@email.pt', NULL, '+351 210 601 028', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
	(25, 'João Mendes', 'joao.mendes@email.pt', NULL, '+351 210 601 029', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
	(26, 'Luís Trincheira', 'luis.trincheira@email.pt', NULL, '+351 210 601 030', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
	(27, 'Joana Guerreiro', 'joana.guerreiro@email.pt', NULL, '+351 210 601 031', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
	(28, 'Gonçalo Silva', 'goncalo.silva@email.pt', NULL, '+351 210 601 032', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
	(29, 'Vitória Figueiredo', 'vitoria.figueiredo@email.pt', NULL, '+351 210 601 033', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
	(30, 'Luís Fernandes', 'luis.fernandes@email.pt', NULL, '+351 210 601 034', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
	(31, 'Afonso Gonçalves', 'afonso.goncalves@email.pt', NULL, '+351 210 601 035', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
	(32, 'Luís Amaro', 'luis.amaro@email.pt', NULL, '+351 210 601 036', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
	(33, 'Francisco Nogueira', 'francisco.nogueira@email.pt', NULL, '+351 210 601 037', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
	(34, 'João Francisco', 'joao.francisco@email.pt', NULL, '+351 210 601 038', NULL, NULL, NULL, NULL, NULL, 1, NULL, 0),
	(46, 'Nicolas', 'nicolas2026@gmail.com', '$2y$10$X3P7jCS1XUXb8VanRN/WZeooCdHppRqUR3xikptQEg0rnU2Bgo4bW', NULL, NULL, NULL, NULL, 0, 0, 1, NULL, 0),
	(47, 'Tiago', 'tiago2026@gmail.com', '$2y$10$CMgLLgH1RXX2KLSN13tZseKWHu04zZyCLLK9T6rKYQ1/4ijRmTrRq', NULL, NULL, NULL, NULL, 0, 0, 1, NULL, 0);

-- A despejar estrutura para tabela lavafacil.colaboradores
CREATE TABLE IF NOT EXISTS `colaboradores` (
  `id_colaborador` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `n_contribuinte` varchar(12) DEFAULT NULL,
  `funcao` varchar(50) DEFAULT NULL,
  `tipo_contrato` int DEFAULT NULL,
  `ordenado_base` float DEFAULT NULL,
  `valor_hora` float DEFAULT NULL,
  `sub_alimentacao` float DEFAULT NULL,
  `sub_ferias` float DEFAULT NULL,
  `sub_natal` float DEFAULT NULL,
  `val_horasextras` float DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_colaborador`) USING BTREE,
  UNIQUE KEY `email` (`email`),
  KEY `tipo_contrato` (`tipo_contrato`),
  CONSTRAINT `tipoContrato` FOREIGN KEY (`tipo_contrato`) REFERENCES `tipos_contrato` (`id_tipo_contrato`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela lavafacil.colaboradores: ~5 rows (aproximadamente)
INSERT INTO `colaboradores` (`id_colaborador`, `nome`, `n_contribuinte`, `funcao`, `tipo_contrato`, `ordenado_base`, `valor_hora`, `sub_alimentacao`, `sub_ferias`, `sub_natal`, `val_horasextras`, `email`, `password`, `is_admin`) VALUES
	(1, 'Isadora Vênus Albuquerque', '298 541 736', 'Operadora de Lavandaria', 1, 920, 5.31, 5, 920, 920, 6.64, NULL, NULL, 0),
	(2, 'Camila Aurora Machado', '267 904 318', 'Operadora de Lavandaria', 1, 920, 5.31, 5, 920, 920, 6.64, NULL, NULL, 0),
	(3, 'Tiago Miguel Sousa Carvalho', '254 719 683', 'Operador Logístico', 1, 920, 5.31, 5, 920, 920, 6.64, NULL, NULL, 0),
	(4, 'Joana Filipa Cacilhas de Matos', '264 918 537', 'Contabilista Certificada', 2, 0, 0, 0, 0, 0, 0, NULL, NULL, 0),
	(5, 'Ana Carolina Lopes Murteira', '289 743 105', 'Diretora de Recursos Humanos', 2, 0, 0, 0, 0, 0, 0, NULL, NULL, 0);

-- A despejar estrutura para tabela lavafacil.contabilidade_gastos
CREATE TABLE IF NOT EXISTS `contabilidade_gastos` (
  `id_gasto` int NOT NULL AUTO_INCREMENT,
  `mes` int NOT NULL,
  `ano` int NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `tipo_gasto` enum('Fixo','Variável') NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_gasto`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela lavafacil.contabilidade_gastos: ~8 rows (aproximadamente)
INSERT INTO `contabilidade_gastos` (`id_gasto`, `mes`, `ano`, `categoria`, `tipo_gasto`, `valor`) VALUES
	(1, 3, 2026, 'Salários', 'Fixo', 2730.48),
	(2, 3, 2026, 'Água', 'Fixo', 119.20),
	(3, 3, 2026, 'Gasóleo', 'Fixo', 540.00),
	(4, 3, 2026, 'Eletricidade', 'Fixo', 530.00),
	(5, 3, 2026, 'Renda', 'Fixo', 307.00),
	(6, 3, 2026, 'Leasing', 'Fixo', 1505.00),
	(7, 3, 2026, 'Comunicação', 'Fixo', 40.00),
	(8, 3, 2026, 'Custo com Parcerias', 'Fixo', 650.00);

-- A despejar estrutura para tabela lavafacil.estados_pedidos
CREATE TABLE IF NOT EXISTS `estados_pedidos` (
  `id_estado` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_estado`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela lavafacil.estados_pedidos: ~5 rows (aproximadamente)
INSERT INTO `estados_pedidos` (`id_estado`, `descricao`) VALUES
	(1, 'Pendente'),
	(2, 'Aceite'),
	(3, 'Em execução'),
	(4, 'Concluído'),
	(5, 'Cancelado');

-- A despejar estrutura para tabela lavafacil.fornecedores
CREATE TABLE IF NOT EXISTS `fornecedores` (
  `cod_fornecedor` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cod_fornecedor`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela lavafacil.fornecedores: ~0 rows (aproximadamente)

-- A despejar estrutura para tabela lavafacil.locais
CREATE TABLE IF NOT EXISTS `locais` (
  `id_local` int NOT NULL AUTO_INCREMENT,
  `nome_local` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_local`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela lavafacil.locais: ~6 rows (aproximadamente)
INSERT INTO `locais` (`id_local`, `nome_local`) VALUES
	(1, 'Montemor-o-Novo'),
	(2, 'São Cristóvão'),
	(3, 'Arraiolos'),
	(4, 'Escoural'),
	(5, 'Silveiras'),
	(6, 'Lavre');

-- A despejar estrutura para tabela lavafacil.servicos
CREATE TABLE IF NOT EXISTS `servicos` (
  `id_servico` int NOT NULL AUTO_INCREMENT,
  `data_hora_pedido` datetime DEFAULT NULL,
  `data_hora_prevista` datetime DEFAULT NULL,
  `id_cliente` int DEFAULT NULL,
  `nome_cliente` varchar(50) DEFAULT NULL,
  `valor_servico` float DEFAULT NULL,
  `local` varchar(50) DEFAULT NULL,
  `tipo_servico` int DEFAULT NULL,
  `estado` int DEFAULT NULL,
  `colaborador` int DEFAULT NULL,
  `peso` decimal(6,2) DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_servico`),
  KEY `tipo_servico` (`tipo_servico`),
  KEY `estado` (`estado`),
  KEY `colaborador` (`colaborador`),
  CONSTRAINT `colaborador` FOREIGN KEY (`colaborador`) REFERENCES `colaboradores` (`id_colaborador`),
  CONSTRAINT `estado` FOREIGN KEY (`estado`) REFERENCES `estados_pedidos` (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela lavafacil.servicos: ~53 rows (aproximadamente)
INSERT INTO `servicos` (`id_servico`, `data_hora_pedido`, `data_hora_prevista`, `id_cliente`, `nome_cliente`, `valor_servico`, `local`, `tipo_servico`, `estado`, `colaborador`, `peso`, `descricao`) VALUES
	(1, '2026-09-06 19:02:54', '2026-09-06 19:02:54', NULL, 'Cliente Teste Dinâmico', 150, 'Montemor-o-Novo', 1, 4, 1, NULL, NULL),
	(2, '2026-09-06 19:05:18', '2026-09-06 19:05:18', NULL, 'Cliente ', 153, 'Montemor-o-Novo', 1, 3, 2, NULL, NULL),
	(3, '2026-09-06 19:08:19', '2026-09-06 19:08:19', NULL, 'Cliente ', 157, 'Montemor-o-Novo', 2, 2, 1, NULL, NULL),
	(4, '2026-09-06 19:14:02', '2026-09-06 19:14:02', NULL, 'Cliente Teste Dinâmico', 150, 'Montemor-o-Novo', 1, 4, 1, NULL, NULL),
	(5, '2026-09-06 19:53:29', '2026-09-06 19:53:31', NULL, 'cliente Francisco', 400, 'Montemor-o-Novo', 1, 4, 1, NULL, NULL),
	(11, '2026-09-09 00:16:29', '2026-09-16 08:00:00', NULL, 'Cliente (agendamento online)', 27.5, 'Montemor-o-Novo', 6, 1, NULL, NULL, NULL),
	(12, '2026-09-09 08:11:24', '2026-09-23 08:00:00', NULL, 'Cliente (agendamento online)', 17.5, 'Montemor-o-Novo', 1, 1, NULL, NULL, NULL),
	(13, '2026-09-09 08:12:59', '2026-09-10 08:00:00', NULL, 'Cliente (agendamento online)', 17.5, 'Montemor-o-Novo', 1, 1, NULL, NULL, NULL),
	(14, '2026-09-09 08:14:04', '2026-09-10 15:00:00', NULL, 'Cliente (agendamento online)', 17.5, 'Montemor-o-Novo', 1, 2, NULL, NULL, NULL),
	(15, '2026-09-09 08:14:38', '2026-09-10 15:00:00', NULL, 'Cliente (agendamento online)', 17.5, 'Arraiolos', 1, 1, NULL, NULL, NULL),
	(16, '2026-09-09 08:47:54', '2026-09-25 08:00:00', NULL, 'Cliente (agendamento online)', 165, 'Montemor-o-Novo', 6, 1, NULL, NULL, NULL),
	(17, '2026-09-09 09:00:08', '2026-09-22 08:00:00', NULL, 'Cliente (agendamento online)', 27.5, 'Montemor-o-Novo', 6, 2, NULL, NULL, NULL),
	(18, '2026-09-09 10:23:26', '2026-10-08 08:00:00', NULL, 'Cliente (agendamento online)', 27.5, 'Montemor-o-Novo', 6, 1, NULL, NULL, NULL),
	(19, '2026-09-09 10:55:44', '2026-09-30 08:00:00', NULL, 'Cliente (agendamento online)', 17.5, 'Montemor-o-Novo', 1, 1, NULL, NULL, NULL),
	(20, '2026-09-09 11:09:35', '2026-09-24 08:00:00', NULL, 'Cliente (agendamento online)', 17.5, 'Montemor-o-Novo', 1, 1, NULL, NULL, NULL),
	(21, '2026-09-09 11:16:41', '2026-10-07 08:00:00', NULL, 'Cliente (agendamento online)', 12.5, 'Montemor-o-Novo', 2, 1, NULL, NULL, NULL),
	(22, '2026-09-09 11:16:45', '2026-10-07 08:00:00', NULL, 'Cliente (agendamento online)', 12.5, 'Montemor-o-Novo', 2, 1, NULL, NULL, NULL),
	(23, '2026-09-09 11:29:11', '2026-09-23 08:00:00', NULL, 'Cliente (agendamento online)', 17.5, 'Montemor-o-Novo', 1, 1, NULL, NULL, NULL),
	(24, '2026-09-09 11:35:09', '2026-09-20 08:00:00', NULL, 'Cliente (agendamento online)', 20, 'Montemor-o-Novo', 3, 1, NULL, NULL, NULL),
	(25, '2026-09-09 11:39:41', '2026-09-23 08:00:00', NULL, 'Cliente (agendamento online)', 17.5, 'Montemor-o-Novo', 1, 1, NULL, NULL, NULL),
	(26, '2026-09-10 11:16:20', '2026-09-23 08:00:00', NULL, 'Cliente (agendamento online)', 21, 'Montemor-o-Novo', 1, 1, NULL, NULL, NULL),
	(27, '2026-09-10 18:43:53', '2026-09-23 08:00:00', NULL, 'Cliente (agendamento online)', 19.5, 'Montemor-o-Novo', 1, 1, NULL, NULL, NULL),
	(28, '2026-09-10 18:44:05', '2026-09-23 08:00:00', NULL, 'Cliente (agendamento online)', 19.5, 'Montemor-o-Novo', 1, 1, NULL, NULL, NULL),
	(29, '2026-09-10 19:35:42', '2026-09-11 15:00:00', NULL, 'Cliente (agendamento online)', 28, 'Montemor-o-Novo', 1, 1, NULL, NULL, NULL),
	(30, '2026-09-10 19:35:58', '2026-09-11 15:00:00', NULL, 'Cliente (agendamento online)', 28, 'Montemor-o-Novo', 1, 1, NULL, NULL, NULL),
	(31, '2026-09-10 23:09:43', '2026-09-18 16:00:00', NULL, 'Cliente (agendamento online)', 22.5, 'Santiago do Escoural', 1, 1, NULL, NULL, NULL),
	(32, '2026-09-10 23:09:52', '2026-09-18 16:00:00', NULL, 'Cliente (agendamento online)', 22.5, 'Santiago do Escoural', 1, 1, NULL, NULL, NULL),
	(33, '2026-09-10 23:23:38', '2026-09-25 12:00:00', NULL, 'Cliente (agendamento online)', 24.5, 'Arraiolos', 1, 1, NULL, NULL, NULL),
	(34, '2026-09-10 23:23:46', '2026-09-25 12:00:00', NULL, 'Cliente (agendamento online)', 24.5, 'Arraiolos', 1, 1, NULL, NULL, NULL),
	(35, '2026-09-15 09:30:14', '2026-09-23 10:00:00', NULL, 'Cliente (agendamento online)', 42.5, 'Montemor-o-Novo', 7, 1, NULL, NULL, NULL),
	(36, '2026-09-15 09:30:20', '2026-09-23 10:00:00', NULL, 'Cliente (agendamento online)', 42.5, 'Montemor-o-Novo', 7, 1, NULL, NULL, NULL),
	(37, '2026-09-16 08:51:08', '2026-09-29 08:00:00', NULL, 'Cliente (agendamento online)', 27.5, 'Montemor-o-Novo', 6, 1, NULL, NULL, NULL),
	(38, '2026-09-16 09:30:35', '2026-10-06 08:00:00', NULL, 'Cliente (agendamento online)', 33, 'Montemor-o-Novo', 6, 1, NULL, NULL, NULL),
	(39, '2026-09-16 10:34:31', '2026-09-23 08:00:00', NULL, 'Cliente (agendamento online)', 3.5, 'Montemor-o-Novo', 1, 1, NULL, NULL, NULL),
	(40, '2026-09-16 10:34:51', '2026-09-30 08:00:00', NULL, 'Cliente (agendamento online)', 17.5, 'Montemor-o-Novo', 1, 1, NULL, NULL, NULL),
	(41, '2026-09-21 22:15:11', '2026-09-23 08:00:00', NULL, 'Cliente (agendamento online)', 27.5, 'Montemor-o-Novo', 6, 1, NULL, NULL, NULL),
	(42, '2026-09-21 22:30:18', '2026-10-01 08:00:00', NULL, NULL, 27.5, 'Montemor-o-Novo', 6, 1, NULL, 5.00, 'Roupa: Normal'),
	(43, '2026-09-21 22:30:19', '2026-10-01 08:00:00', NULL, NULL, 27.5, 'Montemor-o-Novo', 6, 1, NULL, 5.00, 'Roupa: Normal'),
	(44, '2026-09-21 22:30:19', '2026-10-01 08:00:00', NULL, NULL, 27.5, 'Montemor-o-Novo', 6, 1, NULL, 5.00, 'Roupa: Normal'),
	(45, '2026-09-21 22:30:20', '2026-10-01 08:00:00', NULL, NULL, 27.5, 'Montemor-o-Novo', 6, 1, NULL, 5.00, 'Roupa: Normal'),
	(46, '2026-09-21 23:10:57', '2026-10-02 08:00:00', NULL, 'Cliente (agendamento online)', 42.5, 'Montemor-o-Novo', 7, 1, NULL, NULL, NULL),
	(47, '2026-09-22 08:27:09', '2026-09-23 08:00:00', NULL, 'Cliente (agendamento online)', 20, 'Montemor-o-Novo', 3, 1, NULL, NULL, NULL),
	(48, '2026-09-22 08:27:12', '2026-09-23 08:00:00', NULL, 'Cliente (agendamento online)', 20, 'Montemor-o-Novo', 3, 1, NULL, NULL, NULL),
	(49, '2026-09-22 08:38:31', '2026-10-09 08:00:00', NULL, 'Cliente (agendamento online)', 20, 'Montemor-o-Novo', 3, 1, NULL, NULL, NULL),
	(50, '2026-09-22 09:16:10', '2026-10-28 16:00:00', NULL, 'Cliente (agendamento online)', 27.5, 'Montemor-o-Novo', 6, 1, NULL, NULL, NULL),
	(51, '2026-09-22 09:16:12', '2026-10-28 16:00:00', NULL, 'Cliente (agendamento online)', 27.5, 'Montemor-o-Novo', 6, 1, NULL, NULL, NULL),
	(52, '2026-09-22 09:16:37', '2026-10-07 08:00:00', NULL, 'Cliente (agendamento online)', 42.5, 'Montemor-o-Novo', 7, 1, NULL, NULL, NULL),
	(53, '2026-09-22 09:18:22', '2026-10-01 08:00:00', NULL, 'Cliente (agendamento online)', 17.5, 'Montemor-o-Novo', 1, 1, NULL, NULL, NULL),
	(54, '2026-09-22 09:23:08', '2026-09-24 08:00:00', NULL, 'Cliente (agendamento online)', 27.5, 'Montemor-o-Novo', 6, 1, NULL, NULL, NULL),
	(55, '2026-09-22 09:23:54', '2026-09-30 08:00:00', NULL, 'Cliente (agendamento online)', 17.5, 'Montemor-o-Novo', 1, 1, NULL, NULL, NULL),
	(56, '2026-09-22 09:44:33', '2026-09-23 08:00:00', NULL, 'Cliente (agendamento online)', 17.5, 'Montemor-o-Novo', 1, 1, NULL, NULL, NULL),
	(57, '2026-09-22 21:17:54', '2026-09-23 08:00:00', NULL, 'Cliente (agendamento online)', 32.5, 'Montemor-o-Novo', 6, 1, NULL, NULL, NULL),
	(58, '2026-09-22 21:20:33', '2026-09-24 08:00:00', NULL, 'Cliente (agendamento online)', 32.5, 'Montemor-o-Novo', 6, 1, NULL, NULL, NULL);

-- A despejar estrutura para tabela lavafacil.tipo_cliente
CREATE TABLE IF NOT EXISTS `tipo_cliente` (
  `cod_tipocliente` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cod_tipocliente`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela lavafacil.tipo_cliente: ~2 rows (aproximadamente)
INSERT INTO `tipo_cliente` (`cod_tipocliente`, `descricao`) VALUES
	(1, 'Particular'),
	(2, 'Empresa');

-- A despejar estrutura para tabela lavafacil.tipo_entrega
CREATE TABLE IF NOT EXISTS `tipo_entrega` (
  `cod_tipoentrega` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cod_tipoentrega`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela lavafacil.tipo_entrega: ~0 rows (aproximadamente)

-- A despejar estrutura para tabela lavafacil.tipos_contrato
CREATE TABLE IF NOT EXISTS `tipos_contrato` (
  `id_tipo_contrato` int NOT NULL,
  `descricao` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_tipo_contrato`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela lavafacil.tipos_contrato: ~2 rows (aproximadamente)
INSERT INTO `tipos_contrato` (`id_tipo_contrato`, `descricao`) VALUES
	(1, 'Contrato Sem Termo'),
	(2, 'Cargo Estatutário');

-- A despejar estrutura para tabela lavafacil.tipos_servicos
CREATE TABLE IF NOT EXISTS `tipos_servicos` (
  `cod_tiposervico` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cod_tiposervico`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela lavafacil.tipos_servicos: ~8 rows (aproximadamente)
INSERT INTO `tipos_servicos` (`cod_tiposervico`, `descricao`) VALUES
	(1, 'Lavagem'),
	(2, 'Secagem'),
	(3, 'Engomadoria'),
	(6, 'Pack Lavagem + Secagem'),
	(7, 'Pack Lavagem + Secagem + Ferro'),
	(8, 'Pack Mensal Pequeno (<10 Kg/mês)'),
	(9, 'Pack Mensal Médio (10-20 Kg/mês)'),
	(10, 'Pack Mensal Grande (>20 Kg/mês)');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

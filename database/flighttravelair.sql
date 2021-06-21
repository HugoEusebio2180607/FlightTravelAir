-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 21-Jun-2021 às 21:02
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `flighttravelair`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aeroportos`
--

DROP TABLE IF EXISTS `aeroportos`;
CREATE TABLE IF NOT EXISTS `aeroportos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `localizacao` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aeroportos`
--

INSERT INTO `aeroportos` (`id`, `nome`, `localizacao`) VALUES
(1, 'aeroporto lisboa', 'lisboa'),
(2, 'Aerporto de Sydney', 'Australia'),
(5, 'Aeroporto SÃ¡ Carneiro', 'Porto'),
(6, 'Aeroporto de Milao', 'Italia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aviaos`
--

DROP TABLE IF EXISTS `aviaos`;
CREATE TABLE IF NOT EXISTS `aviaos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `referencia` int(11) NOT NULL,
  `lotacao` int(11) NOT NULL,
  `tipo_aviao` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `aviaos`
--

INSERT INTO `aviaos` (`id`, `referencia`, `lotacao`, `tipo_aviao`) VALUES
(3, 122322, 221, 'Boeing007'),
(5, 22112, 3212, 'Boeing007'),
(8, 122322, 656, 'Boeing007');

-- --------------------------------------------------------

--
-- Estrutura da tabela `bilhetes`
--

DROP TABLE IF EXISTS `bilhetes`;
CREATE TABLE IF NOT EXISTS `bilhetes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_compra` date NOT NULL,
  `preco` int(11) NOT NULL,
  `checkin` int(11) DEFAULT NULL,
  `idavoo` int(11) NOT NULL,
  `voltavoo` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `idavoo` (`idavoo`),
  KEY `voltavoo` (`voltavoo`),
  KEY `checkin` (`checkin`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `bilhetes`
--

INSERT INTO `bilhetes` (`id`, `data_compra`, `preco`, `checkin`, `idavoo`, `voltavoo`, `id_user`) VALUES
(1, '2021-06-21', 424, 7, 21, 21, 4),
(2, '2021-06-21', 868, 7, 19, 20, 4),
(3, '2021-06-21', 868, 7, 19, 20, 4),
(5, '2021-06-21', 647, NULL, 21, 19, 4),
(6, '2021-06-21', 870, NULL, 22, 19, 4),
(7, '2021-06-21', 645, NULL, 20, 21, 4),
(8, '2021-06-21', 2558, NULL, 19, 21, 4),
(9, '2021-06-21', 868, NULL, 20, 19, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `detalhesvoos`
--

DROP TABLE IF EXISTS `detalhesvoos`;
CREATE TABLE IF NOT EXISTS `detalhesvoos` (
  `id` int(11) NOT NULL,
  `passageiros` int(200) NOT NULL,
  `id_escala` int(11) NOT NULL,
  `id_aviao` int(11) NOT NULL,
  KEY `id_aviao` (`id_aviao`),
  KEY `id_escala` (`id_escala`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `escalas`
--

DROP TABLE IF EXISTS `escalas`;
CREATE TABLE IF NOT EXISTS `escalas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aeroporto_origem` int(11) NOT NULL,
  `aeroporto_destino` int(11) NOT NULL,
  `id_voo` int(11) NOT NULL,
  `hora_origem` time NOT NULL,
  `hora_destino` time NOT NULL,
  `data_origem` date NOT NULL,
  `data_final` date NOT NULL,
  `distancia` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `aeroporto_origem` (`aeroporto_origem`),
  KEY `aeroport_destino` (`aeroporto_destino`),
  KEY `id_voo` (`id_voo`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `escalas`
--

INSERT INTO `escalas` (`id`, `aeroporto_origem`, `aeroporto_destino`, `id_voo`, `hora_origem`, `hora_destino`, `data_origem`, `data_final`, `distancia`) VALUES
(5, 2, 1, 19, '20:07:00', '23:13:00', '2021-06-23', '2021-06-23', 3122),
(6, 5, 2, 19, '22:34:00', '23:32:00', '2021-06-22', '2021-06-23', 31222),
(8, 1, 6, 19, '23:10:00', '23:10:00', '2021-07-01', '2021-06-22', 31223),
(10, 2, 5, 22, '22:30:00', '02:30:00', '2021-07-01', '2021-07-07', 312),
(11, 2, 5, 21, '00:31:00', '00:31:00', '2021-06-09', '2021-06-14', 312);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `morada` varchar(255) NOT NULL,
  `nif` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telefone` int(11) NOT NULL,
  `roles` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `email`, `morada`, `nif`, `username`, `password`, `telefone`, `roles`) VALUES
(3, 'Hugo Eusebio', 'hugo.16eusebio@gmail.com', 'Rua do Alto da Rola', 345678907, 'Hugo', '123456', 915851870, 'admin'),
(4, 'joao', 'hugo.15eusebio@gmail.com', 'pombal', 213124216, 'joao', '123456', 915851870, 'passageiro'),
(5, 'Diogo Leal', 'latino@gmail.com', 'pombal', 132312333, 'Nogueiiira', '123456', 915851870, 'gestorvoo'),
(6, 'ze', 'ze@gmail.com', 'soure', 123213222, 'ze', '123456', 915851872, 'passageiro'),
(7, 'ze', 'ze21@gmail.com', 'lisboa', 312312323, 'ze2', '123456', 915851870, 'operadorcheckin');

-- --------------------------------------------------------

--
-- Estrutura da tabela `voos`
--

DROP TABLE IF EXISTS `voos`;
CREATE TABLE IF NOT EXISTS `voos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `custo_voo` int(11) NOT NULL,
  `aeroporto_origem` int(11) NOT NULL,
  `aeroporto_destino` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `aeroporto_origem` (`aeroporto_origem`),
  KEY `aeroporto_destino` (`aeroporto_destino`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `voos`
--

INSERT INTO `voos` (`id`, `custo_voo`, `aeroporto_origem`, `aeroporto_destino`) VALUES
(19, 435, 1, 2),
(20, 433, 5, 6),
(21, 2123, 2, 6),
(22, 435, 2, 5);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `bilhetes`
--
ALTER TABLE `bilhetes`
  ADD CONSTRAINT `bilhetes_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bilhetes_ibfk_2` FOREIGN KEY (`idavoo`) REFERENCES `voos` (`id`),
  ADD CONSTRAINT `bilhetes_ibfk_3` FOREIGN KEY (`voltavoo`) REFERENCES `voos` (`id`),
  ADD CONSTRAINT `bilhetes_ibfk_4` FOREIGN KEY (`checkin`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `detalhesvoos`
--
ALTER TABLE `detalhesvoos`
  ADD CONSTRAINT `detalhesvoos_ibfk_1` FOREIGN KEY (`id_aviao`) REFERENCES `aviaos` (`id`),
  ADD CONSTRAINT `detalhesvoos_ibfk_2` FOREIGN KEY (`id_escala`) REFERENCES `escalas` (`id`);

--
-- Limitadores para a tabela `escalas`
--
ALTER TABLE `escalas`
  ADD CONSTRAINT `escalas_ibfk_1` FOREIGN KEY (`aeroporto_origem`) REFERENCES `aeroportos` (`id`),
  ADD CONSTRAINT `escalas_ibfk_2` FOREIGN KEY (`aeroporto_destino`) REFERENCES `aeroportos` (`id`),
  ADD CONSTRAINT `escalas_ibfk_3` FOREIGN KEY (`id_voo`) REFERENCES `voos` (`id`);

--
-- Limitadores para a tabela `voos`
--
ALTER TABLE `voos`
  ADD CONSTRAINT `voos_ibfk_1` FOREIGN KEY (`aeroporto_origem`) REFERENCES `aeroportos` (`id`),
  ADD CONSTRAINT `voos_ibfk_2` FOREIGN KEY (`aeroporto_destino`) REFERENCES `aeroportos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

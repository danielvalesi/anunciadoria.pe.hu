-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 05/04/2016 às 17:38
-- Versão do servidor: 5.5.46-0ubuntu0.14.04.2
-- Versão do PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `db_anunciadoria`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin`
--

CREATE TABLE IF NOT EXISTS `tb_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_usuario` varchar(20) NOT NULL,
  `admin_senha` varchar(32) NOT NULL,
  `admin_criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `admin_nome` varchar(30) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Fazendo dump de dados para tabela `tb_admin`
--

INSERT INTO `tb_admin` (`admin_id`, `admin_usuario`, `admin_senha`, `admin_criado`, `admin_nome`) VALUES
(1, 'anunciadoria', '81dc9bdb52d04dc20036dbd8313ed055', '2015-05-08 02:19:26', 'Anunciadoria Admin');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_anuncio`
--

CREATE TABLE IF NOT EXISTS `tb_anuncio` (
  `anuncio_id` int(11) NOT NULL AUTO_INCREMENT,
  `anuncio_titulo` varchar(120) NOT NULL,
  `anuncio_valor` decimal(10,2) DEFAULT NULL,
  `anuncio_valorTipo` int(11) DEFAULT NULL,
  `anuncio_telefone` varchar(20) NOT NULL,
  `anuncio_descricao` text,
  `anuncio_criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `anuncio_editado` datetime DEFAULT NULL,
  `bairro_id` int(11) NOT NULL,
  `cadastro_id` int(11) NOT NULL,
  `anuncio_endereco_cep` varchar(10) NOT NULL,
  `anuncio_endereco_rua` varchar(255) NOT NULL,
  `anuncio_endereco_numero` varchar(10) NOT NULL,
  `anuncio_endereco_complemento` varchar(50) DEFAULT NULL,
  `anuncio_endereco_bairro` varchar(100) DEFAULT NULL,
  `anuncio_status` int(11) DEFAULT '0',
  PRIMARY KEY (`anuncio_id`),
  KEY `ta001_ix` (`bairro_id`),
  KEY `ta002_ix` (`cadastro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10155 ;

--
-- Fazendo dump de dados para tabela `tb_anuncio`
--

INSERT INTO `tb_anuncio` (`anuncio_id`, `anuncio_titulo`, `anuncio_valor`, `anuncio_valorTipo`, `anuncio_telefone`, `anuncio_descricao`, `anuncio_criado`, `anuncio_editado`, `bairro_id`, `cadastro_id`, `anuncio_endereco_cep`, `anuncio_endereco_rua`, `anuncio_endereco_numero`, `anuncio_endereco_complemento`, `anuncio_endereco_bairro`, `anuncio_status`) VALUES
(10013, ' 122.2 | OUTDOOR | AV. RUI SEIXAS', NULL, NULL, '(17) 3266-9393', 'Av. Rui Seixas | R. Bartolomeu G. | Ft. Bar Pouso E Decolagem | Ld. Esquerdo | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²\n\n\n\n', '2016-03-18 13:13:46', '2016-03-18 13:18:48', 32, 5012, '15025-355', 'Avenida Engenheiro Rui Seixas', 'SN', 'Lat -20.812202 Log	-49.398238', NULL, 1),
(10014, ' 122.3 | OUTDOOR | AV. RUI SEIXAS', NULL, NULL, '(17) 3266-9393', 'Av. Rui Seixas | R. Bartolomeu G. | Ft. Bar Pouso E Decolagem | Ld. Esquerdo | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²\n\n', '2016-03-18 16:26:49', '2016-03-18 16:48:35', 32, 5012, '15025-355', 'Avenida Engenheiro Rui Seixas', 'SN', 'Lat -20.812202 Log	-49.398238', NULL, 1),
(10015, ' 123.1 | OUTDOOR | AV. ZAIA TARRAF', NULL, NULL, '(17) 3266-9393', 'Av. Zaia Tarraf | Acesso Av. José Munia | Lado Walmart | Havan | Sentido: Centro\n\n9,00×3,00m = 27,00m²', '2016-03-18 16:29:35', '2016-03-18 16:48:34', 36, 5012, '15084-065', 'Boulevard Zaia Tarraf', 'SN', 'Lat -20.825436	Log -49.385711', NULL, 1),
(10016, ' 123.2 | OUTDOOR | AV. ZAIA TARRAF', NULL, NULL, '(17) 3266-9393', 'Av. Zaia Tarraf | Acesso Av. José Munia | Lado Walmart | Havan | Sentido: Centro\n\n9,00×3,00m = 27,00m²', '2016-03-18 16:31:00', '2016-03-18 16:48:32', 36, 5012, '15084-065', 'Boulevard Zaia Tarraf', 'SN', 'Lat -20.825436	Log -49.385711', NULL, 1),
(10017, ' 123.3 | OUTDOOR | AV. ZAIA TARRAF', NULL, NULL, '(17) 3266-9393', 'Av. Zaia Tarraf | Acesso Av. José Munia | Lado Walmart | Havan | Sentido: Centro\n\n9,00×3,00m = 27,00m²', '2016-03-18 16:31:54', '2016-03-18 16:48:31', 36, 5012, '15084-065', 'Boulevard Zaia Tarraf', 'SN', 'Lat -20.825436	Log -49.385711', NULL, 1),
(10018, ' 123.4 | OUTDOOR | AV. ZAIA TARRAF', NULL, NULL, '(17) 3266-9393', 'Av. Zaia Tarraf | Acesso Av. José Munia | Lado Walmart | Havan | Sentido: Centro\n\n9,00×3,00m = 27,00m²', '2016-03-18 16:33:22', '2016-03-18 16:48:30', 36, 5012, '15084-065', 'Boulevard Zaia Tarraf', 'SN', 'Lat -20.825436	Log -49.385711', NULL, 1),
(10019, ' 123.5 | OUTDOOR | AV. ZAIA TARRAF', NULL, NULL, '(17) 3266-9393', 'Av. Zaia Tarraf | Acesso Av. José Munia | Lado Walmart | Havan | Sentido: Centro\n\n9,00×3,00m = 27,00m²', '2016-03-18 16:35:09', '2016-03-18 16:48:29', 36, 5012, '15084-065', 'Boulevard Zaia Tarraf', 'SN', 'Lat -20.825436	Log -49.385711', NULL, 1),
(10020, ' 128.1 | OUTDOOR | AV. ROMEU STRAZZI', NULL, NULL, '(17) 3266-9393', 'Av. Romeu Strazzi | Rotatória Frente Plaza Avenida Shopping | Sentido: Centro\n\n9,00×3,00m = 27,00m²', '2016-03-18 16:38:51', '2016-03-18 16:48:27', 41, 5012, '15084-010', 'Avenida Romeu Strazzi ', 'SN', 'Lat -20.829263	Log -49.385485', NULL, 1),
(10021, ' 128.2 | OUTDOOR | AV. ROMEU STRAZZI', NULL, NULL, '(17) 3266-9393', 'Av. Romeu Strazzi | Rotatória Frente Plaza Avenida Shopping | Sentido: Centro\n\n9,00×3,00m = 27,00m²', '2016-03-18 16:39:53', '2016-03-18 16:48:26', 41, 5012, '15084-010', 'Avenida Romeu Strazzi - ', 'SN', 'Lat -20.829263	Log -49.385485', NULL, 1),
(10022, '128.3 | OUTDOOR | AV. ROMEU STRAZZI', NULL, NULL, '(17) 3266-9393', 'Av. Romeu Strazzi | Rotatória Frente Plaza Avenida Shopping | Sentido: Centro\n\n9,00×3,00m = 27,00m²', '2016-03-18 16:40:56', '2016-03-18 16:48:24', 41, 5012, '15084-010', 'Avenida Romeu Strazzi ', 'SN', 'Lat -20.829263	Log -49.385485', NULL, 1),
(10023, ' 129.1 | OUTDOOR | AV. MARG. COMEND. VICENTE FILIZOLA', NULL, NULL, '(17) 3266-9393', 'Av. Marg. Comend. Vicente Filizola | Próx. Rot. Av. Clóvis Oger | Aeroporto | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-18 16:45:04', '2016-03-18 16:48:23', 44, 5012, '15020-350', 'Avenida Comendador Vicente Filizola ', 'SN', 'Lat -20.822882	Log -49.417008', NULL, 1),
(10024, ' 129.2 | OUTDOOR | AV. MARG. COMEND. VICENTE FILIZOLA', NULL, NULL, '(17) 3266-9393', 'Av. Marg. Comend. Vicente Filizola | Próx. Rot. Av. Clóvis Oger | Aeroporto | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-18 16:46:46', '2016-03-18 16:48:21', 44, 5012, '15020-350', 'Avenida Comendador Vicente Filizola ', 'SN', 'Lat -20.822882	Log -49.417008', NULL, 1),
(10025, ' 130.6 | OUTDOOR | AV. CLOVIS OGER', NULL, NULL, '(17) 3266-9393', 'Av. Clóvis Oger | Sequencial Aeroporto | Frente Ciesp | Arco Iris | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-18 17:52:44', '2016-03-18 18:11:55', 47, 5012, '15035-580', 'Rua Clóvis Oger', 'SN', 'Lat -20.81958	Log -49.41456', NULL, 1),
(10026, ' 130.7 | OUTDOOR | ]AV. CLOVIS OGER', NULL, NULL, '(17) 3266-9393', 'Av. Clóvis Oger | Sequencial Aeroporto | Frente Ciesp | Arco Iris | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-18 17:54:31', '2016-03-18 18:11:53', 47, 5012, '15035-580', 'Rua Clóvis Oger', 'SN', 'Lat -20.81958	Log -49.41456', NULL, 1),
(10027, ' 130.8 | OUTDOOR | AV. CLOVIS OGER', NULL, NULL, '(17) 3266-9393_', 'Av. Clóvis Oger | Sequencial Aeroporto | Frente Ciesp | Arco Iris | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²\n\n', '2016-03-18 18:00:11', '2016-03-18 18:11:49', 47, 5012, '15035-580', 'Rua Clóvis Oger', 'SN', 'Lat -20.821636	Log -49.416887', NULL, 1),
(10028, ' 130.9 | OUTDOOR | AV. CLOVIS OGER', NULL, NULL, '(17) 3266-9393', 'Av. Clóvis Oger | Sequencial Aeroporto | Frente Ciesp | Arco Iris | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-18 18:01:15', '2016-03-18 18:11:47', 47, 5012, '15035-580', 'Rua Clóvis Oger', 'SN', 'Lat -20.822446	Log -49.417785', NULL, 1),
(10029, ' 131.1 | OUTDOOR | AV. ANILOEL NAZARETH', NULL, NULL, '(17) 3266-9393', 'Av. Aniloel Nazareth | Av. Lino José Seixas | Represa Municipal | Viad BR153 | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-18 18:06:44', '2016-03-18 18:11:44', 51, 5012, '15070-230', 'Avenida Doutor Aniloel Nazareth ', 'SN', 'Lat -20.819979	Log -49.415004', NULL, 1),
(10030, ' 131.2 | OUTDOOR | AV. ANILOEL NAZARETH', NULL, NULL, '(17) 3266-9393', 'Av. Aniloel Nazareth | Av. Lino José Seixas | Represa Municipal | Viad BR153 | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-18 18:09:03', '2016-03-18 18:11:41', 51, 5012, '15070-230', 'Avenida Doutor Aniloel Nazareth', 'SN', 'Lat -20.819913	Log -49.41493', NULL, 1),
(10032, '132.U | OUTDOOR | R. XV DE NOVEMBRO', NULL, NULL, '(17) 3266-9393', 'R. XV de Novembro | Estacionamento Viçoso | Praça Shopping | Mil Carros P/Dia\n\n9,00×3,00m = 27,00m²', '2016-03-18 18:11:09', '2016-03-18 18:11:33', 14, 5012, '15015-110', 'Rua Quinze de Novembro ', 'SN', 'Lat -20.812249	Log -49.379231', NULL, 1),
(10034, '135.1 | OUTDOOR | AV. NSA. SRA. DA PAZ', NULL, NULL, '(17) 3266-9393', 'Av. Nsa. Sra. Da Paz | R. Elias Abissanra | Frente Churrascaria Brasa Viva | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-18 18:17:16', '2016-03-18 18:21:56', 59, 5012, '15054-400', 'Avenida Nossa Senhora da Paz ', 'SN', 'Lat -20.794603	Log -49.363106', NULL, 1),
(10035, '135.2 | OUTDOOR | AV. NSA. SRA. DA PAZ', NULL, NULL, '(17) 3266-9393', 'Av. Nsa. Sra. Da Paz | R. Elias Abissanra | Frente Churrascaria Brasa Viva | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-18 18:18:23', '2016-03-18 18:21:54', 59, 5012, '15054-400', 'Avenida Nossa Senhora da Paz ', 'SN', 'Lat -20.794603	Log -49.363106', NULL, 1),
(10036, '135.3 | OUTDOOR | AV. NSA. SRA. DA PAZ', NULL, NULL, '(17) 3266-9393', 'Av. Nsa. Sra. Da Paz | R. Elias Abissanra | Frente Churrascaria Brasa Viva | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-18 18:21:31', '2016-03-18 18:21:51', 59, 5012, '15054-400', 'Avenida Nossa Senhora da Paz ', 'SN', 'Lat -20.794603	Log -49.363106', NULL, 1),
(10041, ' 136.1 | OUTDOOR | AV. NELSON SINIBALDI', NULL, NULL, '(17) 3266-9393', 'Av. Nelson Sinibaldi | R. Luiz G. Menezes | Ac. Cond. Village Damha | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-18 20:18:09', '2016-03-18 20:26:01', 70, 5012, '15057-500', 'Rua Nelson Sinibaldi', 'SN', 'Lat -20.798172	Log -49.345342', NULL, 1),
(10042, ' 136.2 | OUTDOOR | AV. NELSON SINIBALDI', NULL, NULL, '(17) 3266-9393_', 'Av. Nelson Sinibaldi | R. Luiz G. Menezes | Ac. Cond. Village Damha | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-18 20:19:24', '2016-03-18 20:25:59', 70, 5012, '15057-500', 'Rua Nelson Sinibaldi', 'SN', 'Lat -20.798172	Log -49.345342', NULL, 1),
(10043, ' 136.3 | OUTDOOR | AV. NELSON SINIBALDI', NULL, NULL, '(17) 3266-9393', 'Av. Nelson Sinibaldi | R. Luiz G. Menezes | Ac. Cond. Village Damha | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-18 20:20:56', '2016-03-18 20:25:57', 70, 5012, '15057-500', 'Rua Nelson Sinibaldi', 'SN', 'Lat -20.798172	Log -49.345342', NULL, 1),
(10044, '136.4 | OUTDOOR | AV. NELSON SINIBALDI', NULL, NULL, '(17) 3266-9393', 'Av. Nelson Sinibaldi | R. Luiz G. Menezes | Ac. Cond. Village Damha | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-18 20:21:37', '2016-03-18 20:25:54', 70, 5012, '15057-500', 'Rua Nelson Sinibaldi', 'SN', 'Lat -20.798172	Log -49.345342', NULL, 1),
(10045, '138.1 | OUTDOOR | AV. SANTA PAULA', NULL, NULL, '(17) 3266-9393', 'Av. Santa Paula | R. Sebastião G. De Souza | Sentido Viaduto Delegado | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-21 17:28:08', '2016-03-23 16:15:59', 76, 5012, '15061-000', 'Avenida Doutor Fernando Costa ', 'SN', 'Lat -20.795823	Log -49.402463', NULL, 1),
(10046, '138.2 | OUTDOOR | AV. SANTA PAULA', NULL, NULL, '(17) 3266-9393', 'Av. Santa Paula | R. Sebastião G. De Souza | Sentido Viaduto Delegado | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-21 17:29:14', '2016-03-21 17:45:28', 76, 5012, '15061-000', 'Avenida Doutor Fernando Costa ', 'SN', 'Lat -20.795823	Log -49.402463', NULL, 1),
(10047, ' 139.1 | OUTDOOR | R. DR. COUTINHO CAVALCANTI', NULL, NULL, '(17) 3266-9393', 'R. Dr. Coutinho Cavalcanti | Rua Elias Abssanra | Lado Tiquinho Buffet | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-21 17:32:05', '2016-03-21 17:46:59', 59, 5012, '15054-300', 'Rua Doutor Coutinho Cavalcanti ', 'SN', 'Lat -20.793684	Log -49.363544', NULL, 1),
(10048, ' 139.2 | OUTDOOR | R. DR. COUTINHO CAVALCANTI', NULL, NULL, '(17) 3266-9393', 'R. Dr. Coutinho Cavalcanti | Rua Elias Abssanra | Lado Tiquinho Buffet | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-21 17:32:54', '2016-03-21 17:46:40', 59, 5012, '15054-300', 'Rua Doutor Coutinho Cavalcanti ', 'SN', 'Lat -20.793684	Log -49.363544', NULL, 1),
(10049, ' 140.U | OUTDOOR | AV. JOSE MUNIA', NULL, NULL, '(17) 3266-9393', 'Av. José Munia | Lado Multiclinicas | Frente Liban | Retorno Jd. Vivendas | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²\n\n', '2016-03-21 17:35:00', '2016-03-21 17:46:37', 80, 5012, '15090-045', 'Avenida José Munia ', 'Sn', 'Lat -20.842905	Log -49.393984', NULL, 1),
(10050, ' 141.1  | OUTDOOR | AV. JUSCELINO K. OLIVEIRA', NULL, NULL, '(17) 3266-9393', 'Av. Juscelino K. Oliveira | Rotatória BR153 | Frente Shopping Iguatemi | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-21 17:37:01', '2016-03-21 17:46:33', 81, 5012, '15092-175', 'Avenida Presidente Juscelino Kubitschek de Oliveira', 'SN', 'Lat -20.865337	Log -49.412033', NULL, 1),
(10051, ' 141.2  | OUTDOOR | AV. JUSCELINO K. OLIVEIRA', NULL, NULL, '(17) 3266-9393', 'Av. Juscelino K. Oliveira | Rotatória BR153 | Frente Shopping Iguatemi | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-21 17:39:15', '2016-03-21 17:46:29', 81, 5012, '15092-175', 'Avenida Presidente Juscelino Kubitschek de Oliveira ', 'SN', 'Lat -20.865337	Log -49.412033', NULL, 1),
(10052, '141.3  | OUTDOOR | AV. JUSCELINO K. OLIVEIRA', NULL, NULL, '(17) 3266-9393', 'Av. Juscelino K. Oliveira | Rotatória BR153 | Frente Shopping Iguatemi | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-21 17:40:08', '2016-03-21 17:46:26', 81, 5012, '15092-175', 'Avenida Presidente Juscelino Kubitschek de Oliveira ', 'SN', 'Lat -20.865337	Log -49.412033', NULL, 1),
(10053, '142.1  | OUTDOOR | AV. JUSCELINO K. OLIVEIRA', NULL, NULL, '(17) 3266-9393', 'Av. Juscelino K. Oliveira | Lado MPBEER | Próx. Eurobike | Retorno Iguatemi | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-21 17:42:53', '2016-03-21 17:46:22', 81, 5012, '15092-175', 'Avenida Presidente Juscelino Kubitschek de Oliveira ', 'SN', 'Lat -20.8568608	 Log -49.4117618', NULL, 1),
(10054, '142.2  | OUTDOOR | AV. JUSCELINO K. OLIVEIRA', NULL, NULL, '(17) 3266-9393', 'Av. Juscelino K. Oliveira | Lado MPBEER | Próx. Eurobike | Retorno Iguatemi | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-21 17:43:40', '2016-03-21 17:46:18', 81, 5012, '15092-175', 'Avenida Presidente Juscelino Kubitschek de Oliveira ', 'SN', 'Lat -20.8568608	 Log -49.4117618', NULL, 1),
(10055, '142.3  | OUTDOOR | AV. JUSCELINO K. OLIVEIRA', NULL, NULL, '(17) 3266-9393', 'Av. Juscelino K. Oliveira | Lado MPBEER | Próx. Eurobike | Retorno Iguatemi | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-21 17:44:31', '2016-03-21 17:45:58', 81, 5012, '15092-175', 'Avenida Presidente Juscelino Kubitschek de Oliveira ', 'SN', 'Lat -20.8568608	 Log -49.4117618', NULL, 1),
(10056, '143.U | OUTDOOR | R. GAL. GLICÉRIO', NULL, NULL, '(17) 3266-9393_', 'R. Gal. Glicério | R. João Mesquita | Clube Palestra Sede | Ft Praça Cívica | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-21 19:51:34', '2016-03-21 20:05:43', 14, 5012, '15015-100', 'Rua Antônio de Godoy ', 'SN', 'Lat -20.80756	Log -49.377858', NULL, 1),
(10057, ' 144.U | OUTDOOR | AV. DANILO GALEAZZI', NULL, NULL, '(17) 3266-9393_', 'Av. Danilo Galeazzi | Apos Condomínio Amazonas | Cond. Alta Vista | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-21 19:53:10', '2016-03-21 20:05:42', 97, 5012, '15051-000', 'Avenida Danilo Galeazzi ', 'SN', 'Lat -20.766221	Log -49.35402', NULL, 1),
(10058, '145.1 | OUTDOOR | AV. PHILADELPHO G. NETO', NULL, NULL, '(17) 3266-9393_', 'Av. Philadelpho M. Gouveia Netto | R. Nicolau Buissa | Frente Rotatória | Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-21 19:55:28', '2016-03-21 20:05:40', 98, 5012, '15030-790', 'Avenida Philadelpho Manoel Gouveia Netto ', 'SN', 'Lat -20.786257	Log -49.376033', NULL, 1),
(10059, '145.2 | OUTDOOR | AV. PHILADELPHO G. NETO', NULL, NULL, '(17) 3266-9393_', 'Av. Philadelpho M. Gouveia Netto | R. Nicolau Buissa | Frente Rotatória | Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-21 19:56:26', '2016-03-21 20:05:39', 98, 5012, '15030-790', 'Avenida Philadelpho Manoel Gouveia Netto ', 'SN', 'Lat -20.786257	Log -49.376033', NULL, 1),
(10060, '145.3 | OUTDOOR | AV. PHILADELPHO G. NETO', NULL, NULL, '(17) 3266-9393', 'Av. Philadelpho M. Gouveia Netto | R. Nicolau Buissa | Frente Rotatória | Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-21 19:57:07', '2016-03-21 20:05:37', 98, 5012, '15030-790', 'Avenida Philadelpho Manoel Gouveia Netto ', 'SN', 'Lat -20.786257	Log -49.376033', NULL, 1),
(10061, '145.4 | OUTDOOR | AV. PHILADELPHO G. NETO', NULL, NULL, '(17) 3266-9393', 'Av. Philadelpho M. Gouveia Netto | R. Nicolau Buissa | Frente Rotatória | Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-21 19:57:50', '2016-03-21 20:06:11', 98, 5012, '15030-790', 'Avenida Philadelpho Manoel Gouveia Netto ', 'SN', 'Lat -20.786257	Log -49.376033', NULL, 1),
(10062, ' 147.1 | OUTDOOR | AV. SYLVIO DELLA ROVERE', NULL, NULL, '(17) 3266-9393_', 'Av. Sylvio Della Rovere | R. Antônio Marcore | Ft. Loja de Colchões | Figueira | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-21 20:00:45', '2016-03-21 20:05:34', 102, 5012, '15061-580', 'Avenida Sylvio Della Rovere', 'Sn', 'Lat -20.808247	Log -49.349497', NULL, 1),
(10063, ' 147.2 | OUTDOOR | AV. SYLVIO DELLA ROVERE', NULL, NULL, '(17) 3266-9393_', 'Av. Sylvio Della Rovere | R. Antônio Marcore | Ft. Loja de Colchões | Figueira | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-21 20:01:50', '2016-03-21 20:05:32', 102, 5012, '15061-580', 'Avenida Sylvio Della Rovere', 'SN', 'Lat -20.808537	Log -49.34962', NULL, 1),
(10064, '147.3 | OUTDOOR | AV. SYLVIO DELLA ROVERE', NULL, NULL, '(17) 3266-9393_', 'Av. Sylvio Della Rovere | R. Antônio Marcore | Ft. Loja de Colchões | Figueira | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-21 20:02:36', '2016-03-21 20:05:30', 102, 5012, '15061-580', 'Avenida Sylvio Della Rovere', 'SN', 'Lat -20.808537	Log -49.34962', NULL, 1),
(10065, ' 147.4 | OUTDOOR | AV. SYLVIO DELLA ROVERE', NULL, NULL, '(17) 3266-9393_', 'Av. Sylvio Della Rovere | R. Antônio Marcore | Ft. Loja de Colchões | Figueira | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-21 20:03:26', '2016-03-21 20:05:28', 102, 5012, '15061-580', 'Avenida Sylvio Della Rovere', 'SN', 'Lat -20.807986	Log -49.349175', NULL, 1),
(10066, ' 147.5 | OUTDOOR | AV. SYLVIO DELLA ROVERE', NULL, NULL, '(17) 3266-9393_', 'Av. Sylvio Della Rovere | R. Antônio Marcore | Ft. Loja de Colchões | Figueira | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-21 20:04:15', '2016-03-21 20:05:26', 102, 5012, '15061-580', 'Avenida Sylvio Della Rovere', 'SN', 'Lat -20.807986	Log -49.349175', NULL, 1),
(10067, '148.1 | OUTDOOR | AV. FRANCISCO CHAGAS', NULL, NULL, '(17) 3266-9393_', 'Av. Francisco Chagas | Entre R. Tupi E R. Maria C. Trevisan | Ft. Fulbeas | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-21 20:09:03', '2016-03-21 20:11:44', 108, 5012, '15091-330', 'Avenida Francisco das Chagas Oliveira ', 'SN', 'Lat -20.833967	Log -49.395264', NULL, 1),
(10068, '148.2 | OUTDOOR | AV. FRANCISCO CHAGAS', NULL, NULL, '(17) 3266-9393', 'Av. Francisco Chagas | Entre R. Tupi E R. Maria C. Trevisan | Ft. Fulbeas | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-21 20:10:04', '2016-03-21 20:11:43', 108, 5012, '15091-330', 'Avenida Francisco das Chagas Oliveira ', 'SN', 'Lat -20.833967	Log -49.395264', NULL, 1),
(10069, '148.3 | OUTDOOR | AV. FRANCISCO CHAGAS', NULL, NULL, '(17) 3266-9393', 'Av. Francisco Chagas | Entre R. Tupi E R. Maria C. Trevisan | Ft. Fulbeas | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-21 20:11:28', '2016-03-21 20:11:40', 108, 5012, '15091-330', 'Avenida Francisco das Chagas Oliveira ', 'SN', 'Lat -20.834122	Log -49.394882', NULL, 1),
(10070, ' 149.1 | OUTDOOR | R. REDENTORA', NULL, NULL, '(17) 3266-9393_', 'R. Redentora | R. General Glicério | Ft. Supermercado Maranhão | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-21 20:13:43', '2016-03-21 20:20:57', 14, 5012, '15015-100', 'Rua Antônio de Godoy ', 'SN', 'Lat -20.818327	Log -49.389861', NULL, 1),
(10071, ' 150.1 | OUTDOOR | R. GENERAL GLICERIO', NULL, NULL, '(17) 3266-9393_', 'R. General Glicério | R. Redentora | Ft. Supermercado Maranhão | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-21 20:15:10', '2016-03-21 20:20:55', 14, 5012, '15015-100', 'Rua Antônio de Godoy ', 'SN', 'Lat -20.81836	Log -49.389511', NULL, 1),
(10072, ' 151.1 | OUTDOOR | AV. PHILADELPHO M. GOUVEIA NETTO', NULL, NULL, '(17) 3266-9393_', 'Av. Philadelpho M. Gouveia Netto | Av. Abilio Appoloni | Próx. Sest Senat | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-21 20:17:03', '2016-03-21 20:20:54', 98, 5012, '15030-790', 'Avenida Philadelpho Manoel Gouveia Netto ', 'SN', 'Lat -20.783483	Log -49.382163', NULL, 1),
(10073, ' 151.2 | OUTDOOR | AV. PHILADELPHO M. GOUVEIA NETTO', NULL, NULL, '(17) 3266-9393_', 'Av. Philadelpho M. Gouveia Netto | Av. Abilio Appoloni | Próx. Sest Senat | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-21 20:17:52', '2016-03-21 20:20:52', 98, 5012, '15030-790', 'Avenida Philadelpho Manoel Gouveia Netto ', 'SN', 'Lat -20.783483	Log -49.382163', NULL, 1),
(10074, '151.3 | OUTDOOR | AV. PHILADELPHO M. GOUVEIA NETTO', NULL, NULL, '(17) 3266-9393_', 'Av. Philadelpho M. Gouveia Netto | Av. Abilio Appoloni | Próx. Sest Senat | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-21 20:18:36', '2016-03-21 20:20:51', 98, 5012, '15030-790', 'Avenida Philadelpho Manoel Gouveia Netto ', 'SN', 'Lat -20.783483	Log -49.382163', NULL, 1),
(10075, ' R01.U | OUTDOOR | FRONTEIRA | ENTRADA DA CIDADE', NULL, NULL, '(17) 3266-9393', 'Fronteira | Entrada Da Cidade | Trevo | Sentido: Centro/Bairro\n\n93,00×3,00m = 27,00m²', '2016-03-21 20:20:35', '2016-03-21 20:20:49', 116, 5012, '38230-970', 'Rua Abdo Jauid Feres 88', 'SN', 'Lat -20.288018	Log -49.199801', NULL, 1),
(10076, ' 001.U | OUTDOOR | AV. DR. ALBERTO ANDALÓ', NULL, NULL, '(17) 3266-9393', 'Av. Dr. Alberto Andaló | Estacionamento Mc Donald''s | Sentido: Centro/Bairro 93,00×3,00m = 27,00m²\n', '2016-03-26 15:21:35', '2016-03-26 15:22:04', 14, 5012, '15015-000', 'Avenida Doutor Alberto Andaló', 'SN', 'Lat -20.822.659 Log -49.384.611', NULL, 1),
(10077, ' 002.1 | OUTDOOR | AV. DR. ALBERTO ANDALO', NULL, NULL, '(17) 3266-9393', '\nAv. Dr. Alberto Andaló | R. Prudente de Moraes | Frente Automóvel Clube | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-26 15:53:59', '2016-03-26 15:54:09', 14, 5012, '15015-000', 'Avenida Doutor Alberto Andaló', 'SN', 'Lat -20.812282 Log -49.376149', NULL, 1),
(10078, 'OUT - 002.2 AV. DR. ALBERTO ANDALO', NULL, NULL, '(17) 3266-9393', 'Av. Dr. Alberto Andaló | R. Prudente de Moraes | Frente Automóvel Clube | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-26 15:57:32', '2016-03-26 15:57:44', 14, 5012, '15015-000', 'Avenida Doutor Alberto Andaló', 'SN', 'Lat -20.812069 Log -49.376036', NULL, 1),
(10079, ' 002.3 | OUTDOOR | AV. DR. ALBERTO ANDALO', NULL, NULL, '(17) 3266-9393', 'Av. Dr. Alberto Andaló | R. Prudente de Moraes | Frente Automóvel Clube | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-26 16:17:00', '2016-03-26 17:26:13', 14, 5012, '15015-000', 'Avenida Doutor Alberto Andaló', 'SN', 'Lat -20.812069 Log -49.376036', NULL, 1),
(10080, ' 003.1 | OUTDOOR | AV. DR. ALBERTO ANDALO', NULL, NULL, '(17) 3266-9393', 'Av. Dr. Alberto Andaló | Frente Automóvel Clube | Viaduto – Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-26 16:19:46', '2016-03-26 17:26:07', 14, 5012, '15015-000', 'Avenida Doutor Alberto Andaló', 'SN', 'Lat -20.811458 Log -49.375752', NULL, 1),
(10081, ' 003.2 | OUTDOOR | AV. DR. ALBERTO ANDALO', NULL, NULL, '(17) 3266-9393', 'Av. Dr. Alberto Andaló | Frente Automóvel Clube | Viaduto – Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-26 16:21:35', '2016-03-26 17:26:01', 14, 5012, '15015-000', 'Avenida Doutor Alberto Andaló', 'SN', 'Lat -20.811458 Log -49.375752', NULL, 1),
(10082, ' 004.1 | OUTDOOR | AV. DR. ALBERTO ANDALO', NULL, NULL, '(17) 3266-9393', 'Av. Dr. Alberto Andaló | Lado Automóvel Clube | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-26 16:25:35', '2016-03-26 17:25:56', 14, 5012, '15015-000', 'Avenida Doutor Alberto Andaló', 'SN', 'Lat -20.812035 Log  -49.376122', NULL, 1),
(10083, ' 004.2 | OUTDOOR | AV. DR. ALBERTO ANDALO', NULL, NULL, '(17) 3266-9393', 'Av. Dr. Alberto Andaló | Lado Automóvel Clube | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-26 16:26:56', '2016-03-26 17:25:50', 14, 5012, '15015-000', 'Avenida Doutor Alberto Andaló', 'SN', 'Lat -20.812035 Log -49.376122', NULL, 1),
(10084, ' 005.1 | OUTDOOR | AV. DR. ALBERTO ANDALO', NULL, NULL, '(17) 3266-9393', 'Av. Dr. Alberto Andaló | Lado Automóvel Clube | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-26 16:29:48', '2016-03-26 17:25:45', 14, 5012, '15015-000', 'Avenida Doutor Alberto Andaló', 'SN', 'Lat -20.81794 Log -49.38193', NULL, 1),
(10085, ' 005.2 | OUTDOOR | AV. DR. ALBERTO ANDALO', NULL, NULL, '(17) 3266-9393', 'Av. Dr. Alberto Andaló | Lado Automóvel Clube | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-26 16:30:56', '2016-03-26 17:25:40', 14, 5012, '15015-000', 'Avenida Doutor Alberto Andaló', 'SN', 'Lat -20.81794 Log -49.38193', NULL, 1),
(10086, ' 005.3 | OUTDOOR | AV. DR. ALBERTO ANDALO', NULL, NULL, '(17) 3266-9393', 'Av. Dr. Alberto Andaló | Lado Automóvel Clube | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-26 16:32:03', '2016-03-26 17:25:34', 14, 5012, '15015-000', 'Avenida Doutor Alberto Andaló', 'SN', 'Lat -20.81794 Log -49.38193', NULL, 1),
(10087, ' 005.4 | OUTDOOR | AV. DR. ALBERTO ANDALO', NULL, NULL, '(17) 3266-9393', 'Av. Dr. Alberto Andaló | Lado Automóvel Clube | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-26 16:35:44', '2016-03-26 17:25:28', 14, 5012, '15015-000', 'Avenida Doutor Alberto Andaló', 'SN', 'Lat -20.818283 Log -49.382147', NULL, 1),
(10088, ' 005.5 | OUTDOOR | AV. DR. ALBERTO ANDALO', NULL, NULL, '(17) 3266-9393', 'Av. Dr. Alberto Andaló | Lado Automóvel Clube | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-26 16:37:03', '2016-03-26 17:25:22', 14, 5012, '15015-000', 'Avenida Doutor Alberto Andaló', 'SN', 'Lat -20.818283 Log -49.382147', NULL, 1),
(10089, ' 006.1 | OUTDOOR | AV. FELICIANO SALLES CUNHA', NULL, NULL, '(17) 3266-9393', 'Av. Feliciano Salles Cunha | Lado Posto Canaã | Frente Unilago | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-26 16:59:45', '2016-03-26 17:25:17', 131, 5012, '15035-000', 'Avenida Feliciano Salles Cunha', 'SN', 'Lat -20.809675 Log -49.401317', NULL, 1),
(10090, ' 006.2 | OUTDOOR | AV. FELICIANO SALLES CUNHA', NULL, NULL, '(17) 3266-9393', 'Av. Feliciano Salles Cunha | Lado Posto Canaã | Frente Unilago | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-26 17:01:01', '2016-03-26 17:24:38', 131, 5012, '15035-000', 'Avenida Feliciano Salles Cunha', 'SN', 'Lat -20.809675 Log -49.401317', NULL, 1),
(10091, ' 007.U | OUTDOOR | R. RUBIAO JUNIOR', NULL, NULL, '(17) 3266-9393', 'R. Rubião Junior | Lado Colégio Santo André | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-26 17:03:34', '2016-03-26 17:24:32', 14, 5012, '15010-090', 'Rua Rubião Júnior - de 2601/2602 a 3398/3399', 'SN', 'Lat -20.817561 Log -49.379752', NULL, 1),
(10092, ' 009.1 | OUTDOOR | AV. ANISIO HADDAD', NULL, NULL, '(17) 3266-9393', 'Av. Anísio Haddad | Frente Oficial Academia | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-26 17:12:27', '2016-03-26 17:24:26', 134, 5012, '15091-380', 'Avenida Anísio Haddad - até 7400 - lado par', 'SN', 'Lat -20.841201 Log -49.40191', NULL, 1),
(10093, ' 009.2 | OUTDOOR | AV. ANISIO HADDAD', NULL, NULL, '(17) 3266-9393', 'Av. Anísio Haddad | Frente Oficial Academia | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-26 17:17:05', '2016-03-26 17:24:19', 134, 5012, '15091-380', 'Avenida Anísio Haddad - até 7400 - lado par', 'SN', 'Lat -20.841201 Log -49.40191', NULL, 1),
(10094, ' 009.3 | OUTDOOR | AV. ANISIO HADDAD', NULL, NULL, '(17) 3266-9393', 'Av. Anísio Haddad | Frente Oficial Academia | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-26 17:20:28', '2016-03-26 17:24:13', 134, 5012, '15091-380', 'Avenida Anísio Haddad - até 7400 - lado par', 'SN', 'Lat -20.841201 Log -49.40191', NULL, 1),
(10095, ' 010.1 | OUTDOOR | AV. ANISIO HADDAD', NULL, NULL, '(17) 3266-9393', 'Av. Anísio Haddad | Lado Oficial Academia | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-26 17:43:14', '2016-03-26 17:50:34', 137, 5012, '15090-365', 'Avenida Anísio Haddad - de 7167 a 7399 - lado ímpar', 'SN', 'Lat -20.8424 Log -49.40223', NULL, 1),
(10096, ' 010.2 | OUTDOOR | AV. ANISIO HADDAD', NULL, NULL, '(17) 3266-9393', 'Av. Anísio Haddad | Lado Oficial Academia | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-26 17:44:54', '2016-03-26 17:49:35', 137, 5012, '15090-365', 'Avenida Anísio Haddad - de 7167 a 7399 - lado ímpar', 'SN', 'Lat -20.8424 Log -49.40223', NULL, 1),
(10097, ' 010.3 | OUTDOOR | AV. ANISIO HADDAD', NULL, NULL, '(17) 3266-9393', 'Av. Anísio Haddad | Lado Oficial Academia | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-26 17:48:38', '2016-03-26 17:49:27', 137, 5012, '15090-365', 'Avenida Anísio Haddad - de 7167 a 7399 - lado ímpar', 'SN', 'Lat -20.842497 Log -49.402264', NULL, 1),
(10098, ' 012.1 | OUTDOOR | AV. ANISIO HADDAD', NULL, NULL, '(17) 3266-9393', 'Av. Anísio Haddad | Frente Alarme | Muro Faceres | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-26 18:57:40', '2016-03-26 19:44:04', 137, 5012, '15090-365', 'Avenida Anísio Haddad - de 7167 a 7399 - lado ímpar', 'SN', 'Lat -20.839332 Log -49.401289', NULL, 1),
(10099, ' 012.2 | OUTDOOR | AV. ANISIO HADDAD', NULL, NULL, '(17) 3266-9393', 'Av. Anísio Haddad | Frente Alarme | Muro Faceres | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-26 18:59:34', '2016-03-26 19:43:58', 137, 5012, '15090-365', 'Avenida Anísio Haddad - de 7167 a 7399 - lado ímpar', 'SN', 'Lat -20.839332 Log -49.401289', NULL, 1),
(10100, ' 012.3 | OUTDOOR | AV. ANISIO HADDAD', NULL, NULL, '(17) 3266-9393', 'Av. Anísio Haddad | Frente Alarme | Muro Faceres | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-26 19:01:12', '2016-03-26 19:43:53', 137, 5012, '15090-365', 'Avenida Anísio Haddad - de 7167 a 7399 - lado ímpar', 'SN', 'Lat -20.839332 Log -49.401289', NULL, 1),
(10101, ' 014.1 | OUTDOOR | AV. DR. ANTONIO TAVARES PEREIRA LIMA', NULL, NULL, '(17) 3266-9393', 'Av. Dr. Antônio Tavares Pereira Lima | Próx. Canecão | Represa | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-26 19:05:32', '2016-03-26 19:43:44', 143, 5012, '15061-220', 'Avenida Doutor Antônio Tavares Pereira Lima', 'SN', 'Lat -20.804991 Log -49.360726', NULL, 1),
(10102, ' 014.2 | OUTDOOR | AV. DR. ANTONIO TAVARES PEREIRA LIMA', NULL, NULL, '(17) 3266-9393', 'Av. Dr. Antônio Tavares Pereira Lima | Próx. Canecão | Represa | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-26 19:06:53', '2016-03-26 19:43:38', 143, 5012, '15061-220', 'Avenida Doutor Antônio Tavares Pereira Lima', 'SN', 'Lat -20.804315 Log -49.360586', NULL, 1),
(10103, ' 014.3 | OUTDOOR | AV. DR. ANTONIO TAVARES PEREIRA LIMA', NULL, NULL, '(17) 3266-9393', 'Av. Dr. Antônio Tavares Pereira Lima | Próx. Canecão | Represa | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-26 19:09:25', '2016-03-26 19:43:29', 143, 5012, '15061-220', 'Avenida Doutor Antônio Tavares Pereira Lima', 'SN', 'Lat -20.804315 Log -49.360586 ', NULL, 1),
(10104, ' 017.1 | OUTDOOR | AV. BADY BASSITT', NULL, NULL, '(17) 3266-9393', 'Av. Bady Bassitt | R. Independência| Frente Americanflex | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-26 19:17:08', '2016-03-26 19:43:24', 14, 5012, '15015-700', 'Avenida Bady Bassitt - lado ímpar', 'SN', 'Lat -20.812245 Log -49.388046', NULL, 1),
(10105, ' 017.2 | OUTDOOR | AV. BADY BASSITT', NULL, NULL, '(17) 3266-9393', 'Av. Bady Bassitt | R. Independência| Frente Americanflex | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-26 19:20:11', '2016-03-26 19:42:56', 14, 5012, '15015-700', 'Avenida Bady Bassitt - lado ímpar', 'SN', 'Lat -20.812245 Log -49.388046', NULL, 1),
(10106, ' 017.3 | OUTDOOR | AV. BADY BASSITT', NULL, NULL, '(17) 3266-9393', 'Av. Bady Bassitt | R. Independência| Frente Americanflex | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-26 19:21:24', '2016-03-26 19:42:50', 14, 5012, '15015-700', 'Avenida Bady Bassitt - lado ímpar', 'SN', 'Lat -20.812245 Log -49.388046', NULL, 1),
(10107, ' 018.1 | OUTDOOR | AV. BADY BASSITT', NULL, NULL, '(17) 3266-9393', 'Av. Bady Bassitt | R. Luiz Vaz de Camões | Frente Droga Raia | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-26 19:34:15', '2016-03-26 19:42:44', 14, 5012, '15015-700', 'Avenida Bady Bassitt - lado ímpar', 'SN', 'Lat -20.816829 Log -49.394076', NULL, 1),
(10108, ' 018.2 | OUTDOOR | AV. BADY BASSITT', NULL, NULL, '(17) 3266-9393', 'Av. Bady Bassitt | R. Luiz Vaz de Camões | Frente Droga Raia | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-26 19:36:46', '2016-03-26 19:42:37', 14, 5012, '15015-700', 'Avenida Bady Bassitt - lado ímpar', 'SN', 'Lat -20.816829 Log -49.394076', NULL, 1),
(10109, ' 018.3 | OUTDOOR | AV. BADY BASSITT', NULL, NULL, '(17) 3266-9393', 'Av. Bady Bassitt | R. Luiz Vaz de Camões | Frente Droga Raia | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-26 19:38:36', '2016-03-26 19:42:18', 14, 5012, '15015-700', 'Avenida Bady Bassitt - lado ímpar', 'SN', 'Lat -20.817275 Log -49.3947', NULL, 1),
(10110, ' 018.4 | OUTDOOR | AV. BADY BASSITT', NULL, NULL, '(17) 3266-9393', 'Av. Bady Bassitt | R. Luiz Vaz de Camões | Frente Droga Raia | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-26 19:39:57', '2016-03-26 19:42:12', 14, 5012, '15015-700', 'Avenida Bady Bassitt - lado ímpar', 'SN', 'Lat -20.817275 Log -49.3947', NULL, 1),
(10111, ' 018.5 | OUTDOOR | AV. BADY BASSITT', NULL, NULL, '(17) 3266-9393', 'Av. Bady Bassitt | R. Luiz Vaz de Camões | Frente Droga Raia | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-26 19:41:44', '2016-03-26 19:42:06', 14, 5012, '15015-700', 'Avenida Bady Bassitt - lado ímpar', 'SN', 'Lat -20.817275 Log -49.3947', NULL, 1),
(10112, ' 019.1 | OUTDOOR | AV. BADY BASSITT', NULL, NULL, '(17) 3266-9393', 'Av. Bady Bassitt | R. Prudente de Moraes | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-26 19:49:51', '2016-03-26 20:05:10', 14, 5012, '15015-700', 'Avenida Bady Bassitt - lado ímpar', 'SN', 'Lat -20.807622 Log -49.380402', NULL, 1),
(10113, ' 019.2 | OUTDOOR | AV. BADY BASSITT', NULL, NULL, '(17) 3266-9393', 'Av. Bady Bassitt | R. Prudente de Moraes | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-26 19:51:09', '2016-03-26 20:05:04', 14, 5012, '15015-700', 'Avenida Bady Bassitt - lado ímpar', 'SN', 'Lat -20.807622 Log -49.380402', NULL, 1),
(10114, ' 020.1 | OUTDOOR | AV. BADY BASSITT', NULL, NULL, '(17) 3266-9393', 'Av. Bady Bassitt | R. Siqueira Campos | Prox. Uniseb FGV | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-26 19:54:28', '2016-03-26 20:04:49', 156, 5012, '15025-000', 'Avenida Bady Bassitt - lado par', 'SN', 'Lat -20.808714 Log -49.382268', NULL, 1),
(10115, ' 020.2 | OUTDOOR | AV. BADY BASSITT', NULL, NULL, '(17) 3266-9393', 'Av. Bady Bassitt | R. Siqueira Campos | Prox. Uniseb FGV | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-26 19:55:56', '2016-03-26 20:04:43', 156, 5012, '15025-000', 'Avenida Bady Bassitt - lado par', 'SN', 'Lat -20.808714 Log -49.382268', NULL, 1),
(10116, ' 020.3 | OUTDOOR | AV. BADY BASSITT', NULL, NULL, '(17) 3266-9393', 'Av. Bady Bassitt | R. Siqueira Campos | Prox. Uniseb FGV | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-26 19:57:06', '2016-03-26 20:04:37', 156, 5012, '15025-000', 'Avenida Bady Bassitt - lado par', 'SN', 'Lat -20.808714 Log -49.382268', NULL, 1),
(10117, ' 021.1 | OUTDOOR | AV. BADY BASSITT', NULL, NULL, '(17) 3266-9393', 'Av. Bady Bassitt | Viaduto Jordão Reis | Muro Palestra Esporte Clube | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-26 20:07:30', '2016-03-26 20:14:38', 156, 5012, '15025-000', 'Avenida Bady Bassitt - lado par', 'SN', 'Lat -20.806491 Log -49.379373', NULL, 1),
(10118, ' 021.2 | OUTDOOR | AV. BADY BASSITT', NULL, NULL, '(17) 3266-9393', 'Av. Bady Bassitt | Viaduto Jordão Reis | Muro Palestra Esporte Clube | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-26 20:08:32', '2016-03-26 20:14:35', 156, 5012, '15025-000', 'Avenida Bady Bassitt - lado par', 'SN', 'Lat -20.806491 Log -49.379373', NULL, 1),
(10119, ' 026.1 | OUTDOOR |AV. BRIGADEIRO FARIA LIMA', NULL, NULL, '(17) 3266-9393', 'Av. Brigadeiro Faria Lima | Av. Francisco C. Oliveira | Rio Preto Shopping | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-26 20:14:14', '2016-03-26 20:14:31', 161, 5012, '15090-900', 'Avenida Brigadeiro Faria Lima, 6363', 'SN', 'Lat -20.832849 Log -49.399587', NULL, 1),
(10120, ' R03.1 | OUTDOOR | MIRASSOL | AV. ELIEZER MAGALHAES', NULL, NULL, '(17) 3266-9393', 'Mirassol – Av. Eliezer Magalhães | R. Campos Sales |  Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-28 16:42:33', '2016-03-28 17:35:01', 162, 5012, '15130-000', 'AV. ELIEZER MAGALHAES', 'SN', 'Lat -20.812.079	Log -49.509726', 'Centro', 1),
(10121, ' R03.2 | OUTDOOR | MIRASSOL | AV. ELIEZER MAGALHAES', NULL, NULL, '(17) 3266-9393', 'Mirassol – Av. Eliezer Magalhães | R. Campos Sales |  Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-28 16:46:27', '2016-03-28 17:35:00', 162, 5012, '15130-000', 'AV. ELIEZER MAGALHAES', 'SN', 'Lat -20.812.079	Log -49.509726', 'Centro', 1),
(10122, ' R06.1 | OUTDOOR | MIRASSOL |  AV. MODESTO JOSE MOREIRA', NULL, NULL, '(17) 3266-9393', 'Mirassol – Av. Modesto José Moreira | Ent. Principal | Hosp. Dr. Sicard | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-28 16:50:15', '2016-03-28 17:34:59', 162, 5012, '15130-000', 'AV. MODESTO JOSE MOREIRA', 'SN', 'Lat -20.810426	Log -49.508618', 'Centro', 1),
(10123, ' R06.2 | OUTDOOR | MIRASSOL |  AV. MODESTO JOSE MOREIRA', NULL, NULL, '(17) 3266-9393', 'Mirassol – Av. Modesto José Moreira | Ent. Principal | Hosp. Dr. Sicard | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-28 16:53:14', '2016-03-28 17:34:58', 162, 5012, '15130-000', 'AV. MODESTO JOSE MOREIRA', 'SN', 'Lat -20.810426	Log -49.508618', 'Centro', 1),
(10124, ' R06.3 | OUTDOOR | MIRASSOL |  AV. MODESTO JOSE MOREIRA', NULL, NULL, '(17) 3266-9393', 'Mirassol – Av. Modesto José Moreira | Ent. Principal | Hosp. Dr. Sicard | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-28 16:54:28', '2016-03-28 17:34:56', 162, 5012, '15130-000', 'AV. MODESTO JOSE MOREIRA', 'SN', 'Lat -20.810426	Log -49.508618', 'Centro', 1),
(10125, 'R08.2 | OUTDOOR | MIRASSOL | AV. MODESTO JOSÉ MOREIRA', NULL, NULL, '(17) 3266-9393', 'Mirassol – Av. Modesto José Moreira | Ft. Hosp. Dr. Sicard | Saida P/ S.J.R.P. | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-28 16:56:10', '2016-03-28 17:34:55', 162, 5012, '15130-000', 'AV. MODESTO JOSÉ MOREIRA', 'SN', 'Lat -20.810516	Log -49.508676', 'Centro', 1),
(10126, 'R08.1 | OUTDOOR | MIRASSOL | AV. MODESTO JOSÉ MOREIRA', NULL, NULL, '(17) 3266-9393', 'Mirassol – Av. Modesto José Moreira | Ft. Hosp. Dr. Sicard | Saida P/ S.J.R.P. | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-28 16:57:27', '2016-03-28 17:34:54', 162, 5012, '15130-000', 'AV. MODESTO JOSÉ MOREIRA', 'SN', NULL, 'Centro', 1),
(10127, 'R22.2 | OUTDOOR | MIRASSOL | AV. ELIEZER MAGALHÃES', NULL, NULL, '(17) 3266-9393', 'Mirassol – Av. Eliezer Magalhães | R. São Judas Tadeu | Ld. Direito | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-28 16:59:01', '2016-03-28 17:34:53', 162, 5012, '15130-000', 'AV. ELIEZER MAGALHÃES', 'SN', 'Lat -20.813025	Log -49.502533', 'Centro', 1),
(10128, 'R22.1 | OUTDOOR | MIRASSOL | AV. ELIEZER MAGALHÃES', NULL, NULL, '(17) 3266-9393', 'Mirassol – Av. Eliezer Magalhães | R. São Judas Tadeu | Ld. Direito | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-28 16:59:57', '2016-03-28 17:34:52', 162, 5012, '15130-000', 'AV. ELIEZER MAGALHÃES', 'SN', 'Lat -20.813025	Log -49.502533', 'Centro', 1),
(10129, 'R09.U | OUTDOOR | MONTE APRAZÍVEL', NULL, NULL, '(17) 3266-9393', 'Monte Aprazível – Av. Pedro Rezende | Entrada Por Nipoã | Ft. Represa | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-28 17:06:01', '2016-03-28 17:34:51', 171, 5012, '15150-970', 'Av. Pedro Rezende', 'SN', NULL, NULL, 1),
(10130, ' R10.U | OUTDOOR | NEVES PAULISTA', NULL, NULL, '(17) 3266-9393', 'Neves Paulista | Entrada da Cidade | Trevo | Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-03-28 17:08:53', '2016-03-28 17:34:50', 172, 5012, '15120-000', ' Av. Pedro Rezende', 'SN', 'Lat -20.839071	Log -49.632743', NULL, 1),
(10131, ' R11.U | OUTDOOR | NOVA GRANADA', NULL, NULL, '(17) 3266-9393', 'Nova Granada – Entrada Principal | Trevo | Sent. S.J.R.P. a Nova Granada | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-28 17:11:43', '2016-03-28 17:39:12', 173, 5012, '15440-000', 'Trevo', 'SN', NULL, 'Trevo', 1),
(10132, 'R16.U | OUTDOOR | JACI', NULL, NULL, '(17) 3266-9393', 'Jaci – Entrada Principal Da Cidade | Frente Posto | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-28 17:13:33', '2016-03-28 17:34:48', 174, 5012, '15155-000', 'Entrada Principal', 'SN', 'Lat -20.875279	Log -49.572355', 'Centro', 1),
(10133, 'R19.U | OUTDOOR | POTIRENDABA', NULL, NULL, '(17) 3266-9393', 'Potirendaba – Rodovia João Neves | Entrada Da Cidade | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-28 17:22:28', '2016-03-28 17:34:47', 175, 5012, '15105-000', 'Rodovia João Neves', 'SN', NULL, NULL, 1),
(10134, 'R20.1 | OUTDOOR | BADY BASSITT', NULL, NULL, '(17) 3266-9393', 'Bady Bassitt – Rodovia SP355 | Chácara Santa Luzia | Lado Posto Ale | Rot. Saída Da Cidade – Fte. Porcada São Luis\n\n9,00×3,00m = 27,00m²', '2016-03-28 17:29:17', '2016-03-28 17:34:46', 176, 5012, '15115-000', 'Rodovia SP355 | Chácara Santa Luzia', 'SN', 'Lat -20.899516	Log -49.44013', 'Centro', 1),
(10135, 'R20.2 | OUTDOOR | BADY BASSITT', NULL, NULL, '(17) 3266-9393', 'Bady Bassitt – Rodovia SP355 | Chácara Santa Luzia | Lado Posto Ale | Rot. Saída Da Cidade – Fte. Porcada São Luis\n\n9,00×3,00m = 27,00m²', '2016-03-28 17:30:12', '2016-03-28 17:34:45', 176, 5012, '15115-000', 'Bady Bassitt – Rodovia SP355', 'SN', NULL, 'Centro', 1),
(10136, ' R21.U | OUTDOOR | IBIRA', NULL, NULL, '(17) 3266-9393', 'Ibirá – Vicinal João Pedro Ferraz | KM02 | Entrada Da Cidade | Ft. Móveis Pelinson | Ibirá | Rural\n\n9,00×3,00m = 27,00m²', '2016-03-28 17:32:36', '2016-03-28 17:34:44', 178, 5012, '15860-000', 'Vicinal João Pedro Ferraz', 'KM02', NULL, 'Centro', 1),
(10137, ' R23.U | OUTDOOR | BALSAMO', NULL, NULL, '(17) 3266-9393', 'Bálsamo – Entrada Principal Rotatória | Estancia Luso Brasileira | Sentido: Bairro/Centro\n\n9,00×3,00m = 27,00m²', '2016-03-28 17:33:57', '2016-03-28 17:34:42', 179, 5012, '15140-000', 'Entrada Principal Rotatória', 'SN', NULL, 'Centro', 1),
(10138, 'Terminal Rodoviário e Urbando - São José do Rio Preto', 990.00, 6, '(17) 2139-3401', 'Veiculação de VT de 15" em todas as 44 telas do terminal.\nFrequência estimada de 30 inserções por dia, totalizando 900 inserções por mês.', '2016-03-29 18:24:25', '2016-03-29 19:25:18', 14, 5013, '15010-010', 'Rua Pedro Amaral', '4031', NULL, NULL, 1),
(10139, 'TV Corporativa', NULL, NULL, '(17) 2139-3401', 'Inteligência para comunicação corporativa, desde implementação da estrutura à criação de conteúdos exclusivos para a sua empresa.', '2016-03-29 18:26:49', '2016-03-31 21:47:37', 14, 5013, '15015-110', 'Rua Quinze de Novembro', '3822', NULL, NULL, 1),
(10140, ' 052.4 | OUTDOOR | AV. JUSCELINO K. OLIVEIRA', NULL, NULL, '(17) 3266-9393', 'Av. Juscelino K. Oliveira | R. José Prudêncio Drigo | Ft. Cond. Rodobens | Sentido: Bairro\n\n9,00×3,00m = 27,00m²', '2016-04-01 00:51:53', '2016-04-01 01:44:27', 185, 5012, '15092-259', 'Avenida Presidente Juscelino Kubitschek de Oliveira ', 'SN', NULL, NULL, 1),
(10141, ' 052.5 | OUTDOOR | AV. JUSCELINO K. OLIVEIRA', NULL, NULL, '(17) 3266-9393', 'Av. Juscelino K. Oliveira | R. José Prudêncio Drigo | Ft. Cond. Rodobens | Sentido: Bairro\n\n9,00×3,00m = 27,00m²', '2016-04-01 00:58:07', '2016-04-01 01:44:15', 185, 5012, '15092-259', 'Avenida Presidente Juscelino Kubitschek de Oliveira - de 1152 a 1350 - lado par', 'SN', NULL, NULL, 1),
(10142, ' 053.1 | OUTDOOR | AV. JOSE MUNIA', NULL, NULL, '(17) 3266-9393', 'Av. José Munia | Antes Hotel Saint Paul | Sentido: Centro/Bairro\n\n9,00×3,00m = 27,00m²', '2016-04-01 01:02:24', '2016-04-01 01:44:01', 80, 5012, '15090-045', 'Avenida José Munia - até 5200 - lado par', 'SN', NULL, NULL, 1),
(10143, 'Jornal O Diário de Barretos', NULL, NULL, '(17) 3321-7070', 'O jornal O Diário é um veículo de comunicação do Grupo Monteiro de Barros que tem sua sede em Barretos. Com circulação de terça feira a domingo no formato Standart, suas páginas abordam temas como política, economia, esportes e entretenimento tendo como foco o cotidiano barretense.\n', '2016-04-02 14:52:29', '2016-04-02 15:01:16', 188, 5015, '14781-574', 'Praça Joel Waldo Dal Moro', '01', NULL, NULL, 1),
(10144, 'Portal de Mídia O Diário de Barretos', NULL, NULL, '(17) 3321-7070', 'O Porta de Mídia O Diário é um veículo de comunicação do Grupo Monteiro de Barros que tem sua sede em Barretos. Suas páginas abordam temas como política, economia, esportes e entretenimento tendo como foco o cotidiano barretense.', '2016-04-02 14:57:01', '2016-04-02 15:03:04', 188, 5015, '14781-574', 'Praça Joel Waldo Dal Moro', '01', NULL, NULL, 1),
(10145, 'Rádio O Diário FM - 97.9 FM', NULL, NULL, '(17) 3321-7070', 'O Diário FM, 1º rádio FM de Barretos que une jornalismo e boa música. Através de um conteúdo completo e totalmente direcionado, a rádio O Diário FM proporciona informação e boa música aos seus ouvintes. Oferece a exclusividade de transmitir conteúdos jornalísticos, informativos e musicais de forma intercalada, com variedade e profissionalismo.', '2016-04-03 18:45:58', '2016-04-03 19:07:20', 188, 5015, '14781-574', 'Praça Joel Waldo Dal Moro', '01', NULL, NULL, 1),
(10146, 'Rádio Band FM Barretos - 95.3 FM', NULL, NULL, '(17) 3321-7070', 'Hoje, a Rede Band FM é uma marca presente em cerca de 30 mercados brasileiros, sendo a rede via satélite que mais cresce no Brasil. Seu slogan, SUA RÁDIO DO SEU JEITO, traduz um estilo de programação leve e descontraído, onde artistas e ouvintes se sentem à vontade.', '2016-04-03 18:47:58', '2016-04-03 19:06:53', 188, 5015, '14781-574', 'Praça Joel Waldo Dal Moro', '01', NULL, NULL, 1),
(10147, 'Rádio Colina FM - 105.1 FM', NULL, NULL, '(17) 3321-7070', 'Com o slogan: "A Rádio do Meu Coração", a Colina FM é referência em rádio sertaneja para quase meio milhão de ouvintes distribuídos na região de Barretos. Com sede em Colina, a rádio é uma das emissoras mais tradicionais do Vale do Rio Grande e a primeira da região a tocar 24 horas de música sertaneja.', '2016-04-03 18:53:25', '2016-04-03 19:05:22', 188, 5015, '14781-574', 'Praça Joel Waldo Dal Moro', '01', NULL, NULL, 1),
(10148, 'Rádio Jovem Pan Barretos - 101.5 FM', NULL, NULL, '(17) 3321-7070', 'A Jovem Pan FM estreou em Barretos em 1 de Setembro de 1997 e, assim como sua matriz, surgiu com ideias novas que revolucionaram a rádio FM no Brasil. Desde a linguagem jovem até uma plástica que passou a ser uma referência para o bom gosto e para a própria modernidade do rádio no país.', '2016-04-03 18:55:17', '2016-04-03 19:05:11', 188, 5015, '14781-574', 'Praça Joel Waldo Dal Moro', '01', NULL, NULL, 1),
(10149, 'Rádio Independente AM - 1010 AM', NULL, NULL, '(17) 3321-7070', 'Com uma programação voltada baseada no tripé, informação, prestação de serviços, e utilidade pública, a Independente AM segue a risca o slogan da rede Bandeirantes "A rádio que tem opinião". Mantendo a tradição, conta com um renomado time de jornalistas e comunicadores, que fazem da emissora, a mais ouvida da cidade no segmento.', '2016-04-03 18:56:51', '2016-04-03 19:04:25', 188, 5015, '14781-574', 'Praça Joel Waldo Dal Moro', '01', NULL, NULL, 1),
(10150, 'Rádio Jovem Pan News Barretos - 1140 AM', NULL, NULL, '(17) 3321-7070', 'A Jovem Pan News é uma rádio com programação 24 horas fundamentalmente de notícias e esportes. Com abrangência nacional, a grade inclui programas com a assinatura da equipe Jovem Pan de jornalismo e boletins que atualizam o ouvinte a cada 30 minutos - com informação, prestação de serviço e opinião dos comentaristas/consultores.', '2016-04-03 18:58:40', '2016-04-03 19:02:40', 188, 5015, '14781-574', 'Praça Joel Waldo Dal Moro', '01', NULL, NULL, 1),
(10151, 'The Club JK', NULL, NULL, '(17) 3013-4393', 'Uma estrutura foi especialmente construída na Avenida Juscelino Kubitschek n° 670 para ser sede da boate que  reveza entre atrações sertanejas e música eletrônica.\n\nEm cada detalhe é possível identificar a atmosfera da casa, com requinte e sofisticação. Com capacidade para mais de 1mil pessoas, a The Club JK conta com um palco e estrutura de shows inéditos. A boate além das programações entre sexta-feira e sábado,  também é o endereço de shows especiais.', '2016-04-04 14:25:50', '2016-04-04 14:32:56', 203, 5018, '15091-450', 'Avenida Presidente Juscelino Kubitschek de Oliveira', '670', NULL, NULL, 1),
(10152, 'Mansão JK Eventos', NULL, NULL, '(17) 3234-3749', NULL, '2016-04-04 14:28:29', '2016-04-04 14:32:53', 204, 5018, '15014-210', 'Rua Minas Gerais', '565', NULL, NULL, 1),
(10153, 'Mittos CLub', NULL, NULL, '(17) 9979-10194', NULL, '2016-04-04 14:32:26', '2016-04-04 14:32:51', 205, 5018, '15400-000', 'Av.: Aurora Fort Neves', '346', NULL, 'Centro', 1),
(10154, 'Em Vista Outdoor', NULL, NULL, '(17) 3321-7070', 'A Em Vista reserva a seus clientes localizações privilegiadas em pontos de outdoor e painéis eletrônicos. São mais de 100 pontos em Barretos, Bebedouro, Guaria e região. Impactam o público com amplas dimensões e vantagens da mídia, com grande destaque visual e 24 horas de exposição ', '2016-04-04 14:43:17', '2016-04-04 14:54:09', 188, 5015, '14781-574', 'Praça Joel Waldo Dal Moro', '1', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_anuncio_foto`
--

CREATE TABLE IF NOT EXISTS `tb_anuncio_foto` (
  `anuncio_foto_id` int(11) NOT NULL AUTO_INCREMENT,
  `anuncio_foto_url` varchar(36) NOT NULL,
  `anuncio_id` int(11) NOT NULL,
  `anuncio_foto_destaque` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`anuncio_foto_id`),
  KEY `taf001_ix` (`anuncio_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=225 ;

--
-- Fazendo dump de dados para tabela `tb_anuncio_foto`
--

INSERT INTO `tb_anuncio_foto` (`anuncio_foto_id`, `anuncio_foto_url`, `anuncio_id`, `anuncio_foto_destaque`) VALUES
(62, 'de049aa6ebe485da2715b91bab1f5b35.jpg', 10013, 1),
(63, '9a143a854336c82ac0fc4a5d4af2b3c7.jpg', 10014, 1),
(64, 'e9dcabc650b3d87a5fdf7c6262efc437.jpg', 10015, 1),
(65, 'c01ca0f40ca219bdeafa0e59d03fd9fd.jpg', 10016, 1),
(66, '212d70db753658f6c61d883e903a9c92.jpg', 10017, 1),
(67, '233df861cbd3189791fae12f898e09b9.jpg', 10018, 1),
(68, 'd3a2767599ee29401f2aacaf3952a5ab.jpg', 10019, 1),
(69, 'e156797aa20bad996f897826065e2f7c.jpg', 10020, 1),
(70, '87734e4accec85c5b23fd535b826c070.jpg', 10021, 1),
(72, '278c499a407161d6cebf569fe92185be.jpg', 10023, 1),
(73, 'e4a5637d33607f8cb57cf9a83dad8116.jpg', 10024, 1),
(74, 'b7c859170f618b90d304777005d396b0.jpg', 10022, 1),
(75, '06f43e7dd0506b28726d7a3b02c66460.jpg', 10025, 1),
(76, 'de6e7e5926e3c49d09436a8051cdfb49.jpg', 10026, 1),
(77, '7772b6b98eb40b59e49406c68530884e.jpg', 10027, 1),
(78, '57262c2216b8bdd8f760869f232854d6.jpg', 10028, 1),
(79, '41b00ab41fba3ed0c3df0acf06d6810c.jpg', 10029, 1),
(80, '5773dcf0ba1f5c1c0fa6138e79142402.jpg', 10030, 1),
(81, 'd1503d378e6b9667ee5b5f7d706a6026.jpg', 10032, 1),
(82, '28eecaf7b80397f914a29ce4ae8ffb55.jpg', 10034, 1),
(83, '7789cd02e3e24f7a69faadadf768f0a3.jpg', 10035, 1),
(84, '843fafc68af1cb3f5196e03ac8485984.jpg', 10036, 1),
(86, '3a57963b8f6350b7d8b32cd9e33b8140.jpg', 10041, 1),
(87, '4847870ae26635e287fc32c1728e0667.jpg', 10042, 1),
(88, '69244a29537d7baeefce6621b86e2132.jpg', 10043, 1),
(90, '6b3ea96caa0f5cb0894472d24dfe6cf4.jpg', 10044, 1),
(92, '5cc48a4dceb9af7c4a1013236626cc64.jpg', 10046, 1),
(102, 'c771ca52b78ff2319dea71b4d0ef192a.jpg', 10055, 1),
(103, '3453b45ce6743bb108678e324b863802.jpg', 10054, 1),
(104, '2da5d6008829a6fe057199775c19e5b8.jpg', 10053, 1),
(105, '1d9344bb0a1dbf99797628ea07e3119c.jpg', 10052, 1),
(106, '8911f352c85ba45cce93192d21142318.jpg', 10051, 1),
(107, '6a8f79d5d531ab1792da686d51aa3c48.jpg', 10050, 1),
(108, '26309498195a4a52049aca50d762f34e.jpg', 10049, 1),
(109, '86a5f25e84945b49f1b66064e3f1f109.jpg', 10048, 1),
(110, '2f4aa1e603f9a9652e67f36ae7ae8ce3.jpg', 10047, 1),
(111, '2e0ae1c3818e83175158c10463abc6d3.jpg', 10056, 1),
(112, '2ce260882079770bf88d969dff8bf766.jpg', 10057, 1),
(113, 'fc9413d09048fa7be000f7e90b25190d.jpg', 10058, 1),
(114, 'a120bd8d8fc02b0a0d991b7afce2b622.jpg', 10059, 1),
(115, 'c03ca310073669f80c488d42a19cf3d5.jpg', 10060, 1),
(117, 'a4a28f4629fa468639a6c32f8959879b.jpg', 10062, 1),
(118, '5b49a8a79c0a65a31bd91237cb259f61.jpg', 10063, 1),
(119, '2ab2bb9c2980e8c13b4ea269417a6940.jpg', 10064, 1),
(120, 'd75b3e3ea1c4e7d3075b8e593964a341.jpg', 10065, 1),
(121, '4a332cb981a1e2c2c6170f4fb2bdea55.jpg', 10066, 1),
(122, 'f3a83be27ea747128f6f0d2f98cc292d.jpg', 10061, 1),
(123, '0119b3b30f48622814a136f990ae1206.jpg', 10067, 1),
(124, 'ee757e7a7cc5d6c9e0a1415c665cec43.jpg', 10068, 1),
(125, '1fa0edfe1a6ac526a3640460ed981972.jpg', 10069, 1),
(126, 'eeaae4a42680cb75a0b683e352b6e479.jpg', 10070, 1),
(127, '64d8a6028f3e5293d6e335db9a041a2e.jpg', 10071, 1),
(128, 'c67f07e5610a2273712b3b295b442a97.jpg', 10072, 1),
(129, '50e2251c1ec2df6a76597e9f3fdb53ab.jpg', 10073, 1),
(130, 'a48171a88dd1c846537b9f435aab9d36.jpg', 10074, 1),
(131, '23c043b1305a19ffe3b0b4400045da58.jpg', 10075, 1),
(132, 'ad4c72bdbe957b1abbfd0eff92952e95.jpg', 10045, 1),
(133, 'e8f4cd7568b18ad27449f5dba6bda3d7.jpg', 10076, 1),
(134, '1c02e68569c0cff1986a4c4b993e5bc0.jpg', 10077, 1),
(135, '56faa79ca845481c26d400ead2533929.jpg', 10078, 1),
(136, '7b3d23f439fbb4eada34c477f9c02e29.jpg', 10079, 1),
(137, '2a79bc1c4143f539b0dea6b4673a04c8.jpg', 10080, 1),
(138, '9f7d2514462d459c7d84482b910d913d.jpg', 10081, 1),
(139, '96c3ad019e5f3a3f91a4b8adfc05b6c3.jpg', 10082, 1),
(140, 'f4d731745ba615d2ff90a41ae8bf4fb4.jpg', 10083, 1),
(141, 'fe1abc73fdb19f05f55abb3ecf489104.jpg', 10084, 1),
(142, 'b4ff9dec08ea07c985b598855496e3e8.jpg', 10085, 1),
(143, 'cc219475d7d68129efdc81dac275be5e.jpg', 10086, 1),
(144, 'f7a517a3be178858f92978c9edc159a2.jpg', 10087, 1),
(145, 'f66812ff04afcf5d74a793b7c15de017.jpg', 10088, 1),
(146, 'c865851a6ff218ee83342b1634c631af.jpg', 10089, 1),
(147, 'c5174f7be1293deb9167b0dd5275bbfa.jpg', 10090, 1),
(148, 'f719a2e973676f0f372f91191a345ac3.jpg', 10091, 1),
(149, 'a9aa39b61439c8f235f33803aa853b01.jpg', 10092, 1),
(150, '8e0fd53eb5237cbdf6c9c0a2df1b5ff7.jpg', 10093, 1),
(151, 'a8b8cc0636ac3da6a2286751b4504e8d.jpg', 10094, 1),
(152, 'b7bfa39d6927f4472f5d0588d4a0e89d.jpg', 10095, 1),
(153, 'e82ec40e5812b11e0cc90360aabbaba0.jpg', 10096, 1),
(154, '22ebd7dcda57adffc18bf1394fd33169.jpg', 10097, 1),
(155, '2966c99243458be4e258fda546e2a054.jpg', 10098, 1),
(156, 'fd9b51ff8c98e321a338417a70e19acf.jpg', 10099, 1),
(157, 'ae441b4cfbecf25fc3d2b9c21f6ee9e9.jpg', 10100, 1),
(158, '0932a02680237286490026bdef226f90.jpg', 10101, 1),
(159, 'c78ed3d8dbb0484eabc0201f1be31029.jpg', 10102, 1),
(160, 'b17d8d3f85d03337e2f0bbe480655687.jpg', 10103, 1),
(161, '9e26f006172d181cc98c012cb9855052.jpg', 10104, 1),
(162, 'c137168d9af5ef3267b9f4fdb927d007.jpg', 10105, 1),
(163, '9167254b38b1d2789c0b453049776149.jpg', 10106, 1),
(164, '1d60dc14a9abad4dfb018f38b935bb7c.jpg', 10107, 1),
(165, 'c8c6fdcda2bdd8e1de06f552d5ae1cb7.jpg', 10108, 1),
(166, '3cbe8d8ace028889dbf0459fe4ed3f77.jpg', 10109, 1),
(167, '975734719b48d550d1673abce650df96.jpg', 10110, 1),
(168, '3f16d054066ace272a7190da83f477ec.jpg', 10111, 1),
(169, '5b571ca415361a0d745eec366b63a726.jpg', 10112, 1),
(170, '314ab7e53a005d200bc7ba02cecf7a30.jpg', 10113, 1),
(171, 'dc7095556775a172fc2c61fec0b39e6b.jpg', 10114, 1),
(172, '682813db10661c6548df31a7ed9637b4.jpg', 10115, 1),
(173, '135237b8bd53063e3787053ddb178602.jpg', 10116, 1),
(174, 'd3fc69165b06da8329db2fa586453441.jpg', 10117, 1),
(175, '5e7b8308048dab0f8aa291658da79df2.jpg', 10118, 1),
(176, 'bddf79456ce0901b1f16f37cf0cbe1e4.jpg', 10119, 1),
(177, '8e979bcb0b1695bfc830a04465b7451a.jpg', 10120, 1),
(178, 'd918802f9d46d16a769ea246f072fb00.jpg', 10121, 1),
(179, '9c35906dda08fcf308c49dcf5f1bcd70.jpg', 10122, 1),
(180, '980f6e5de5a940c6be2f0bf7ddd163de.jpg', 10123, 1),
(181, '78e5659b4485077d883dc81e55276cd5.jpg', 10124, 1),
(182, 'b09aa810125b23e787c66b10169cae57.jpg', 10125, 1),
(183, '45b49c66d18c8b4b99f4cfab5d60667c.jpg', 10126, 1),
(184, '92429cd0988fb9a1ecbcec98bd340f3e.jpg', 10127, 1),
(185, '304e14bd418891c0237b7b02fd9aa899.jpg', 10128, 1),
(186, '1376c7d7f6abed581e7abfd93b69b46c.jpg', 10129, 1),
(187, '866d2711f4a891422a92efb905021930.jpg', 10130, 1),
(189, 'f1e8da3c6d69ade8cb3f0f60293fd0bc.jpg', 10132, 1),
(190, '9b6b675fda1fe17e5dba712c9fed2d9f.jpg', 10133, 1),
(191, '82e7dc955f369a2ee7fffbae4f9ab078.jpg', 10134, 1),
(192, '02be310c9eedcaa3e73ba01eb3ff6380.jpg', 10135, 1),
(193, '0ff9e4f0d728666d644e3827c8700631.jpg', 10136, 1),
(194, '1a2fbf2eec2d7a897755418d7a3ccef9.jpg', 10137, 1),
(195, 'd066d265eda15e765e141e055c298601.jpg', 10131, 1),
(199, 'bcb7fd3c3d5ea1693c667a0342aa7ddb.jpg', 10138, 1),
(200, '9c03ca526af7d52695c0cb844abc2d9b.jpg', 10138, 0),
(201, '571698e31cf44f1819a3bf0621218427.jpg', 10138, 0),
(202, '84ec7accec9dc2a6c1d0b091eaf29e50.jpg', 10139, 1),
(203, '27530ddcd899a1610483f98dff9c8162.jpg', 10140, 1),
(204, '6fdfc067aa54046c1bf6ce23be2796c3.jpg', 10141, 1),
(205, '192799a6781b4b67e14ecc89f7a6b05a.jpg', 10142, 1),
(208, '67b6977f4dbbcc12d1d9e3df366da897.jpg', 10143, 1),
(209, 'b3afaa92d8d88d7d2544f62a2abe30fc.jpg', 10144, 1),
(212, 'b8be9dac5bd74d03b3f42485a2225986.jpg', 10147, 1),
(213, '96a51b1c7abb652cf431ce172b26ef0e.jpg', 10148, 1),
(216, '38df103dc4eba999281764b3c1bfe9fb.jpg', 10150, 1),
(217, '73608031ea3dacbd27184dd4cc6adbdb.jpg', 10149, 1),
(219, '44320be497ffc36c0ea1f5d614ce627f.jpg', 10146, 1),
(220, 'bdedfa4fdaddef73a1791e0ce0a57f3e.jpg', 10145, 1),
(221, '69755e86284ee911ea6f0faa2f764200.jpg', 10151, 1),
(222, '9c52652403e0e8d73e32091e541f43eb.jpg', 10152, 1),
(223, '13495958d7d42f848af89460891f271e.jpg', 10153, 1),
(224, 'b12dac5a94f4bded5e555ff35bdedb9a.jpg', 10154, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_anuncio_interesse`
--

CREATE TABLE IF NOT EXISTS `tb_anuncio_interesse` (
  `anuncio_id` int(11) NOT NULL,
  `interesse_item_id` int(11) NOT NULL,
  KEY `tai001_ix` (`anuncio_id`),
  KEY `tai002_ix` (`interesse_item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `tb_anuncio_interesse`
--

INSERT INTO `tb_anuncio_interesse` (`anuncio_id`, `interesse_item_id`) VALUES
(10013, 5),
(10014, 5),
(10015, 5),
(10016, 5),
(10017, 5),
(10018, 5),
(10019, 5),
(10020, 5),
(10021, 5),
(10023, 5),
(10024, 5),
(10022, 5),
(10025, 5),
(10026, 5),
(10027, 5),
(10028, 5),
(10029, 5),
(10030, 5),
(10032, 5),
(10034, 5),
(10035, 5),
(10036, 5),
(10041, 5),
(10042, 5),
(10043, 5),
(10044, 5),
(10046, 5),
(10055, 5),
(10054, 5),
(10053, 5),
(10052, 5),
(10051, 5),
(10050, 5),
(10049, 5),
(10048, 5),
(10047, 5),
(10056, 5),
(10057, 5),
(10058, 5),
(10059, 5),
(10060, 5),
(10062, 5),
(10063, 5),
(10064, 5),
(10065, 5),
(10066, 5),
(10061, 5),
(10067, 5),
(10068, 5),
(10069, 5),
(10070, 5),
(10071, 5),
(10072, 5),
(10073, 5),
(10074, 5),
(10075, 5),
(10045, 5),
(10076, 5),
(10077, 5),
(10078, 5),
(10079, 5),
(10080, 5),
(10081, 5),
(10082, 5),
(10083, 5),
(10084, 5),
(10085, 5),
(10086, 5),
(10087, 5),
(10088, 5),
(10089, 5),
(10090, 5),
(10091, 5),
(10092, 5),
(10093, 5),
(10094, 5),
(10095, 5),
(10096, 5),
(10097, 5),
(10098, 5),
(10099, 5),
(10100, 5),
(10101, 5),
(10102, 5),
(10103, 5),
(10104, 5),
(10105, 5),
(10106, 5),
(10107, 5),
(10108, 5),
(10109, 5),
(10110, 5),
(10111, 5),
(10112, 5),
(10113, 5),
(10114, 5),
(10115, 5),
(10116, 5),
(10117, 5),
(10118, 5),
(10119, 5),
(10120, 5),
(10121, 5),
(10122, 5),
(10123, 5),
(10124, 5),
(10125, 5),
(10126, 5),
(10127, 5),
(10128, 5),
(10129, 5),
(10130, 5),
(10132, 5),
(10133, 5),
(10134, 5),
(10135, 5),
(10136, 5),
(10137, 5),
(10131, 5),
(10138, 13),
(10138, 7),
(10138, 4),
(10139, 7),
(10139, 4),
(10140, 5),
(10141, 5),
(10142, 5),
(10143, 18),
(10144, 23),
(10147, 2),
(10148, 2),
(10150, 2),
(10149, 2),
(10146, 2),
(10145, 2),
(10151, 20),
(10151, 34),
(10151, 55),
(10151, 56),
(10152, 20),
(10152, 34),
(10152, 55),
(10152, 56),
(10153, 20),
(10153, 34),
(10153, 55),
(10153, 56),
(10154, 8),
(10154, 43),
(10154, 5),
(10154, 7);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_anuncio_relatorio`
--

CREATE TABLE IF NOT EXISTS `tb_anuncio_relatorio` (
  `anuncio_relatorio_quantidade` int(11) DEFAULT '1',
  `anuncio_relatorio_data` date NOT NULL,
  `anuncio_id` int(11) NOT NULL,
  UNIQUE KEY `anuncio_relatorio_data` (`anuncio_relatorio_data`,`anuncio_id`),
  KEY `tar001_ix` (`anuncio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `tb_anuncio_relatorio`
--

INSERT INTO `tb_anuncio_relatorio` (`anuncio_relatorio_quantidade`, `anuncio_relatorio_data`, `anuncio_id`) VALUES
(1, '2016-03-18', 10013),
(1, '2016-03-18', 10036),
(1, '2016-03-18', 10044),
(1, '2016-03-23', 10075),
(1, '2016-03-26', 10075),
(1, '2016-03-28', 10133),
(1, '2016-03-29', 10137),
(1, '2016-03-30', 10129),
(1, '2016-03-30', 10130),
(1, '2016-03-30', 10137),
(1, '2016-03-31', 10126),
(1, '2016-03-31', 10133),
(1, '2016-04-01', 10137),
(1, '2016-04-01', 10139),
(1, '2016-04-02', 10144),
(1, '2016-04-04', 10137),
(1, '2016-04-04', 10141),
(1, '2016-04-04', 10142),
(1, '2016-04-04', 10150);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_bairro`
--

CREATE TABLE IF NOT EXISTS `tb_bairro` (
  `bairro_id` int(11) NOT NULL AUTO_INCREMENT,
  `bairro_nome` varchar(100) NOT NULL,
  `bairro_criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cidade_id` int(11) NOT NULL,
  `bairro_url` varchar(150) NOT NULL,
  PRIMARY KEY (`bairro_id`),
  UNIQUE KEY `bairro_url_2` (`bairro_url`,`cidade_id`),
  KEY `tb001_ix` (`cidade_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=208 ;

--
-- Fazendo dump de dados para tabela `tb_bairro`
--

INSERT INTO `tb_bairro` (`bairro_id`, `bairro_nome`, `bairro_criado`, `cidade_id`, `bairro_url`) VALUES
(7, 'Jardim dos Gomes', '2016-02-15 12:46:10', 5, 'jardim-dos-gomes'),
(13, 'Vila Redentora', '2016-02-15 12:51:51', 5, 'vila-redentora'),
(14, 'Centro', '2016-02-16 19:40:33', 5, 'centro'),
(16, 'Parque Residencial Romano Calil', '2016-02-17 12:54:39', 5, 'parque-residencial-romano-calil'),
(32, 'Vila Aeroporto', '2016-03-18 13:13:46', 5, 'vila-aeroporto'),
(36, 'Bom Jardim', '2016-03-18 16:29:35', 5, 'bom-jardim'),
(41, 'Vila Sinibaldi', '2016-03-18 16:38:51', 5, 'vila-sinibaldi'),
(44, 'Jardim Maria Cândida', '2016-03-18 16:45:04', 5, 'jardim-maria-candida'),
(47, 'Distrito Industrial', '2016-03-18 17:52:44', 5, 'distrito-industrial'),
(51, 'Jardim Estrela', '2016-03-18 18:06:44', 5, 'jardim-estrela'),
(59, 'Jardim Alto Alegre', '2016-03-18 18:17:16', 5, 'jardim-alto-alegre'),
(70, 'Parque São Miguel', '2016-03-18 20:18:09', 5, 'parque-sao-miguel'),
(76, 'Vila Maceno', '2016-03-21 17:28:08', 5, 'vila-maceno'),
(80, 'Nova Redentora', '2016-03-21 17:35:00', 5, 'nova-redentora'),
(81, 'Jardim Maracanã', '2016-03-21 17:37:01', 5, 'jardim-maracana'),
(97, 'Jardim Seyon', '2016-03-21 19:53:10', 5, 'jardim-seyon'),
(98, 'Jardim Conceição', '2016-03-21 19:55:28', 5, 'jardim-conceicao'),
(102, 'Jardim Yolanda', '2016-03-21 20:00:45', 5, 'jardim-yolanda'),
(108, 'Pinheiros', '2016-03-21 20:09:03', 5, 'pinheiros'),
(116, 'Centro', '2016-03-21 20:20:35', 114, 'centro'),
(131, 'Jardim Novo Aeroporto', '2016-03-26 16:59:45', 5, 'jardim-novo-aeroporto'),
(134, 'Jardim Aclimação', '2016-03-26 17:12:27', 5, 'jardim-aclimacao'),
(137, 'Universitário', '2016-03-26 17:43:14', 5, 'universitario'),
(143, 'Jardim Bela Vista', '2016-03-26 19:05:32', 5, 'jardim-bela-vista'),
(156, 'Boa Vista', '2016-03-26 19:54:28', 5, 'boa-vista'),
(161, 'Jardim Morumbi', '2016-03-26 20:14:14', 5, 'jardim-morumbi'),
(162, 'Centro', '2016-03-28 16:42:33', 160, 'centro'),
(171, 'Centro', '2016-03-28 17:06:01', 169, 'centro'),
(172, 'Centro', '2016-03-28 17:08:53', 170, 'centro'),
(173, 'Centro', '2016-03-28 17:11:43', 171, 'centro'),
(174, 'Centro', '2016-03-28 17:13:33', 172, 'centro'),
(175, 'Centro', '2016-03-28 17:22:28', 173, 'centro'),
(176, 'Centro', '2016-03-28 17:29:17', 174, 'centro'),
(178, 'Centro', '2016-03-28 17:32:36', 176, 'centro'),
(179, 'Centro', '2016-03-28 17:33:57', 177, 'centro'),
(185, 'Recanto Real', '2016-04-01 00:51:53', 5, 'recanto-real'),
(188, 'Centro', '2016-04-02 14:52:29', 186, 'centro'),
(203, 'Jardim Tarraf', '2016-04-04 14:25:50', 5, 'jardim-tarraf'),
(204, 'Vila Bom Jesus', '2016-04-04 14:28:29', 5, 'vila-bom-jesus'),
(205, 'Centro', '2016-04-04 14:32:26', 203, 'centro');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_cadastro`
--

CREATE TABLE IF NOT EXISTS `tb_cadastro` (
  `cadastro_id` int(11) NOT NULL AUTO_INCREMENT,
  `cadastro_nome` varchar(120) NOT NULL,
  `cadastro_sobre` text,
  `cadastro_email` varchar(120) NOT NULL,
  `cadastro_senha` varchar(32) NOT NULL,
  `cadastro_telefone` varchar(20) NOT NULL,
  `cadastro_tipo` int(11) NOT NULL,
  `cadastro_cpf` varchar(20) DEFAULT NULL,
  `cadastro_nascimento` date DEFAULT NULL,
  `cadastro_razaoSocial` varchar(120) DEFAULT NULL,
  `cadastro_cnpj` varchar(30) DEFAULT NULL,
  `cadastro_ie` varchar(80) DEFAULT NULL,
  `cadastro_endereco_cep` varchar(10) DEFAULT NULL,
  `cadastro_endereco_rua` varchar(255) DEFAULT NULL,
  `cadastro_endereco_numero` varchar(10) DEFAULT NULL,
  `cadastro_endereco_bairro` varchar(100) DEFAULT NULL,
  `cadastro_endereco_complemento` varchar(50) DEFAULT NULL,
  `cadastro_endereco_cidade` varchar(100) DEFAULT NULL,
  `cadastro_endereco_estado` varchar(2) DEFAULT NULL,
  `cadastro_fotoPerfil` varchar(36) DEFAULT NULL,
  `cadastro_criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cadastro_editado` datetime DEFAULT NULL,
  `cadastro_confirmado` datetime DEFAULT NULL,
  `cadastro_url` varchar(60) DEFAULT NULL,
  `cadastro_novasenha_data` datetime DEFAULT NULL,
  PRIMARY KEY (`cadastro_id`),
  UNIQUE KEY `cadastro_email` (`cadastro_email`),
  UNIQUE KEY `cadastro_cpf` (`cadastro_cpf`),
  UNIQUE KEY `cadastro_cnpj` (`cadastro_cnpj`),
  UNIQUE KEY `cadastro_url` (`cadastro_url`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5019 ;

--
-- Fazendo dump de dados para tabela `tb_cadastro`
--

INSERT INTO `tb_cadastro` (`cadastro_id`, `cadastro_nome`, `cadastro_sobre`, `cadastro_email`, `cadastro_senha`, `cadastro_telefone`, `cadastro_tipo`, `cadastro_cpf`, `cadastro_nascimento`, `cadastro_razaoSocial`, `cadastro_cnpj`, `cadastro_ie`, `cadastro_endereco_cep`, `cadastro_endereco_rua`, `cadastro_endereco_numero`, `cadastro_endereco_bairro`, `cadastro_endereco_complemento`, `cadastro_endereco_cidade`, `cadastro_endereco_estado`, `cadastro_fotoPerfil`, `cadastro_criado`, `cadastro_editado`, `cadastro_confirmado`, `cadastro_url`, `cadastro_novasenha_data`) VALUES
(5003, 'LUIZ SERGIO MONTANARI FRANZOTTI', NULL, 'luiz.franzotti@bebidaspoty.com.br', '986c9baaf20157cbf32b21c0314b3e2a', '(17) 9913-29259', 2, '369.768.488-43', '1989-07-18', NULL, NULL, NULL, '15105-000', 'Rod. Abel Pinho Maia', '12', 'Centro', 'Chácara São Pedro', 'Potirendaba', 'SP', 'edb6958594847c1caf708c3d2eb1dda8.jpg', '2016-02-23 14:33:38', '2016-02-23 22:53:53', '2016-02-23 14:37:08', 'luizfranzotti', NULL),
(5004, 'Maciel Angelo Montanari', 'www.facebook.com/aceplan1/  -   https://www.facebook.com/maciel.montanari.5', 'macielmarketing@hotmail.com', '82046b929119d106510f80d5b0e497f6', '(17) 9917-41001', 1, '018.998.778-27', '1960-09-04', NULL, NULL, NULL, '15105-000', 'João Antonio De Siqueira', '462', 'Centro', NULL, 'Potirendaba', 'SP', '9c648b2f8254bfbccba0d2a0ce9f87c1.jpg', '2016-02-23 18:46:17', '2016-02-24 12:43:38', '2016-02-24 12:38:46', ' https://www.facebook.com/maciel.montanari.5', NULL),
(5010, 'José Victor Montanari Franzotti', NULL, 'josevictor@bebidaspoty.com.br', '5775f3eaccbaa66732e805cb621bbf3d', '(17) 9915-40485', 1, '415.078.378-01', '1991-03-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-02-24 14:13:17', NULL, '2016-02-24 17:40:58', NULL, NULL),
(5012, 'J. Silva Painéis', 'Com mais de 3.500 m² de área construída, possui as melhores soluções em Impressão Digital, Painéis Rodoviários, Front-lights, Empenas e Outdoors.\n\nDesde 1971, atuando no segmento de mídia exterior, a empresa fez da evolução tecnológica e da capacitação de seus colaboradores uma constante.\n\nEspecialização, segurança e agilidade fazem da J. Silva Painéis líder em excelência no mercado!', 'felipe@monacoinvestimentos.com.br', 'e10adc3949ba59abbe56e057f20f883e', '(17) 3266-9393', 1, NULL, NULL, 'J. Silva Painéis Ltda.', '51.858.9340001-08', '262012110110', '15895-000', 'Av Mauricio Costa', '30', 'Centro', NULL, 'Cedral', 'SP', 'f9d21acd5d3d4581d6d6fd08aa747377.jpg', '2016-03-17 18:36:40', '2016-03-18 20:28:30', '2016-03-17 18:39:14', 'jsilva', NULL),
(5013, 'oOH! Mídia', 'A OOH! Mídia traz muito mais visibilidade para a sua marca. \nSão 150.000 pessoas todo o dia, sendo 3,5 milhões de pessoas por mês. \nCom possibilidade inovadoras de mídia out of home, o formato oferece informação útil para o consumidor em trânsito, além de entretenimento e mensagem de impacto em momentos de predisposição ao consumo.\nTemos 44 telas em todo o Terminal Urbano e Rodoviário de São José do Rio Preto-SP, possibilitando um alto impacto e frequência com baixo custo de investimento.\n\n07.545.406/0001-07', 'marcelo@oohdigital.com.br', '0069d3b84598ac12874a25fd89d02511', '(17) 2139-3401', 1, NULL, NULL, 'DLM Propaganda Ltda.', '07.545.4060001-07', NULL, '15015-110', 'Rua Quinze de Novembro', '3822', 'Centro', NULL, 'São José do Rio Preto', 'SP', '85a9fe5c974de3e915b2ee49c8f89fd8.jpg', '2016-03-29 18:05:32', '2016-03-31 21:47:10', '2016-03-29 18:11:02', 'oohmidia', NULL),
(5014, 'Rádio CBN Grandes Lagos', NULL, 'contato@cbnrp.com.br', 'fbf1442b56002860a9623f58b9234c4c', '(17) 3214-5090', 1, NULL, NULL, 'CEN', '55.223.1270002-42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-31 22:25:28', NULL, NULL, NULL, NULL),
(5015, 'Grupo Monteiro de Barros', 'O Grupo Monteiro de Barros fica localizado em Barretos, cidade do interior do Estado de São Paulo, a 425km da capital. Fundado por João Monteiro de Barros Filho, o grupo contempla atualmente 9 veículos de comunicação: o jornal O Diário, seu portal O Diário online e as rádios Band FM, Colina FM, Jovem Pan FM, Independente AM e Jovem Pan News AM. Em 2014 surgiu a Em Vista Mídia Exterior para completar o portfólio de soluções de mídia do Grupo Monteiro de Barros', 'marcelo.monteiro@grupomonteirodebarros.com.br', 'ae081082e12d6f0631dea5e748033ab1', '(17) 3321-7070', 1, NULL, NULL, 'Jornal O Diário de Barretos Ltda-EPP', '00.186.3820001-90', '204215379113', '14781-574', 'Praça Joel Waldo Dal Moro', '01', 'Centro', NULL, 'Barretos', 'SP', '078c98fd1bda539486e5c8c3e70463b6.jpg', '2016-03-31 22:38:38', '2016-04-04 14:49:10', '2016-03-31 22:46:49', 'grupomonteirodebarros', '2016-03-31 23:14:10'),
(5016, 'Rafael Awalke teste', 'Teste', 'rferrato@awalke.com.br', 'c20ad4d76fe97759aa27a0c99bff6710', '(11) 1111-11111', 1, '886.432.387-24', '1989-02-01', NULL, NULL, NULL, '15076-060', 'Rua Euclides de Lima', '32', 'Parque Residencial Romano Calil', NULL, 'São José do Rio Preto', 'SP', NULL, '2016-04-01 12:16:39', '2016-04-01 12:27:59', '2016-04-01 12:17:23', NULL, NULL),
(5017, 'DIÁRIO PAINÉIS', 'DIÁRIO PAINÉIS\n\nEmpresa líder no segmento de mídia exterior em Catanduva e região (+15 cidades)\n\nProdutos:  Outdoor convencional | Frontlight Rodoviário | Painéis urbanos', 'leonardo@diariopaineis.com.br', 'ee7c1b34136eeb8be52f11c91d221f32', '(17) 3521-4400', 1, NULL, NULL, 'DIÁRIO PAINÉIS LTDA.', '05.765.0170001-53', '260148460119', '15804-010', 'Rua Goiás ', '1012', 'Higienópolis', NULL, 'Catanduva', 'SP', NULL, '2016-04-04 12:44:11', '2016-04-04 13:51:01', '2016-04-04 13:50:29', 'diariopaineis', NULL),
(5018, 'THE CLUB JK', 'Uma estrutura foi especialmente construída na Avenida Juscelino Kubitschek n° 670 para ser sede da boate que  reveza entre atrações sertanejas e música eletrônica.\n\nEm cada detalhe é possível identificar a atmosfera da casa, com requinte e sofisticação. Com capacidade para mais de 1mil pessoas, a The Club JK conta com um palco e estrutura de shows inéditos. A boate além das programações entre sexta-feira e sábado,  também é o endereço de shows especiais.', 'joao-vitor-ferreira-souza@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', '(17) 3013-4393', 1, NULL, NULL, 'The Club Eventos Ltda ME', '16.889.1840001-22', '647.628.109.115', '15091-450', 'Avenida Presidente Juscelino Kubitschek de Oliveira ', '670', 'Jardim Tarraf', NULL, 'São José do Rio Preto', 'SP', 'de16984c48a5fbb857801d3b73a6c9e5.jpg', '2016-04-04 14:14:33', '2016-04-04 14:34:12', '2016-04-04 14:18:04', 'theclubjk', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_cadastro_contato`
--

CREATE TABLE IF NOT EXISTS `tb_cadastro_contato` (
  `cadastro_contato_id` int(11) NOT NULL AUTO_INCREMENT,
  `cadastro_contato_nome` varchar(120) NOT NULL,
  `cadastro_contato_email` varchar(120) NOT NULL,
  `cadastro_contato_telefone` varchar(20) NOT NULL,
  `cadastro_contato_msg` text NOT NULL,
  `cadastro_contato_criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `anuncio_id` int(11) DEFAULT NULL,
  `cadastro_id` int(11) DEFAULT NULL,
  `cid` int(11) NOT NULL,
  PRIMARY KEY (`cadastro_contato_id`),
  KEY `tcc001_ix` (`anuncio_id`),
  KEY `tcc002_ix` (`cadastro_id`),
  KEY `tcc00001_ix` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_cadastro_interesse`
--

CREATE TABLE IF NOT EXISTS `tb_cadastro_interesse` (
  `cadastro_id` int(11) NOT NULL,
  `interesse_item_id` int(11) NOT NULL,
  UNIQUE KEY `interesse_item_id` (`interesse_item_id`,`cadastro_id`),
  KEY `tci001_ix` (`cadastro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `tb_cadastro_interesse`
--

INSERT INTO `tb_cadastro_interesse` (`cadastro_id`, `interesse_item_id`) VALUES
(5003, 1),
(5003, 2),
(5003, 3),
(5003, 4),
(5003, 5),
(5003, 7),
(5003, 8),
(5003, 9),
(5003, 10),
(5003, 11),
(5003, 12),
(5003, 13),
(5003, 14),
(5003, 15),
(5003, 16),
(5003, 17),
(5003, 18),
(5003, 19),
(5003, 20),
(5003, 21),
(5003, 23),
(5003, 25),
(5003, 26),
(5003, 28),
(5003, 29),
(5003, 30),
(5003, 34),
(5003, 41),
(5012, 5),
(5012, 42),
(5012, 43),
(5012, 44),
(5012, 45),
(5013, 4),
(5013, 7),
(5013, 13),
(5015, 2),
(5015, 5),
(5015, 18),
(5015, 23),
(5015, 26),
(5015, 43),
(5017, 5),
(5017, 42),
(5017, 43),
(5017, 44),
(5018, 20),
(5018, 34),
(5018, 55),
(5018, 56);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_cadastro_relatorio`
--

CREATE TABLE IF NOT EXISTS `tb_cadastro_relatorio` (
  `cadastro_relatorio_quantidade` int(11) DEFAULT '1',
  `cadastro_relatorio_data` date NOT NULL,
  `cadastro_id` int(11) NOT NULL,
  UNIQUE KEY `cadastro_relatorio_data` (`cadastro_relatorio_data`,`cadastro_id`),
  KEY `tcr0001_ix` (`cadastro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `tb_cadastro_relatorio`
--

INSERT INTO `tb_cadastro_relatorio` (`cadastro_relatorio_quantidade`, `cadastro_relatorio_data`, `cadastro_id`) VALUES
(1, '2016-03-18', 5012),
(1, '2016-04-01', 5013),
(1, '2016-04-02', 5012);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_cidade`
--

CREATE TABLE IF NOT EXISTS `tb_cidade` (
  `cidade_id` int(11) NOT NULL AUTO_INCREMENT,
  `cidade_nome` varchar(100) NOT NULL,
  `cidade_criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado_id` int(11) NOT NULL,
  `cidade_url` varchar(150) NOT NULL,
  PRIMARY KEY (`cidade_id`),
  UNIQUE KEY `cidade_url` (`cidade_url`,`estado_id`),
  KEY `tc001_ix` (`estado_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=206 ;

--
-- Fazendo dump de dados para tabela `tb_cidade`
--

INSERT INTO `tb_cidade` (`cidade_id`, `cidade_nome`, `cidade_criado`, `estado_id`, `cidade_url`) VALUES
(5, 'São José do Rio Preto', '2016-02-15 12:46:10', 4, 'sao-jose-do-rio-preto'),
(114, 'Fronteira', '2016-03-21 20:20:35', 113, 'fronteira'),
(160, 'Mirassol', '2016-03-28 16:42:33', 4, 'mirassol'),
(169, 'Monte Aprazível', '2016-03-28 17:06:01', 4, 'monte-aprazivel'),
(170, 'Neves Paulista', '2016-03-28 17:08:53', 4, 'neves-paulista'),
(171, 'Nova Granada', '2016-03-28 17:11:43', 4, 'nova-granada'),
(172, 'Jaci', '2016-03-28 17:13:33', 4, 'jaci'),
(173, 'Potirendaba', '2016-03-28 17:22:28', 4, 'potirendaba'),
(174, 'Bady Bassitt', '2016-03-28 17:29:17', 4, 'bady-bassitt'),
(176, 'Ibirá', '2016-03-28 17:32:36', 4, 'ibira'),
(177, 'Bálsamo', '2016-03-28 17:33:57', 4, 'balsamo'),
(186, 'Barretos', '2016-04-02 14:52:29', 4, 'barretos'),
(203, 'Olímpia', '2016-04-04 14:32:26', 4, 'olimpia');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_estado`
--

CREATE TABLE IF NOT EXISTS `tb_estado` (
  `estado_id` int(11) NOT NULL AUTO_INCREMENT,
  `estado_nome` varchar(2) NOT NULL,
  `estado_criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado_url` varchar(2) NOT NULL,
  PRIMARY KEY (`estado_id`),
  UNIQUE KEY `estado_url` (`estado_url`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=205 ;

--
-- Fazendo dump de dados para tabela `tb_estado`
--

INSERT INTO `tb_estado` (`estado_id`, `estado_nome`, `estado_criado`, `estado_url`) VALUES
(4, 'SP', '2016-02-15 12:46:10', 'sp'),
(113, 'MG', '2016-03-21 20:20:35', 'mg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_interesse`
--

CREATE TABLE IF NOT EXISTS `tb_interesse` (
  `interesse_id` int(11) NOT NULL AUTO_INCREMENT,
  `interesse_nome` varchar(40) NOT NULL,
  `interesse_icone` varchar(30) NOT NULL,
  `interesse_criada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`interesse_id`),
  UNIQUE KEY `interesse_nome` (`interesse_nome`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Fazendo dump de dados para tabela `tb_interesse`
--

INSERT INTO `tb_interesse` (`interesse_id`, `interesse_nome`, `interesse_icone`, `interesse_criada`) VALUES
(1, 'Radiodifusão', 'radiofusao', '2016-01-21 11:47:56'),
(2, 'Outdoor Público', 'outdoor', '2016-01-21 11:48:20'),
(3, 'Mídia Impressa', 'mid-impressa', '2016-01-21 11:48:48'),
(4, 'Digital', 'digital', '2016-01-21 11:49:13'),
(5, 'Patrocínios', 'patrocinio', '2016-01-21 11:49:35');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_interesse_item`
--

CREATE TABLE IF NOT EXISTS `tb_interesse_item` (
  `interesse_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `interesse_item_nome` varchar(50) NOT NULL,
  `interesse_item_criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `interesse_item_editado` datetime DEFAULT NULL,
  `interesse_id` int(11) NOT NULL,
  PRIMARY KEY (`interesse_item_id`),
  UNIQUE KEY `interesse_item_nome` (`interesse_item_nome`,`interesse_id`),
  KEY `tii001_ix` (`interesse_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

--
-- Fazendo dump de dados para tabela `tb_interesse_item`
--

INSERT INTO `tb_interesse_item` (`interesse_item_id`, `interesse_item_nome`, `interesse_item_criado`, `interesse_item_editado`, `interesse_id`) VALUES
(1, 'TV Aberta', '2016-01-21 11:51:18', '2016-03-18 12:46:14', 1),
(2, 'Rádio', '2016-01-21 11:51:18', '2016-03-18 12:46:14', 1),
(3, 'TV a Cabo', '2016-01-21 11:51:18', '2016-03-18 12:46:14', 1),
(4, 'TV Corporativa', '2016-01-21 11:51:18', '2016-03-18 12:46:14', 1),
(5, 'Outdoor', '2016-01-21 11:53:53', '2016-03-18 12:30:08', 2),
(7, 'Sinalização Digital', '2016-01-21 11:53:53', '2016-03-18 12:30:08', 2),
(8, 'Centro Comercial', '2016-01-21 11:53:53', '2016-03-18 12:30:08', 2),
(9, 'Instalação Esportiva', '2016-01-21 11:53:53', '2016-03-18 12:30:08', 2),
(10, 'Estação de Trem', '2016-01-21 11:53:53', '2016-03-18 12:30:08', 2),
(11, 'Aeroporto', '2016-01-21 11:53:53', '2016-03-18 12:30:08', 2),
(12, 'Trem', '2016-01-21 11:53:53', '2016-03-18 12:30:08', 2),
(13, 'Ônibus', '2016-01-21 11:53:53', '2016-03-18 12:30:08', 2),
(14, 'Metrô', '2016-01-21 11:53:53', '2016-03-18 12:30:08', 2),
(15, 'Dirigivel de Ar', '2016-01-21 11:53:53', '2016-03-18 12:30:08', 2),
(16, 'Companhia Aérea', '2016-01-21 11:53:53', '2016-03-18 12:30:08', 2),
(17, 'Táxi', '2016-01-21 11:53:53', '2016-03-18 12:30:08', 2),
(18, 'Jornal', '2016-01-21 11:54:58', '2016-03-18 12:50:44', 3),
(19, 'Revista', '2016-01-21 11:54:58', '2016-03-18 12:50:44', 3),
(20, 'Folder / Flyer', '2016-01-21 11:54:58', '2016-03-18 12:50:44', 3),
(21, 'Livro', '2016-01-21 11:54:58', '2016-03-18 12:50:44', 3),
(23, 'Portal de Mídia', '2016-01-21 11:56:58', '2016-03-18 12:32:32', 4),
(25, 'Mídia Social', '2016-01-21 11:56:58', '2016-03-18 12:32:32', 4),
(26, 'Aplicativo', '2016-01-21 11:56:58', '2016-03-18 12:32:32', 4),
(28, 'Game', '2016-01-21 11:56:58', '2016-03-18 12:32:32', 4),
(29, 'E-mail Marketing', '2016-01-21 11:56:58', '2016-03-18 12:32:32', 4),
(30, 'Blog', '2016-01-21 11:56:58', '2016-03-18 12:32:32', 4),
(34, 'Celebridade', '2016-01-21 11:59:19', '2016-03-18 12:42:23', 5),
(41, 'Livro de Valor Artístico, Literário ou Humanístico', '2016-02-10 15:53:29', '2016-03-18 12:50:44', 3),
(42, 'Painél Rodoviário', '2016-03-18 12:30:08', NULL, 2),
(43, 'Front-Light', '2016-03-18 12:30:08', NULL, 2),
(44, 'Empena', '2016-03-18 12:30:08', NULL, 2),
(45, 'Ático de Edifício', '2016-03-18 12:30:08', NULL, 2),
(46, 'Futebol', '2016-03-18 12:42:23', NULL, 5),
(47, 'Vôlei', '2016-03-18 12:42:23', NULL, 5),
(48, 'Tênis', '2016-03-18 12:42:23', NULL, 5),
(49, 'Basquete', '2016-03-18 12:42:23', NULL, 5),
(50, 'Golf', '2016-03-18 12:42:23', NULL, 5),
(51, 'Automobilismo', '2016-03-18 12:42:23', NULL, 5),
(52, 'Motociclismo', '2016-03-18 12:42:23', NULL, 5),
(53, 'Atletismo', '2016-03-18 12:42:23', NULL, 5),
(54, 'Jiu-Jitsu', '2016-03-18 12:42:23', NULL, 5),
(55, 'Eventos Culturais', '2016-03-18 12:42:23', NULL, 5),
(56, 'Eventos Musicais', '2016-03-18 12:42:23', NULL, 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_newsletter`
--

CREATE TABLE IF NOT EXISTS `tb_newsletter` (
  `newsletter_id` int(11) NOT NULL AUTO_INCREMENT,
  `newsletter_email` varchar(120) NOT NULL,
  `newsletter_criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`newsletter_id`),
  UNIQUE KEY `newsletter_email` (`newsletter_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Fazendo dump de dados para tabela `tb_newsletter`
--

INSERT INTO `tb_newsletter` (`newsletter_id`, `newsletter_email`, `newsletter_criado`) VALUES
(4, 'macielmarketing@hotmail.com', '2016-02-23 18:46:17'),
(5, 'Felipe@monacoinvestimentos.com.br', '2016-02-27 13:54:54'),
(7, 'marcelo@oohdigital.com.br', '2016-03-29 18:05:32'),
(8, 'contato@cbnrp.com.br', '2016-03-31 22:25:28'),
(9, 'luizfranzotti@me.com', '2016-03-31 22:38:38'),
(10, 'leonardo@diariopaineis.com.br', '2016-04-04 12:44:11');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_template_email`
--

CREATE TABLE IF NOT EXISTS `tb_template_email` (
  `template_email_id` int(11) NOT NULL AUTO_INCREMENT,
  `template_email_nome` varchar(50) NOT NULL,
  `template_email_assunto` varchar(80) NOT NULL,
  `template_email_mensagem` longtext NOT NULL,
  `template_email_criado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `template_email_ref` varchar(30) NOT NULL,
  PRIMARY KEY (`template_email_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Fazendo dump de dados para tabela `tb_template_email`
--

INSERT INTO `tb_template_email` (`template_email_id`, `template_email_nome`, `template_email_assunto`, `template_email_mensagem`, `template_email_criado`, `template_email_ref`) VALUES
(1, 'Confirmar cadastro', 'Confirmação de cadastro', '<html>\r\n<head>\r\n<title>Anunciadoria</title>\r\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\r\n</head>\r\n<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">\r\n<table id="Tabela_01" width="600" height="741" border="0" cellpadding="0" cellspacing="0" align="center">\r\n	<tr><td colspan="9" width="600" height="33"></td></tr>\r\n	<tr>\r\n		<td colspan="2" rowspan="2" width="202" height="64"></td>\r\n			<td colspan="5" width="201" height="38">\r\n        	<a href="[@dominio]" target="_blank">\r\n            <img style="display:block; border:none; outline:none;" src="[@dominio]/img/emkt/email-marketing_03.jpg" alt="Anunciadoria" title="Anunciadoria">\r\n            </a>\r\n        	</td>\r\n		<td colspan="2" rowspan="2" width="197" height="64"></td>\r\n	</tr>\r\n	<tr><td colspan="5" width="201" height="26" ></td></tr>\r\n	<tr><td colspan="9" width="600" height="8" ><img src="[@dominio]/img/emkt/email-marketing_06.jpg" alt="Linha de divisa"></td></tr>\r\n	<tr>\r\n	<td width="63" height="350"></td>\r\n		<td colspan="7" align="center">\r\n        <br>\r\n        <font size="5" face="Arial, Helvetica, sans-serif" color="#555555">Ol&aacute; <b>[@nome]</b>,</font>\r\n        <br><br>\r\n        <font size="3" face="Arial, Helvetica, sans-serif" color="#666666">\r\n		\r\n<a href="[@link]" target="_blank">Clique aqui</a> para confirmar seu cadastro.\r\n		\r\n		</font><br><br><br>\r\n        </td>\r\n	<td width="64" height="350"></td>\r\n	</tr>\r\n	<tr><td colspan="9" width="600" height="10"><img src="[@dominio]/img/emkt/email-marketing_10.jpg" alt="Linha de divisa"></td></tr>\r\n	<tr><td colspan="9" width="600" height="17"></td></tr>\r\n	<tr>\r\n<td colspan="9" align="center">\r\n<a href="https://www.facebook.com/anunciadoria" target="_blank"><img src="[@dominio]/img/emkt/email-marketing_13.jpg" alt="Facebook" title="Facebook"></a>&nbsp;&nbsp;<a href="https://www.instagram.com/anunciadoria" target="_blank"><img src="[@dominio]/img/emkt/email-marketing_15.jpg" alt="Instagram" title="Instagram"></a>&nbsp;&nbsp;<a href="https://www.youtube.com/channel/UCSQ4Sr-u7gYDbzxAVydOEdw" target="_blank"><img src="[@dominio]/img/emkt/email-marketing_yt.jpg" alt="YouTube" title="YouTube"></a>\r\n</td>\r\n	</tr>\r\n	<tr><td colspan="9" width="600" height="25" ></td></tr>\r\n	<tr>\r\n		<td colspan="9" align="center">\r\n        <font size="1" face="Arial, Helvetica, sans-serif" color="#8e8e8e">Copyright 2016 - </font>\r\n        <font size="1" face="Arial, Helvetica, sans-serif" color="#9e0116"> Anunciadoria</font><br>\r\n		<font size="1" face="Arial, Helvetica, sans-serif" color="#8e8e8e">Todos os direitos reservados</font>\r\n        <br><br>\r\n        </td>\r\n	</tr>\r\n	<tr>\r\n    	<td width="63" height="1" ></td><td width="139" height="1"></td><td width="56" height="1"></td>\r\n		<td width="35" height="1"></td><td width="14" height="1"></td><td width="34" height="1"></td>\r\n		<td width="62" height="1"></td><td width="133" height="1"></td><td width="64" height="1"></td>\r\n    </tr>\r\n</table>\r\n</body>\r\n</html>', '2015-04-22 10:42:34', 'confirmar-cadastro-usuarios'),
(4, 'Sugestão de segmento', 'Sugestão de segmento', '<html>\r\n<head>\r\n<title>Anunciadoria</title>\r\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\r\n</head>\r\n<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">\r\n<table id="Tabela_01" width="600" height="741" border="0" cellpadding="0" cellspacing="0" align="center">\r\n	<tr><td colspan="9" width="600" height="33"></td></tr>\r\n	<tr>\r\n		<td colspan="2" rowspan="2" width="202" height="64"></td>\r\n			<td colspan="5" width="201" height="38">\r\n        	<a href="[@dominio]" target="_blank">\r\n            <img style="display:block; border:none; outline:none;" src="[@dominio]/img/emkt/email-marketing_03.jpg" alt="Anunciadoria" title="Anunciadoria">\r\n            </a>\r\n        	</td>\r\n		<td colspan="2" rowspan="2" width="197" height="64"></td>\r\n	</tr>\r\n	<tr><td colspan="5" width="201" height="26" ></td></tr>\r\n	<tr><td colspan="9" width="600" height="8" ><img src="[@dominio]/img/emkt/email-marketing_06.jpg" alt="Linha de divisa"></td></tr>\r\n	<tr>\r\n	<td width="63" height="350"></td>\r\n		<td colspan="7" align="center">\r\n        <br>\r\n        <font size="5" face="Arial, Helvetica, sans-serif" color="#555555">Ol&aacute;,</font>\r\n        <br><br>\r\n        <font size="3" face="Arial, Helvetica, sans-serif" color="#666666">\r\n		\r\nFoi sugerido um novo segmento <b>[@nome]</b>.\r\n		\r\n		</font><br><br><br>\r\n        </td>\r\n	<td width="64" height="350"></td>\r\n	</tr>\r\n	<tr><td colspan="9" width="600" height="10"><img src="[@dominio]/img/emkt/email-marketing_10.jpg" alt="Linha de divisa"></td></tr>\r\n	<tr><td colspan="9" width="600" height="17"></td></tr>\r\n	<tr>\r\n<td colspan="9" align="center">\r\n<a href="https://www.facebook.com/anunciadoria" target="_blank"><img src="[@dominio]/img/emkt/email-marketing_13.jpg" alt="Facebook" title="Facebook"></a>&nbsp;&nbsp;<a href="https://www.instagram.com/anunciadoria" target="_blank"><img src="[@dominio]/img/emkt/email-marketing_15.jpg" alt="Instagram" title="Instagram"></a>&nbsp;&nbsp;<a href="https://www.youtube.com/channel/UCSQ4Sr-u7gYDbzxAVydOEdw" target="_blank"><img src="[@dominio]/img/emkt/email-marketing_yt.jpg" alt="YouTube" title="YouTube"></a>\r\n</td>\r\n	</tr>\r\n	<tr><td colspan="9" width="600" height="25" ></td></tr>\r\n	<tr>\r\n		<td colspan="9" align="center">\r\n        <font size="1" face="Arial, Helvetica, sans-serif" color="#8e8e8e">Copyright 2016 - </font>\r\n        <font size="1" face="Arial, Helvetica, sans-serif" color="#9e0116"> Anunciadoria</font><br>\r\n		<font size="1" face="Arial, Helvetica, sans-serif" color="#8e8e8e">Todos os direitos reservados</font>\r\n        <br><br>\r\n        </td>\r\n	</tr>\r\n	<tr>\r\n    	<td width="63" height="1" ></td><td width="139" height="1"></td><td width="56" height="1"></td>\r\n		<td width="35" height="1"></td><td width="14" height="1"></td><td width="34" height="1"></td>\r\n		<td width="62" height="1"></td><td width="133" height="1"></td><td width="64" height="1"></td>\r\n    </tr>\r\n</table>\r\n</body>\r\n</html>', '2015-04-21 14:23:13', 'sugerir-segmento'),
(5, 'Perfil enviar contato', 'Alguém entrou em contato pelo seu perfil', '<html>\r\n<head>\r\n<title>Anunciadoria</title>\r\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\r\n</head>\r\n<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">\r\n<table id="Tabela_01" width="600" height="741" border="0" cellpadding="0" cellspacing="0" align="center">\r\n	<tr><td colspan="9" width="600" height="33"></td></tr>\r\n	<tr>\r\n		<td colspan="2" rowspan="2" width="202" height="64"></td>\r\n			<td colspan="5" width="201" height="38">\r\n        	<a href="[@dominio]" target="_blank">\r\n            <img style="display:block; border:none; outline:none;" src="[@dominio]/img/emkt/email-marketing_03.jpg" alt="Anunciadoria" title="Anunciadoria">\r\n            </a>\r\n        	</td>\r\n		<td colspan="2" rowspan="2" width="197" height="64"></td>\r\n	</tr>\r\n	<tr><td colspan="5" width="201" height="26" ></td></tr>\r\n	<tr><td colspan="9" width="600" height="8" ><img src="[@dominio]/img/emkt/email-marketing_06.jpg" alt="Linha de divisa"></td></tr>\r\n	<tr>\r\n	<td width="63" height="350"></td>\r\n		<td colspan="7" align="center">\r\n        <br>\r\n        <font size="5" face="Arial, Helvetica, sans-serif" color="#555555">Ol&aacute; <b>[@nome]</b>,</font>\r\n        <br><br>\r\n        <font size="3" face="Arial, Helvetica, sans-serif" color="#666666">\r\n		\r\nAlgu&eacute;m entrou em contato pelo seu perfil:<br><br>\r\n<b>Nome:</b> [@contato_nome]<br><br>\r\n<b>E-mail:</b> [@contato_email]<br><br>\r\n<b>Telefone:</b> [@contato_telefone]<br><br>\r\n<b>Mensagem:</b><br><br> [@contato_msg]<br><br>\r\nOu acesse pelo link: <a href="[@link]" target="_blank">[@link]</a>.\r\n		\r\n		</font><br><br><br>\r\n        </td>\r\n	<td width="64" height="350"></td>\r\n	</tr>\r\n	<tr><td colspan="9" width="600" height="10"><img src="[@dominio]/img/emkt/email-marketing_10.jpg" alt="Linha de divisa"></td></tr>\r\n	<tr><td colspan="9" width="600" height="17"></td></tr>\r\n	<tr>\r\n<td colspan="9" align="center">\r\n<a href="https://www.facebook.com/anunciadoria" target="_blank"><img src="[@dominio]/img/emkt/email-marketing_13.jpg" alt="Facebook" title="Facebook"></a>&nbsp;&nbsp;<a href="https://www.instagram.com/anunciadoria" target="_blank"><img src="[@dominio]/img/emkt/email-marketing_15.jpg" alt="Instagram" title="Instagram"></a>&nbsp;&nbsp;<a href="https://www.youtube.com/channel/UCSQ4Sr-u7gYDbzxAVydOEdw" target="_blank"><img src="[@dominio]/img/emkt/email-marketing_yt.jpg" alt="YouTube" title="YouTube"></a>\r\n</td>\r\n	</tr>\r\n	<tr><td colspan="9" width="600" height="25" ></td></tr>\r\n	<tr>\r\n		<td colspan="9" align="center">\r\n        <font size="1" face="Arial, Helvetica, sans-serif" color="#8e8e8e">Copyright 2016 - </font>\r\n        <font size="1" face="Arial, Helvetica, sans-serif" color="#9e0116"> Anunciadoria</font><br>\r\n		<font size="1" face="Arial, Helvetica, sans-serif" color="#8e8e8e">Todos os direitos reservados</font>\r\n        <br><br>\r\n        </td>\r\n	</tr>\r\n	<tr>\r\n    	<td width="63" height="1" ></td><td width="139" height="1"></td><td width="56" height="1"></td>\r\n		<td width="35" height="1"></td><td width="14" height="1"></td><td width="34" height="1"></td>\r\n		<td width="62" height="1"></td><td width="133" height="1"></td><td width="64" height="1"></td>\r\n    </tr>\r\n</table>\r\n</body>\r\n</html>', '2015-04-21 14:23:13', 'perfil-enviar-contato'),
(2, 'Formulário de contato', 'Nova mensagem - [@tipo]', '<html>\r\n<head>\r\n<title>Anunciadoria</title>\r\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\r\n</head>\r\n<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">\r\n<table id="Tabela_01" width="600" height="741" border="0" cellpadding="0" cellspacing="0" align="center">\r\n	<tr><td colspan="9" width="600" height="33"></td></tr>\r\n	<tr>\r\n		<td colspan="2" rowspan="2" width="202" height="64"></td>\r\n			<td colspan="5" width="201" height="38">\r\n        	<a href="[@dominio]" target="_blank">\r\n            <img style="display:block; border:none; outline:none;" src="[@dominio]/img/emkt/email-marketing_03.jpg" alt="Anunciadoria" title="Anunciadoria">\r\n            </a>\r\n        	</td>\r\n		<td colspan="2" rowspan="2" width="197" height="64"></td>\r\n	</tr>\r\n	<tr><td colspan="5" width="201" height="26" ></td></tr>\r\n	<tr><td colspan="9" width="600" height="8" ><img src="[@dominio]/img/emkt/email-marketing_06.jpg" alt="Linha de divisa"></td></tr>\r\n	<tr>\r\n	<td width="63" height="350"></td>\r\n		<td colspan="7" align="center">\r\n        <br>\r\n        <font size="5" face="Arial, Helvetica, sans-serif" color="#555555">Ol&aacute;,</font>\r\n        <br><br>\r\n        <font size="3" face="Arial, Helvetica, sans-serif" color="#666666">\r\n		\r\n<b>Nome:</b> [@nome]<br><br>\r\n<b>E-mail:</b> [@email]<br><br>\r\n<b>Telefone:</b> [@telefone]<br><br>\r\n<b>Assunto:</b> [@assunto]<br><br>\r\n<b>Mensagem:</b><br><br>[@msg]<br><br>\r\n		\r\n		</font><br><br><br>\r\n        </td>\r\n	<td width="64" height="350"></td>\r\n	</tr>\r\n	<tr><td colspan="9" width="600" height="10"><img src="[@dominio]/img/emkt/email-marketing_10.jpg" alt="Linha de divisa"></td></tr>\r\n	<tr><td colspan="9" width="600" height="17"></td></tr>\r\n	<tr>\r\n<td colspan="9" align="center">\r\n<a href="https://www.facebook.com/anunciadoria" target="_blank"><img src="[@dominio]/img/emkt/email-marketing_13.jpg" alt="Facebook" title="Facebook"></a>&nbsp;&nbsp;<a href="https://www.instagram.com/anunciadoria" target="_blank"><img src="[@dominio]/img/emkt/email-marketing_15.jpg" alt="Instagram" title="Instagram"></a>&nbsp;&nbsp;<a href="https://www.youtube.com/channel/UCSQ4Sr-u7gYDbzxAVydOEdw" target="_blank"><img src="[@dominio]/img/emkt/email-marketing_yt.jpg" alt="YouTube" title="YouTube"></a>\r\n</td>\r\n	</tr>\r\n	<tr><td colspan="9" width="600" height="25" ></td></tr>\r\n	<tr>\r\n		<td colspan="9" align="center">\r\n        <font size="1" face="Arial, Helvetica, sans-serif" color="#8e8e8e">Copyright 2016 - </font>\r\n        <font size="1" face="Arial, Helvetica, sans-serif" color="#9e0116"> Anunciadoria</font><br>\r\n		<font size="1" face="Arial, Helvetica, sans-serif" color="#8e8e8e">Todos os direitos reservados</font>\r\n        <br><br>\r\n        </td>\r\n	</tr>\r\n	<tr>\r\n    	<td width="63" height="1" ></td><td width="139" height="1"></td><td width="56" height="1"></td>\r\n		<td width="35" height="1"></td><td width="14" height="1"></td><td width="34" height="1"></td>\r\n		<td width="62" height="1"></td><td width="133" height="1"></td><td width="64" height="1"></td>\r\n    </tr>\r\n</table>\r\n</body>\r\n</html>', '2015-04-21 14:23:13', 'contato'),
(3, 'Formulário de esqueci minha senha', 'Esqueci minha senha', '<html>\r\n<head>\r\n<title>Anunciadoria</title>\r\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\r\n</head>\r\n<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">\r\n<table id="Tabela_01" width="600" height="741" border="0" cellpadding="0" cellspacing="0" align="center">\r\n	<tr><td colspan="9" width="600" height="33"></td></tr>\r\n	<tr>\r\n		<td colspan="2" rowspan="2" width="202" height="64"></td>\r\n			<td colspan="5" width="201" height="38">\r\n        	<a href="[@dominio]" target="_blank">\r\n            <img style="display:block; border:none; outline:none;" src="[@dominio]/img/emkt/email-marketing_03.jpg" alt="Anunciadoria" title="Anunciadoria">\r\n            </a>\r\n        	</td>\r\n		<td colspan="2" rowspan="2" width="197" height="64"></td>\r\n	</tr>\r\n	<tr><td colspan="5" width="201" height="26" ></td></tr>\r\n	<tr><td colspan="9" width="600" height="8" ><img src="[@dominio]/img/emkt/email-marketing_06.jpg" alt="Linha de divisa"></td></tr>\r\n	<tr>\r\n	<td width="63" height="350"></td>\r\n		<td colspan="7" align="center">\r\n        <br>\r\n        <font size="5" face="Arial, Helvetica, sans-serif" color="#555555">Ol&aacute; <b>[@nome]</b>,</font>\r\n        <br><br>\r\n        <font size="3" face="Arial, Helvetica, sans-serif" color="#666666">\r\n		\r\n<a href="[@link]" target="_blank">Clique aqui</a> para definir sua nova senha.\r\n		\r\n		</font><br><br><br>\r\n        </td>\r\n	<td width="64" height="350"></td>\r\n	</tr>\r\n	<tr><td colspan="9" width="600" height="10"><img src="[@dominio]/img/emkt/email-marketing_10.jpg" alt="Linha de divisa"></td></tr>\r\n	<tr><td colspan="9" width="600" height="17"></td></tr>\r\n		<tr>\r\n<td colspan="9" align="center">\r\n<a href="https://www.facebook.com/anunciadoria" target="_blank"><img src="[@dominio]/img/emkt/email-marketing_13.jpg" alt="Facebook" title="Facebook"></a>&nbsp;&nbsp;<a href="https://www.instagram.com/anunciadoria" target="_blank"><img src="[@dominio]/img/emkt/email-marketing_15.jpg" alt="Instagram" title="Instagram"></a>&nbsp;&nbsp;<a href="https://www.youtube.com/channel/UCSQ4Sr-u7gYDbzxAVydOEdw" target="_blank"><img src="[@dominio]/img/emkt/email-marketing_yt.jpg" alt="YouTube" title="YouTube"></a>\r\n</td>\r\n	</tr>\r\n	<tr><td colspan="9" width="600" height="25" ></td></tr>\r\n	<tr>\r\n		<td colspan="9" align="center">\r\n        <font size="1" face="Arial, Helvetica, sans-serif" color="#8e8e8e">Copyright 2016 - </font>\r\n        <font size="1" face="Arial, Helvetica, sans-serif" color="#9e0116"> Anunciadoria</font><br>\r\n		<font size="1" face="Arial, Helvetica, sans-serif" color="#8e8e8e">Todos os direitos reservados</font>\r\n        <br><br>\r\n        </td>\r\n	</tr>\r\n	<tr>\r\n    	<td width="63" height="1" ></td><td width="139" height="1"></td><td width="56" height="1"></td>\r\n		<td width="35" height="1"></td><td width="14" height="1"></td><td width="34" height="1"></td>\r\n		<td width="62" height="1"></td><td width="133" height="1"></td><td width="64" height="1"></td>\r\n    </tr>\r\n</table>\r\n</body>\r\n</html>', '2015-04-21 14:23:13', 'esqueci-minha-senha'),
(6, 'Anúncio enviar contato', 'Alguém entrou em contato pelo anúncio ...', '<html>\r\n<head>\r\n<title>Anunciadoria</title>\r\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\r\n</head>\r\n<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">\r\n<table id="Tabela_01" width="600" height="741" border="0" cellpadding="0" cellspacing="0" align="center">\r\n	<tr><td colspan="9" width="600" height="33"></td></tr>\r\n	<tr>\r\n		<td colspan="2" rowspan="2" width="202" height="64"></td>\r\n			<td colspan="5" width="201" height="38">\r\n        	<a href="[@dominio]" target="_blank">\r\n            <img style="display:block; border:none; outline:none;" src="[@dominio]/img/emkt/email-marketing_03.jpg" alt="Anunciadoria" title="Anunciadoria">\r\n            </a>\r\n        	</td>\r\n		<td colspan="2" rowspan="2" width="197" height="64"></td>\r\n	</tr>\r\n	<tr><td colspan="5" width="201" height="26" ></td></tr>\r\n	<tr><td colspan="9" width="600" height="8" ><img src="[@dominio]/img/emkt/email-marketing_06.jpg" alt="Linha de divisa"></td></tr>\r\n	<tr>\r\n	<td width="63" height="350"></td>\r\n		<td colspan="7" align="center">\r\n        <br>\r\n        <font size="5" face="Arial, Helvetica, sans-serif" color="#555555">Ol&aacute; <b>[@nome]</b>,</font>\r\n        <br><br>\r\n        <font size="3" face="Arial, Helvetica, sans-serif" color="#666666">\r\n		\r\nAlgu&eacute;m entrou em contato pelo an&uacute;ncio <b>[@anuncio_nome] (ref: [@anuncio_ref]):</b><br><br>\r\n<b>Nome:</b> [@contato_nome]<br><br>\r\n<b>E-mail:</b> [@contato_email]<br><br>\r\n<b>Telefone:</b> [@contato_telefone]<br><br>\r\n<b>Mensagem:</b><br><br> [@contato_msg]<br><br>\r\nOu acesse pelo link: <a href="[@link]" target="_blank">[@link]</a>.\r\n		\r\n		</font><br><br><br>\r\n        </td>\r\n	<td width="64" height="350"></td>\r\n	</tr>\r\n	<tr><td colspan="9" width="600" height="10"><img src="[@dominio]/img/emkt/email-marketing_10.jpg" alt="Linha de divisa"></td></tr>\r\n	<tr><td colspan="9" width="600" height="17"></td></tr>\r\n		<tr>\r\n<td colspan="9" align="center">\r\n<a href="https://www.facebook.com/anunciadoria" target="_blank"><img src="[@dominio]/img/emkt/email-marketing_13.jpg" alt="Facebook" title="Facebook"></a>&nbsp;&nbsp;<a href="https://www.instagram.com/anunciadoria" target="_blank"><img src="[@dominio]/img/emkt/email-marketing_15.jpg" alt="Instagram" title="Instagram"></a>&nbsp;&nbsp;<a href="https://www.youtube.com/channel/UCSQ4Sr-u7gYDbzxAVydOEdw" target="_blank"><img src="[@dominio]/img/emkt/email-marketing_yt.jpg" alt="YouTube" title="YouTube"></a>\r\n</td>\r\n	</tr>\r\n	<tr><td colspan="9" width="600" height="25" ></td></tr>\r\n	<tr>\r\n		<td colspan="9" align="center">\r\n        <font size="1" face="Arial, Helvetica, sans-serif" color="#8e8e8e">Copyright 2016 - </font>\r\n        <font size="1" face="Arial, Helvetica, sans-serif" color="#9e0116"> Anunciadoria</font><br>\r\n		<font size="1" face="Arial, Helvetica, sans-serif" color="#8e8e8e">Todos os direitos reservados</font>\r\n        <br><br>\r\n        </td>\r\n	</tr>\r\n	<tr>\r\n    	<td width="63" height="1" ></td><td width="139" height="1"></td><td width="56" height="1"></td>\r\n		<td width="35" height="1"></td><td width="14" height="1"></td><td width="34" height="1"></td>\r\n		<td width="62" height="1"></td><td width="133" height="1"></td><td width="64" height="1"></td>\r\n    </tr>\r\n</table>\r\n</body>\r\n</html>', '2015-04-21 14:23:13', 'anuncio-enviar-contato'),
(7, 'Motivo da não aprovação', 'Anúncio não aprovado', '<html>\r\n<head>\r\n<title>Anunciadoria</title>\r\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8">\r\n</head>\r\n<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">\r\n<table id="Tabela_01" width="600" height="741" border="0" cellpadding="0" cellspacing="0" align="center">\r\n	<tr><td colspan="9" width="600" height="33"></td></tr>\r\n	<tr>\r\n		<td colspan="2" rowspan="2" width="202" height="64"></td>\r\n			<td colspan="5" width="201" height="38">\r\n        	<a href="[@dominio]" target="_blank">\r\n            <img style="display:block; border:none; outline:none;" src="[@dominio]/img/emkt/email-marketing_03.jpg" alt="Anunciadoria" title="Anunciadoria">\r\n            </a>\r\n        	</td>\r\n		<td colspan="2" rowspan="2" width="197" height="64"></td>\r\n	</tr>\r\n	<tr><td colspan="5" width="201" height="26" ></td></tr>\r\n	<tr><td colspan="9" width="600" height="8" ><img src="[@dominio]/img/emkt/email-marketing_06.jpg" alt="Linha de divisa"></td></tr>\r\n	<tr>\r\n	<td width="63" height="350"></td>\r\n		<td colspan="7" align="center">\r\n        <br>\r\n        <font size="5" face="Arial, Helvetica, sans-serif" color="#555555">Ol&aacute; <b>[@nome]</b>,</font>\r\n        <br><br>\r\n        <font size="3" face="Arial, Helvetica, sans-serif" color="#666666">\r\n		\r\nSeu an&uacute;ncio <b>[@anuncio_titulo]</b> não foi aprovado !<br><br>[@msg]\r\n		\r\n		</font><br><br><br>\r\n        </td>\r\n	<td width="64" height="350"></td>\r\n	</tr>\r\n	<tr><td colspan="9" width="600" height="10"><img src="[@dominio]/img/emkt/email-marketing_10.jpg" alt="Linha de divisa"></td></tr>\r\n	<tr><td colspan="9" width="600" height="17"></td></tr>\r\n		<tr>\r\n<td colspan="9" align="center">\r\n<a href="https://www.facebook.com/anunciadoria" target="_blank"><img src="[@dominio]/img/emkt/email-marketing_13.jpg" alt="Facebook" title="Facebook"></a>&nbsp;&nbsp;<a href="https://www.instagram.com/anunciadoria" target="_blank"><img src="[@dominio]/img/emkt/email-marketing_15.jpg" alt="Instagram" title="Instagram"></a>&nbsp;&nbsp;<a href="https://www.youtube.com/channel/UCSQ4Sr-u7gYDbzxAVydOEdw" target="_blank"><img src="[@dominio]/img/emkt/email-marketing_yt.jpg" alt="YouTube" title="YouTube"></a>\r\n</td>\r\n	</tr>\r\n	<tr><td colspan="9" width="600" height="25" ></td></tr>\r\n	<tr>\r\n		<td colspan="9" align="center">\r\n        <font size="1" face="Arial, Helvetica, sans-serif" color="#8e8e8e">Copyright 2016 - </font>\r\n        <font size="1" face="Arial, Helvetica, sans-serif" color="#9e0116"> Anunciadoria</font><br>\r\n		<font size="1" face="Arial, Helvetica, sans-serif" color="#8e8e8e">Todos os direitos reservados</font>\r\n        <br><br>\r\n        </td>\r\n	</tr>\r\n	<tr>\r\n    	<td width="63" height="1" ></td><td width="139" height="1"></td><td width="56" height="1"></td>\r\n		<td width="35" height="1"></td><td width="14" height="1"></td><td width="34" height="1"></td>\r\n		<td width="62" height="1"></td><td width="133" height="1"></td><td width="64" height="1"></td>\r\n    </tr>\r\n</table>\r\n</body>\r\n</html>', '2015-04-22 13:42:34', 'motivo-nao-aprovado');

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `tb_anuncio`
--
ALTER TABLE `tb_anuncio`
  ADD CONSTRAINT `ta001_ix` FOREIGN KEY (`bairro_id`) REFERENCES `tb_bairro` (`bairro_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ta002_ix` FOREIGN KEY (`cadastro_id`) REFERENCES `tb_cadastro` (`cadastro_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_anuncio_foto`
--
ALTER TABLE `tb_anuncio_foto`
  ADD CONSTRAINT `taf001_ix` FOREIGN KEY (`anuncio_id`) REFERENCES `tb_anuncio` (`anuncio_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_anuncio_interesse`
--
ALTER TABLE `tb_anuncio_interesse`
  ADD CONSTRAINT `tai001_ix` FOREIGN KEY (`anuncio_id`) REFERENCES `tb_anuncio` (`anuncio_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tai002_ix` FOREIGN KEY (`interesse_item_id`) REFERENCES `tb_interesse_item` (`interesse_item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_anuncio_relatorio`
--
ALTER TABLE `tb_anuncio_relatorio`
  ADD CONSTRAINT `tar001_ix` FOREIGN KEY (`anuncio_id`) REFERENCES `tb_anuncio` (`anuncio_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_bairro`
--
ALTER TABLE `tb_bairro`
  ADD CONSTRAINT `tb001_ix` FOREIGN KEY (`cidade_id`) REFERENCES `tb_cidade` (`cidade_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_cadastro_contato`
--
ALTER TABLE `tb_cadastro_contato`
  ADD CONSTRAINT `tcc00001_ix` FOREIGN KEY (`cid`) REFERENCES `tb_cadastro` (`cadastro_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tcc001_ix` FOREIGN KEY (`anuncio_id`) REFERENCES `tb_anuncio` (`anuncio_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tcc002_ix` FOREIGN KEY (`cadastro_id`) REFERENCES `tb_cadastro` (`cadastro_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_cadastro_interesse`
--
ALTER TABLE `tb_cadastro_interesse`
  ADD CONSTRAINT `tci001_ix` FOREIGN KEY (`cadastro_id`) REFERENCES `tb_cadastro` (`cadastro_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tci002_ix` FOREIGN KEY (`interesse_item_id`) REFERENCES `tb_interesse_item` (`interesse_item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_cadastro_relatorio`
--
ALTER TABLE `tb_cadastro_relatorio`
  ADD CONSTRAINT `tcr0001_ix` FOREIGN KEY (`cadastro_id`) REFERENCES `tb_cadastro` (`cadastro_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_cidade`
--
ALTER TABLE `tb_cidade`
  ADD CONSTRAINT `tc001_ix` FOREIGN KEY (`estado_id`) REFERENCES `tb_estado` (`estado_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `tb_interesse_item`
--
ALTER TABLE `tb_interesse_item`
  ADD CONSTRAINT `tii001_ix` FOREIGN KEY (`interesse_id`) REFERENCES `tb_interesse` (`interesse_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

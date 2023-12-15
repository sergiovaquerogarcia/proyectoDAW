-- phpMyAdmin SQL Dump
-- version 5.2.1-1.el8.remi
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 15-12-2023 a las 20:26:14
-- Versión del servidor: 8.0.32
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `qaim611`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `nombre` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `activo` int NOT NULL,
  `codCatPadre` int NOT NULL,
  `codigo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`nombre`, `activo`, `codCatPadre`, `codigo`) VALUES
('FACIAL', 1, 0, 1),
('DIA', 1, 1, 2),
('NOCHE', 1, 1, 3),
('CORPORAL', 1, 0, 4),
('BODY MILK', 1, 4, 5),
('ACEITES', 1, 4, 6),
('EXFOLIANTES', 1, 4, 7),
('MANOS', 1, 0, 8),
('PIES', 1, 0, 9),
('ESMALTES', 1, 0, 10),
('PINTALABIOS', 1, 0, 11),
('SPA', 0, 4, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `codCita` int NOT NULL,
  `codUsuario` int NOT NULL,
  `fechaCita` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `horaCita` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `total` decimal(6,2) NOT NULL,
  `activo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`codCita`, `codUsuario`, `fechaCita`, `horaCita`, `total`, `activo`) VALUES
(1, 1, '2023-10-25', '12:00', 6.00, 1),
(2, 4, '2023-10-31', '10:00', 3.00, 1),
(3, 3, '2023-11-10', '14:30', 18.00, 1),
(4, 5, '2023-11-10', '13:30', 30.00, 1),
(5, 5, '2023-11-13', '14:00', 34.00, 1),
(6, 1, '2023-11-16', '12:00', 38.00, 1),
(7, 1, '2023-11-16', '10:00', 30.00, 1),
(8, 2, '2023-11-17', '15:00', 53.00, 1),
(9, 4, '2023-11-16', '11:00', 18.00, 1),
(10, 2, '2023-11-17', '14:30', 50.00, 0),
(11, 3, '2023-11-17', '10:00', 40.00, 1),
(12, 2, '2023-11-17', '10:30', 3.00, 0),
(13, 7, '2023-11-17', '13:00', 70.00, 1),
(14, 8, '2023-11-17', '10:30', 43.00, 1),
(15, 4, '2023-11-17', '16:00', 30.00, 1),
(16, 4, '2023-11-17', '12:30', 18.00, 1),
(17, 4, '2023-11-17', '11:00', 30.00, 1),
(18, 4, '2023-11-18', '10:00', 35.00, 0),
(19, 5, '2023-11-23', '10:00', 55.00, 1),
(20, 5, '2023-11-18', '10:30', 35.00, 0),
(21, 4, '2023-11-18', '17:00', 45.00, 0),
(22, 11, '2023-11-23', '10:30', 128.00, 1),
(23, 4, '2023-11-25', '14:30', 104.99, 1),
(24, 12, '2023-11-30', '15:30', 38.00, 1),
(25, 5, '2023-11-30', '10:00', 52.00, 1),
(26, 13, '2023-12-05', '12:00', 36.00, 1),
(27, 12, '2023-12-05', '15:00', 3.00, 1),
(28, 2, '2023-12-02', '10:00', 38.00, 1),
(29, 7, '2023-12-04', '10:30', 33.00, 1),
(30, 1, '2023-12-05', '10:00', 30.00, 1),
(31, 8, '2023-12-05', '16:30', 35.00, 1),
(32, 1, '2023-12-04', '13:30', 50.00, 1),
(33, 3, '2023-12-07', '11:30', 60.00, 1),
(34, 12, '2023-12-06', '13:30', 27.00, 1),
(35, 12, '2023-12-08', '11:00', 43.00, 1),
(36, 1, '2023-12-21', '12:00', 65.00, 1),
(37, 4, '2023-12-14', '10:00', 30.00, 1),
(38, 4, '2023-12-15', '11:00', 33.00, 0),
(39, 5, '2023-12-15', '12:00', 20.00, 1),
(40, 4, '2024-2-02', '10:00', 3.00, 0),
(41, 4, '2024-1-05', '14:30', 40.00, 1),
(42, 2, '2023-12-14', '13:00', 30.00, 1),
(43, 2, '2023-12-15', '13:00', 30.00, 1),
(44, 11, '2023-12-15', '15:00', 35.00, 1),
(45, 3, '2023-12-15', '16:00', 35.00, 1),
(46, 3, '2024-2-02', '12:30', 30.00, 1),
(47, 1, '2023-12-20', '10:00', 35.00, 1),
(48, 7, '2023-12-20', '12:30', 40.00, 1),
(49, 12, '2023-12-20', '10:30', 30.00, 1),
(50, 12, '2024-1-02', '10:00', 21.00, 1),
(51, 12, '2023-12-22', '11:00', 35.00, 1),
(52, 7, '2023-12-22', '12:00', 50.00, 1),
(53, 3, '2024-1-12', '10:30', 13.00, 1),
(54, 5, '2024-1-02', '11:30', 30.00, 1),
(55, 2, '2023-12-21', '13:00', 50.00, 1),
(56, 2, '2023-12-22', '11:30', 30.00, 1),
(57, 2, '2023-12-27', '16:00', 21.00, 1),
(58, 1, '2023-12-27', '10:30', 35.00, 1),
(59, 12, '2023-12-23', '13:30', 45.00, 0),
(60, 3, '2023-12-21', '15:00', 41.00, 0),
(61, 12, '2023-12-27', '12:00', 33.00, 0),
(62, 12, '2023-12-27', '10:00', 30.00, 0),
(63, 12, '2023-12-27', '13:30', 38.00, 0),
(64, 3, '2023-12-27', '12:00', 38.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familias`
--

CREATE TABLE `familias` (
  `codFamilia` int NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `activo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `familias`
--

INSERT INTO `familias` (`codFamilia`, `nombre`, `activo`) VALUES
(1, 'DEPILACIONES', 1),
(2, 'MANOS Y PIES', 1),
(3, 'CUIDADO PIEL', 1),
(4, 'TRATAMIENTOS CORPORALES', 1),
(5, 'MASAJES', 1),
(6, 'BORRAR', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lincitas`
--

CREATE TABLE `lincitas` (
  `numLinea` int NOT NULL,
  `codCita` int NOT NULL,
  `codServicio` int NOT NULL,
  `unidades` int NOT NULL,
  `precio` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `lincitas`
--

INSERT INTO `lincitas` (`numLinea`, `codCita`, `codServicio`, `unidades`, `precio`) VALUES
(1, 1, 1, 1, 3.00),
(1, 2, 2, 1, 3.00),
(1, 3, 1, 1, 3.00),
(1, 4, 10, 1, 30.00),
(1, 5, 1, 1, 3.00),
(1, 6, 1, 1, 3.00),
(1, 7, 10, 1, 30.00),
(1, 8, 7, 1, 15.00),
(1, 9, 3, 1, 18.00),
(1, 10, 10, 1, 30.00),
(1, 11, 11, 1, 40.00),
(1, 12, 2, 1, 3.00),
(1, 13, 10, 1, 30.00),
(1, 14, 5, 1, 12.00),
(1, 15, 10, 1, 30.00),
(1, 16, 1, 1, 3.00),
(1, 17, 10, 1, 30.00),
(1, 18, 7, 1, 15.00),
(1, 19, 6, 1, 10.00),
(1, 20, 7, 1, 15.00),
(1, 21, 5, 1, 12.00),
(1, 22, 1, 1, 3.00),
(1, 23, 16, 1, 64.99),
(1, 24, 1, 1, 3.00),
(1, 25, 5, 1, 12.00),
(1, 26, 8, 1, 18.00),
(1, 27, 1, 1, 3.00),
(1, 28, 1, 1, 3.00),
(1, 29, 6, 1, 10.00),
(1, 30, 10, 1, 30.00),
(1, 31, 13, 1, 35.00),
(1, 32, 14, 1, 50.00),
(1, 33, 9, 1, 20.00),
(1, 34, 5, 1, 12.00),
(1, 35, 1, 1, 3.00),
(1, 36, 10, 1, 30.00),
(1, 37, 10, 1, 30.00),
(1, 38, 10, 1, 30.00),
(1, 39, 9, 1, 20.00),
(1, 40, 1, 1, 3.00),
(1, 41, 11, 1, 40.00),
(1, 42, 10, 1, 30.00),
(1, 43, 4, 1, 12.00),
(1, 44, 13, 1, 35.00),
(1, 45, 7, 1, 15.00),
(1, 46, 10, 1, 30.00),
(1, 47, 13, 1, 35.00),
(1, 48, 11, 1, 40.00),
(1, 49, 10, 1, 30.00),
(1, 50, 1, 1, 3.00),
(1, 51, 13, 1, 35.00),
(1, 52, 14, 1, 50.00),
(1, 53, 1, 1, 3.00),
(1, 54, 10, 1, 30.00),
(1, 55, 14, 1, 50.00),
(1, 56, 10, 1, 30.00),
(1, 57, 1, 1, 3.00),
(1, 58, 13, 1, 35.00),
(1, 59, 5, 1, 12.00),
(1, 60, 1, 1, 3.00),
(1, 61, 1, 1, 3.00),
(1, 62, 10, 1, 30.00),
(1, 63, 1, 1, 3.00),
(1, 64, 8, 1, 18.00),
(2, 1, 2, 1, 3.00),
(2, 3, 7, 1, 15.00),
(2, 5, 6, 1, 10.00),
(2, 6, 7, 1, 15.00),
(2, 8, 8, 1, 18.00),
(2, 10, 9, 1, 20.00),
(2, 13, 12, 1, 40.00),
(2, 14, 6, 1, 10.00),
(2, 16, 7, 1, 15.00),
(2, 18, 9, 1, 20.00),
(2, 19, 7, 1, 15.00),
(2, 20, 9, 1, 20.00),
(2, 21, 1, 1, 3.00),
(2, 22, 10, 1, 30.00),
(2, 23, 12, 1, 40.00),
(2, 24, 13, 1, 35.00),
(2, 25, 11, 1, 40.00),
(2, 26, 3, 1, 18.00),
(2, 28, 7, 1, 15.00),
(2, 29, 2, 1, 3.00),
(2, 33, 12, 1, 40.00),
(2, 34, 1, 1, 3.00),
(2, 35, 10, 1, 30.00),
(2, 36, 13, 1, 35.00),
(2, 38, 2, 1, 3.00),
(2, 43, 3, 1, 18.00),
(2, 45, 9, 1, 20.00),
(2, 50, 3, 1, 18.00),
(2, 53, 6, 1, 10.00),
(2, 57, 3, 1, 18.00),
(2, 59, 1, 1, 3.00),
(2, 60, 8, 1, 18.00),
(2, 61, 10, 1, 30.00),
(2, 63, 13, 1, 35.00),
(2, 64, 9, 1, 20.00),
(3, 5, 2, 1, 3.00),
(3, 6, 9, 1, 20.00),
(3, 8, 9, 1, 20.00),
(3, 14, 2, 1, 3.00),
(3, 19, 4, 1, 12.00),
(3, 21, 4, 1, 12.00),
(3, 22, 7, 1, 15.00),
(3, 28, 9, 1, 20.00),
(3, 29, 9, 1, 20.00),
(3, 34, 4, 1, 12.00),
(3, 35, 6, 1, 10.00),
(3, 59, 10, 1, 30.00),
(3, 60, 9, 1, 20.00),
(4, 5, 8, 1, 18.00),
(4, 14, 8, 1, 18.00),
(4, 19, 3, 1, 18.00),
(4, 21, 3, 1, 18.00),
(4, 22, 12, 1, 40.00),
(5, 22, 11, 1, 40.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linpedidos`
--

CREATE TABLE `linpedidos` (
  `numLinea` int NOT NULL,
  `numPedido` int NOT NULL,
  `codProducto` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `unidades` int NOT NULL,
  `precio` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `linpedidos`
--

INSERT INTO `linpedidos` (`numLinea`, `numPedido`, `codProducto`, `unidades`, `precio`) VALUES
(1, 1, '5001', 1, 10.95),
(1, 2, '1001', 2, 70.84),
(1, 3, '4001', 2, 21.68),
(1, 4, '1003', 1, 28.00),
(1, 5, '3002', 2, 29.90),
(1, 6, '2003', 1, 21.00),
(1, 7, '2002', 2, 43.56),
(1, 8, '1003', 1, 28.00),
(1, 9, '1004', 2, 79.00),
(1, 10, '2003', 1, 21.00),
(1, 11, '1001', 1, 35.42),
(2, 2, '1002', 1, 53.90),
(2, 3, '6002', 1, 24.61),
(2, 4, '8002', 3, 16.35),
(2, 5, '8001', 1, 43.20),
(2, 6, '8002', 4, 21.80),
(2, 7, '8001', 1, 43.20),
(2, 10, '5002', 3, 37.35),
(2, 11, '6001', 2, 40.76),
(3, 2, '7001', 1, 9.99);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `numPedido` int NOT NULL,
  `fechaPedido` date NOT NULL,
  `codUsuario` int NOT NULL,
  `estado` varchar(11) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `total` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`numPedido`, `fechaPedido`, `codUsuario`, `estado`, `total`) VALUES
(1, '2023-10-20', 11, 'RECIBIDO', 10.95),
(2, '2023-11-20', 11, 'ENVIADO', 134.73),
(3, '2023-11-25', 1, 'RECIBIDO', 46.29),
(4, '2023-11-25', 5, 'RECIBIDO', 44.35),
(5, '2023-11-25', 5, 'ENVIADO', 73.10),
(6, '2023-11-25', 12, 'RECIBIDO', 42.80),
(7, '2023-12-01', 2, 'RECIBIDO', 86.76),
(8, '2023-12-05', 12, 'ENVIADO', 28.00),
(9, '2023-12-04', 1, 'RECIBIDO', 79.00),
(10, '2023-12-01', 3, 'RECIBIDO', 58.35),
(11, '2023-12-13', 8, 'RECIBIDO', 76.18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `codigo` varchar(4) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nombre` varchar(80) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `imagen` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `descuento` decimal(6,2) NOT NULL,
  `activo` int NOT NULL,
  `codigoCategoria` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`codigo`, `nombre`, `descripcion`, `imagen`, `precio`, `descuento`, `activo`, `codigoCategoria`) VALUES
('1001', 'CREMA DE DÃA ANTI-ARRUGAS RELLENADORA.', 'LA PIEL QUEDA HIDRATADA, LISA Y DENSIFICADA.  50 ML. INMEDIATAMENTE, LA PIEL QUE', '../Images/1001.png', 46.00, 23.00, 1, 2),
('1002', 'OLAY. REGENERIST CREMA DÃ­A SPF 30 | 50ML.', 'CREMA FACIAL REAFIRMANTE CON PROTECCIÃ³N. HIDRATA, REAFIRMA Y RENUEVA TU PIEL.  PROTEGE LA PIEL FRENTE A LOS DAÃ±INOS RAYOS UVA Y UVB CON LA CREMA DE DÃ­A OLAY REGENERIST CON SPF 30.  SU FÃ³RMULA HIDRATANTE ENRIQUECIDA CON VITAMINA B3 (NIACINAMIDA).', '../Images/1002.png', 53.90, 0.00, 1, 2),
('1003', 'CEMA MULTI-ACCIÃ“N CONFORT NOCHE. ', 'ESTA CREMA DE NOCHE DEJA LA PIEL LISA DE FORMA INMEDIATA.  DESDE LA 1Âª NOCHE, LA LUMINOSIDAD SE REAVIVA Y LOS RASGOS SE RELAJAN. INMEDIATAMENTE, LAS ARRUGAS Y  EL TONO DE LA PIEL SE VUELVE UNIFORME', '../Images/1003.png', 56.00, 50.00, 1, 3),
('1004', 'TRATAMIENTO RECUPERADOR DE NOCHE. ', 'EL TRATAMIENTO RECUPERADOR DE NOCHE DEJA LA PIEL TERSA Y FRESCA DESDE EL PRIMER DESPERTAR. A PARTIR DE 1 MES, LAS ARRUGAS Y PEQUEÃ‘AS ARRUGAS SE REDUCEN; LA PIEL ESTÃ FORTALECIDA Y LUCE MÃS SALUDABLE Y LUMINOSA.\r\nPIEL DESCANSADA DESDE LA PRIMERA NOCHE\r\n', '../Images/1004.png', 39.50, 0.00, 1, 3),
('2001', 'SHISEIDO SUPER SLIMMING REDUCER | 200ML', 'GEL CREMA EFECTO ANTI CELULÃ­TICO Y ADELGAZANTE.\r\nGEL CREMA DE SHISEIDO CON UN GRAN EFECTO ADELGAZANTE Y ANTICELULITICO, REMODELAN LA SILUETA, LA CINTURA SE REDUCE. SUPER SLIMMING DESTRUYE Y QUEMA LA GRASA ACUMULADA EN DETERMINADAS PARTES DEL CUERPO.\r\n', '../Images/2001.png', 99.99, 40.00, 1, 5),
('2002', 'BODY CARE. GERALDINA - BRUNO VASSARI. LECHE CORPORAL REAFIRMANTE.', 'LECHE CORPORAL AL COLÃ¡GENO QUE MEJORA LA ELASTICIDAD Y LA FIRMEZA DE TU PIEL.\r\nDOSIFICADOR DE 500 ML.\r\nSU FÃ³RMULA ESTÃ¡ BASADA EN EL COLÃ¡GENO QUE MEJORA LA ELASTICIDAD Y FIRMEZA DE LA PIEL, LA ALANTOINA QUE NUTRE Y REPARA EL TEJIDO.', '../Images/2002.png', 24.20, 10.00, 1, 5),
('2003', 'BÃ¡LSAMO REPARADOR PIELES MUY SECAS. REPARA Y NUTRE LAS PIELES EXTRA SECAS.', 'CON ESTE BÃ¡LSAMO, REPARA Y NUTRE INTENSAMENTE LA PIEL EXTRA SECA Y AGRIETADA. INMEDIATAMENTE CALMADA DE LA SENSACIÃ³N DE TIRANTEZ, LA PIEL QUEDA MÃ¡S FLEXIBLE, LISA AL TACTO Y PROTEGIDA.\r\nENRIQUECIDA CON MANTECA DE KARITÃ©.\r\nTAMAÃ±O 150 ML.', '../Images/2003.png', 21.00, 0.00, 1, 5),
('3001', 'ARGANOUR. ACEITE DE COCO ECOLÃ³GICO | 250ML', 'HIDRATA INTENSAMENTE CUERPO Y CABELLO.\r\nACEITE DE COCO ECOLÃ³GICO ARGANOUR ESTÃ¡ ELABORADO A PARTIR DE COCO DE CULTIVO ECOLÃ³GICO, CON UN AROMA MUY AGRADABLE.\r\nESTÃ¡ ELABORADO A PARTIR DE LA PULPA DE COCOS RECIÃ©N RECOLECTADOS. \r\nTAMAÃ±O 100 ML', '../Images/3001.png', 45.95, 5.00, 1, 6),
('3002', 'ACEITE DORADO HIDRATANTE', 'UN ACEITE NACARADO PARA UNA PIEL INTENSAMENTE HIDRATADA Y DELICADAMENTE SATINADA\r\nTAMAÃ±O 100 ML.\r\nENRIQUECIDO CON MONOI DE TAHITI (2%) Y CON FINOS NÃ¡CARES, ESTE ACEITE HIDRATA INTENSAMENTE LA PIEL E ILUMINA EL BRONCEADO.', '../Images/3002.png', 14.95, 0.00, 1, 6),
('4001', 'GEL SÃ³LIDO EXFOLIANTE. REVITALIZA LA PIEL OXIGENÃ¡NDOLA. ', 'L GEL DE DUCHA SÃ³LIDO EXFOLIANTE DE DR. TREE LIMPIA, CALMA, HIDRATA Y PROTEGE, GENERANDO UNA ESPUMA, SUAVE, CREMOSA Y DELICADA. EL GEL ES UN CONCENTRADO CREMOSO, NO CONGLOMERADO. FORMULADO CON ALGA DE WAKAME, ACEITES ESENCIALES DE ROMERO BIO.', '../Images/4001.png', 12.75, 15.00, 1, 7),
('4002', 'METAMORFOSIS Â· EXFOLIANTE CORPORAL EXTRA NUTRITIVO Â· 200G', 'NUTRE Y EXFOLIA LA PIEL, HIDRATÃ¡NDOLA EN PROFUNDIDAD. SUS VITAMINAS Y ESENCIAS PROMUEVEN EL ENTUSIASMO Y VITALIDAD.\r\nEL EXFOLIANTE CORPORAL EXTRANUTRITIVO METAMORFOSIS NUTRE Y EXFOLIA LA PIEL EN PROFUNDIDAD, HIDRATÃ¡NDOLA Y APORTANDO LUMINOSIDAD.', '../Images/4002.png', 54.99, 5.00, 1, 7),
('5001', 'CLARESA ESMALTE SEMIPERMANENTE NUDE ESMALTE NUDE', 'CLARESA ES UNA MARCA 100% EUROPEA ESPECIALIZADA EN OFRECER ESMALTES SEMIPERMANENTES BARATOS, 10 FREE Y VEGANOS, ES DECIR, NO CONTIENEN INGREDIENTES ANIMALES, SON TOTALMENTE SEGUROS Y SIN INGREDIENTES TÃ³XICOS, Y SU PRECIO ES MUY ECONÃ³MICO.', '../Images/5001.png', 10.95, 0.00, 1, 10),
('5002', 'OPI NAIL LACQUER COLECCIÃ³N GRANATES LACA DE UÃ±AS DURACIÃ³N HASTA 7 DÃ­AS', 'ESMALTE NAIL LACQUER - COLECCIÃ³N GRANATES DE OPI\r\n\r\nESMALTE DE DURACIÃ³N DE HASTA 7 DÃ­AS DE OPI, LÃ­DER MUNDIAL EN EL CUIDADO PROFESIONAL DE LAS UÃ±AS. Â¡PORQUE LA VIDA ES MUY CORTA PARA TENER UÃ±AS ABURRIDAS!', '../Images/5002.png', 12.45, 0.00, 1, 10),
('5003', 'ESSENCE GEL NAIL COLOUR ESMALTE DE UNAS ESMALTE DE UÃ±AS', 'Â¡BELLEZA LIMPIA CON UN RENDIMIENTO ESPECTACULAR! NO HAY PREOCUPACIONES CON LOS ESMALTES DE UÃ±AS GEL NAIL COLOUR: SON FÃ¡CILES DE APLICAR GRACIAS AL PINCEL ANCHO, PATENTADO \"DOBLE TOQUE\" Y SE SECAN EXTREMADAMENTE RÃ¡PIDO, EN SOLO 40 SEGUNDOS. ', '../Images/catrice.png', 21.45, 50.00, 1, 10),
('5004', 'OPI OPI TAMARA FALCO 10 MINIS | 1UD ESTUCHE LACA UÃ±AS', 'PACK DE 4 MINI ESMALTES DE UÃ±AS DEL SISTEMA NAIL LACQUER DE DURACIÃ³N HASTA 7 DÃ­AS DE LA COLECIÃ³N TAMARAXOPI. DÃ©JATE LLEVAR POR EL COLOR DE TRES DE LOS ICÃ³NICO DE OPI: TOP COAT + BUBBLE BATH + BIG APPLE RED + MALAGA WINE', '../Images/Tri-coastal.png', 38.95, 5.00, 1, 10),
('5555', 'HOLA QUE TAL', 'HOLA QUE TAL', '../Images/7001.png', 45.00, 0.00, 0, 8),
('6001', 'CREMA PARA PIES NUTRITIVA. ORGANIC KITCHEN', 'UNA SENSACIÃ³N DE FIABILIDAD Y APOYO PARA SUS MANOS Y CODOS. NUTRICIÃ³N EXTRA PARA PIELES SECAS QUE REQUIEREN CUIDADOS ESPECIALES. LA MANTECA DE KARITÃ© REPARA PROFUNDAMENTE LA PIEL Y LA DEJA SUAVE Y TERSA.', '../Images/6001.png', 21.45, 5.00, 1, 9),
('6002', 'CREMA DE PIES KARITÃ©', 'IDEAL PARA\r\n- PIEL SECA A MUY SECA\r\n- NUTRE Y REDUCE LAS ASPEREZAS DE LOS PIES\r\n- AYUDA A CALMAR INMEDIATAMENTE LOS PIES SECOS A MUY SECOS\r\nTAMAÃ±O 150 ML', '../Images/6002.png', 28.95, 15.00, 1, 9),
('6003', 'GEL FRÃ­O CALMANTE DE PIES. REFRESCA TUS PIES', 'EL GEL \"EFECTO HIELO\" ALIVIA LOS PIES Y PIERNAS CANSADAS.CON LAVANDA BIO FRANCESA, SELECCIONADA POR SUS PROPIEDADES CALMANTES Y PROTECTORAS.\r\nAPLICAR 2 VECES AL DÃ­A SOBRE LOS PIES MASAJEANDO Y RETOMAR A LO LARGO DE LAS PIERNAS.\r\n', '../Images/6003.png', 35.25, 0.00, 1, 9),
('6004', 'PRODUCTO BORRAR', 'PRODUCTOS PARA BORRAR', '../Images/Captura de pantalla (1).png', 24.75, 0.00, 0, 8),
('7001', 'KIKO MILANO 3D HYDRA LIPGLOSS 17', 'BRILLO DE LABIOS EMOLIENTE EFECTO 3D PARA UN RESULTADO BRILLANTE.\r\nLA TEXTURA, SUAVE Y SENSORIAL, SE FUNDE SOBRE LOS LABIOS DEJÃ¡NDOLOS LISOS Y BRILLANTES, LA TEXTURA NO ES PEGAJOSA Y OFRECE UNA LARGA DURACIÃ³N.', '../Images/7001.png', 9.99, 0.00, 1, 11),
('7002', 'ESSENCE  BRILLO DE LABIOS VOLUMINIZADOR EXTREME SHINE', 'EL BRILLO DE LABIOS EXTREME SHINE VOLUME ES IMPRESCINDIBLE PARA UNOS LABIOS PRECIOSOS CON UN ASPECTO MOJADO, SIN SILICONAS, PARTÃ­CULAS DE MICROPLÃ¡STICOS, ALCOHOL NI ACEITE. Y ESO NO ES TODO: LA GAMA OFRECE TRES BENEFICIOS DIFERENTES.', '../Images/7002.png', 9.95, 0.00, 1, 11),
('7003', 'DIOR ROUGE DIOR FOREVERMATE. MATE ULTRAPIGMENTADO', 'ROUGE DIOR FOREVER ES LA BARRA DE LABIOS DIOR QUE NO TRANSFIERE CON 16 HORAS* DE DURACIÃ³N, QUE COMBINA COMODIDAD EFECTO SEGUNDA PIEL CON UNA FÃ³RMULA CONCENTRADA EN TRATAMIENTO FLORAL.', '../Images/dior.png', 48.00, 15.00, 1, 11),
('7004', 'GUERLAIN KISSKISS. BARRA LABIOS MATE LUMINOSA', 'GUERLAIN REVELA TODA LA TERNURA DEL MATE CON KISSKISS TENDER MATTE, LA BARRA DE LABIOS MATE LUMINOSA TAN DELICADA COMO UN BESO.\r\nÃCIDO HIALURÃ³NICO PARA ALISAR, RELLENAR E HIDRATAR LOS LABIOS CONTINUAMENTE.\r\nMANTECA DE KARITÃ© PARA NUTRIR LOS LABIOS.', '../Images/7004.png', 46.55, 40.00, 1, 11),
('8001', 'DIOR ROSA MOSQUETA | 100ML', 'CREMA DE MANOS DE ROSA MOSQUETA DE TEXTURA LIGERA Y FÃ¡CIL ABSORCIÃ³N PARA TODO TIPO DE PIELES.\r\nADEMÃ¡S, SU AROMA TE CAUTIVARÃ¡, RECORDÃ¡NDOTE A LAS COLORIDAS Y VOLUPTUOSAS ROSAS DE LOS CAMPOS DE PRIMAVERA.', '../Images/8001.png', 48.00, 10.00, 1, 8),
('8002', 'NIVEA NIVEA | 1UD CREMA DE MANOS', 'NIVEA CREME EDICIÃ³N LIMITADA ORGULLO 150 ML ES LA CREMA HIDRATANTE UNIVERSAL PARA EL CUIDADO DE TODO TIPO DE PIEL, PARA TODA LA FAMILIA. \r\nESTE ICÃ³NICO PRODUCTO, QUE REVOLUCIONÃ³ EL MUNDO DEL CUIDADO DE LA PIEL HACE MÃ¡S 100 AÃ±OS.', '../Images/8002.png', 5.45, 0.00, 1, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `codServicio` int NOT NULL,
  `descripcion` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `descuento` decimal(6,2) NOT NULL,
  `duracionServicio` int NOT NULL,
  `codFamilia` int NOT NULL,
  `activo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`codServicio`, `descripcion`, `precio`, `descuento`, `duracionServicio`, `codFamilia`, `activo`) VALUES
(1, 'CEJAS', 3.00, 0.00, 15, 1, 1),
(2, 'LABIO SUPERIOR', 3.00, 0.00, 30, 1, 1),
(3, 'PIERNAS', 18.00, 0.00, 30, 1, 1),
(4, 'PECHO', 12.00, 0.00, 30, 1, 1),
(5, 'BRAZOS', 12.00, 0.00, 30, 1, 1),
(6, 'INGLES', 10.00, 0.00, 15, 1, 1),
(7, 'MANICURA', 15.00, 0.00, 30, 2, 1),
(8, 'MANICURA PERMANENTE', 18.00, 0.00, 60, 2, 1),
(9, 'PEDICURA', 20.00, 0.00, 60, 2, 1),
(10, 'HIGIENE FACIAL', 30.00, 0.00, 60, 3, 1),
(11, 'TRATAMIENTO FACIAL: PUNTA DE DIAMANTE', 40.00, 0.00, 60, 3, 1),
(12, 'TRATAMIENTO FACIAL: ÃCIDO GLICÃ“LICO', 40.00, 5.00, 60, 3, 1),
(13, 'MASAJE ESPALDA', 35.00, 0.00, 30, 5, 1),
(14, 'MASAJE CON ACEITES ESENCIALES', 50.00, 0.00, 45, 5, 1),
(15, 'BODY TOTAL. REAFIRMANTE', 99.95, 0.00, 60, 4, 1),
(16, 'FULL BODY CON ÃCIDO HIALURÃ“NICO', 64.99, 0.00, 60, 4, 1),
(17, 'BORRAR', 24.95, 0.00, 15, 1, 0),
(18, 'SERVICIO NUEVO', 23.45, 0.00, 30, 1, 0),
(19, 'PRODUCTO FAMILIA BORRAR', 24.75, 0.00, 30, 6, 0),
(20, 'NO VALE BORRAR', 1.00, 0.00, 15, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `codUsuario` int NOT NULL,
  `dni` varchar(9) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `clave` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nombre` varchar(80) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `direccion` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `cp` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `poblacion` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `provincia` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `telefono` varchar(9) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `tipoUsuario` int NOT NULL,
  `activo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`codUsuario`, `dni`, `clave`, `email`, `nombre`, `direccion`, `cp`, `poblacion`, `provincia`, `telefono`, `tipoUsuario`, `activo`) VALUES
(1, '03759666V', '$2y$10$GlwDu7i/G5RoRhV7yVzfv.uP3bxBoAcHLLA5Py9AwEh1UVSJbgxPW', 'vicentevaquerog@gmail.com', 'VICENTE VAQUERO PEREZ', 'C/ ANTONIO MORA FERRANDEZ, NÂº 45', '48001', 'MADRID', 'MADRID', '965420686', 3, 1),
(2, '11111111H', '$2y$10$TWNUt9Y6diIPubftohDoW.lpjxZCcMgE.nfozMOHHPpOzI4972wpu', 'anagarcia@gmail.com', 'ANA GARCIA BAUTISTA', 'C/ GREGORIO MARAÃ‘ON, NÂº 125', '32001', 'VALENCIA', 'VALENCIA', '965420686', 2, 1),
(3, '22222222J', '$2y$10$.Rn4TikFqGiBjXNmo88duufBjaVDyFzYp57L2UQ4pXWkfzU.IKhju', 'merchequesada@hotmail.com', 'MERCHE QUESADA IRLES', 'C/ RIO TURIA, NÂº 24 - 5Âª PLANTA', '48002', 'ALBACETE', 'ALBACETE', '666789218', 3, 1),
(4, '33490565N', '$2y$10$BzvrVGBxIsJpcIERxcGk9OU9AkofjWwmt41kINQKyolrHfMcC6ZK6', 'svg26@msn.com', 'SERGIO VAQUERO GARCIA', 'C/ HILARION ESLAVA, NÂº 70', '03204', 'ELCHE', 'ALICANTE', '676312536', 1, 1),
(5, '45568550F', '$2y$10$8DfgwlNNoX9Umcyo4MlSg.gAct35K.qrIc8dTPNlPnFG0EKH4kOX2', 'jorgealedo@hotmail.com', 'JORGE ALEDO TERRES         ', ' C/ BARCELONA, NÂº 125', '08006', 'BARCELONA', 'BARCELONA', '657067289', 3, 1),
(7, '', '$2y$10$52OMs2.1MizwJDDq5mdDsefeoJI1QM.mRwXBWvLt54EFujXntNou6', 'mcarmen@gmail.com', 'MÂª CARMEN RUFIAS LIMORTE', '', '', '', '', '663455023', 3, 1),
(8, '', '$2y$10$RioGdN32r/9yULht/OOoL.LRoDbCNXRljDSiBVIKe8BGEVhbo1LCu', 'julian@gmail.com', 'JULIAN GARCIA NAVAS-GARCIA', 'C/ AGUA, NÂº 20', '03349', 'SAN ISIDRO', 'ALICANTE', '966633700', 3, 1),
(9, '74242772Z', '$2y$10$SN7UFXFUnOddvCijCzoZi.W3XUeaVr4jy9HS3Y8ngQ4lswXGTPZoa', 'alejandro.fernandez@hotmail.com', 'ALEJANDRO FERNANDEZ RUTZ', 'CALLE RÃ­O DANUBIO, URB. ALTOS DEL LIMONAR', '03184', 'TORREVIEJA', 'ALICANTE', '658999326', 3, 0),
(10, '45568550F', '$2y$10$nOcb6egOlQGsuIxQv3qymu/fzR2A.fY1iFWlPyYNpvrhuu8Dvk0HG', 'jorgealedo@hotmail.cm', 'JORGE ALEDO ', 'ESLAVA 70 4', '03204', 'ELCHE', 'ALICANTE', '657067289', 3, 0),
(11, '04342837T', '$2y$10$rNsV7JOIjrDdHXdzaleWF.guoTcMvgyx/qSxon.oAPoX47LPTxHW6', 'juanarbujas@gmail.com', 'JUANJO TORRES', 'CALLE ELDA 36', '03013', 'ALICANTE ', 'ALICANTE ', '683479296', 3, 1),
(12, '33490565N', '$2y$10$622ZOP6FtbgWF16IrYQIuuc9M/5lwJxB754R50mEteAEwC9unBc8a', 'svaquerogarcia@gmail.com', 'SERGIO GARCIA PRIOR', 'AVDA. DE  ORIHUELA, NÂº 125 - 1Âª PLANTA', '03201', 'ELCHE', 'ALICANTE', '662502700', 3, 1),
(13, '', '$2y$10$o9BG244wUwBZ.PTCdb0pXOk3zOfTDhgd.VntMdx3omL5AwG8kZjza', 'cristg75@gmail.com', 'CAMILA SERRANO VAZQUEZ', '', '', '', '', '666123456', 3, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`codCita`);

--
-- Indices de la tabla `familias`
--
ALTER TABLE `familias`
  ADD PRIMARY KEY (`codFamilia`);

--
-- Indices de la tabla `lincitas`
--
ALTER TABLE `lincitas`
  ADD PRIMARY KEY (`numLinea`,`codCita`),
  ADD KEY `codCita` (`codCita`);

--
-- Indices de la tabla `linpedidos`
--
ALTER TABLE `linpedidos`
  ADD PRIMARY KEY (`numLinea`,`numPedido`) USING BTREE,
  ADD KEY `numPedido` (`numPedido`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`numPedido`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`codServicio`),
  ADD KEY `fkServiciosFamilias` (`codFamilia`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`codUsuario`) USING BTREE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

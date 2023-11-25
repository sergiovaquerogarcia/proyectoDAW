-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2023 a las 21:17:44
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `beautyandshop`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `nombre` varchar(50) NOT NULL,
  `activo` int(11) NOT NULL,
  `codCatPadre` int(11) NOT NULL,
  `codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`nombre`, `activo`, `codCatPadre`, `codigo`) VALUES
('SECADORES', 1, 0, 1),
('SECADORES MARCA BLANCA', 1, 1, 2),
('SECADOR GHD PEQUEñO', 0, 1, 3),
('PLANCHAS PELO', 1, 0, 4),
('PLANCHAS PELO VIAJE', 1, 4, 5),
('CHAMPÚS', 1, 0, 6),
('ACONDICIONADORES', 1, 0, 7),
('SECADORES MARCA GHD', 1, 1, 8),
('HOLD', 0, 0, 9),
('HOLD111', 0, 0, 10),
('AAAAA', 0, 0, 11),
('HOLDJJJJ', 0, 0, 12),
('DDDDDDDDDDDDDDDDDDDDDDDDDD', 0, 0, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `codCita` int(11) NOT NULL,
  `codUsuario` int(11) NOT NULL,
  `fechaCita` varchar(10) NOT NULL,
  `horaCita` varchar(5) NOT NULL,
  `total` decimal(6,2) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`codCita`, `codUsuario`, `fechaCita`, `horaCita`, `total`, `activo`) VALUES
(1, 1, '2023-10-25', '12:00', '6.00', 1),
(2, 4, '2023-10-31', '10:00', '3.00', 1),
(3, 3, '2023-11-10', '14:30', '18.00', 1),
(4, 5, '2023-11-10', '13:30', '30.00', 1),
(5, 5, '2023-11-13', '14:00', '34.00', 1),
(6, 1, '2023-11-16', '12:00', '38.00', 1),
(7, 1, '2023-11-16', '10:00', '30.00', 0),
(8, 2, '2023-11-17', '15:00', '53.00', 1),
(9, 4, '2023-11-16', '11:00', '18.00', 1),
(10, 2, '2023-11-17', '14:30', '50.00', 0),
(11, 3, '2023-11-17', '10:00', '40.00', 0),
(12, 2, '2023-11-17', '10:30', '3.00', 0),
(13, 7, '2023-11-17', '13:00', '70.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familias`
--

CREATE TABLE `familias` (
  `codFamilia` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `familias`
--

INSERT INTO `familias` (`codFamilia`, `nombre`, `activo`) VALUES
(1, 'Depilaciones', 1),
(2, 'Manos y Pies', 1),
(3, 'Cuidado Piel', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lincitas`
--

CREATE TABLE `lincitas` (
  `numLinea` int(11) NOT NULL,
  `codCita` int(11) NOT NULL,
  `codServicio` int(11) NOT NULL,
  `unidades` int(11) NOT NULL,
  `precio` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lincitas`
--

INSERT INTO `lincitas` (`numLinea`, `codCita`, `codServicio`, `unidades`, `precio`) VALUES
(1, 1, 1, 1, '3.00'),
(1, 2, 2, 1, '3.00'),
(1, 3, 1, 1, '3.00'),
(1, 4, 10, 1, '30.00'),
(1, 5, 1, 1, '3.00'),
(1, 6, 1, 1, '3.00'),
(1, 7, 10, 1, '30.00'),
(1, 8, 7, 1, '15.00'),
(1, 9, 3, 1, '18.00'),
(1, 10, 10, 1, '30.00'),
(1, 11, 11, 1, '40.00'),
(1, 12, 2, 1, '3.00'),
(1, 13, 10, 1, '30.00'),
(2, 1, 2, 1, '3.00'),
(2, 3, 7, 1, '15.00'),
(2, 5, 6, 1, '10.00'),
(2, 6, 7, 1, '15.00'),
(2, 8, 8, 1, '18.00'),
(2, 10, 9, 1, '20.00'),
(2, 13, 12, 1, '40.00'),
(3, 5, 2, 1, '3.00'),
(3, 6, 9, 1, '20.00'),
(3, 8, 9, 1, '20.00'),
(4, 5, 8, 1, '18.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linpedidos`
--

CREATE TABLE `linpedidos` (
  `numLinea` int(11) NOT NULL,
  `numPedido` int(11) NOT NULL,
  `codProducto` varchar(4) NOT NULL,
  `unidades` int(11) NOT NULL,
  `precio` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `linpedidos`
--

INSERT INTO `linpedidos` (`numLinea`, `numPedido`, `codProducto`, `unidades`, `precio`) VALUES
(1, 1, '2221', 1, '19.11'),
(1, 2, '2222', 1, '19.11'),
(1, 3, '1111', 2, '56.30'),
(1, 4, '5555', 1, '95.00'),
(1, 5, '6666', 1, '159.20'),
(1, 6, '2221', 1, '19.11'),
(1, 7, '2221', 1, '19.11'),
(1, 8, '2221', 1, '19.11'),
(1, 10, '2221', 1, '19.11'),
(1, 11, '4444', 1, '149.17'),
(1, 12, '2221', 1, '19.11'),
(2, 3, '2222', 1, '19.11'),
(2, 5, '8888', 1, '17.99'),
(3, 3, '4444', 1, '149.17'),
(3, 5, '9999', 1, '19.11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `numPedido` int(11) NOT NULL,
  `fechaPedido` date NOT NULL,
  `codUsuario` int(11) NOT NULL,
  `estado` varchar(11) NOT NULL,
  `total` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`numPedido`, `fechaPedido`, `codUsuario`, `estado`, `total`) VALUES
(10, '2023-02-17', 3, 'ENVIADO', '19.11'),
(11, '2023-02-17', 5, 'PREPARACION', '149.17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `codigo` varchar(4) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `descuento` decimal(6,2) NOT NULL,
  `activo` int(11) NOT NULL,
  `codigoCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`codigo`, `nombre`, `descripcion`, `imagen`, `precio`, `descuento`, `activo`, `codigoCategoria`) VALUES
('1111', 'SECADOR - BELLISIMA K9 2300', 'SECADOR - BELLISIMA K9 2300, 2300 W, 2 VELOCIDADES, 3 TEMPERATURAS, DIFUSOR, AIR', '../Images/1111.jpg', '32.95', '12.00', 1, 2),
('2221', 'CHAMPÚ KERASTASE CHRONOLOGISTE 2221', 'CHRONOLOGISTE BAIN RéGéNéRANT DE KéRASTASE. CHAMPú REGENERANTE Y REJUVENECEDOR 2221. ', '../Images/2222.jpg', '28.10', '32.00', 1, 6),
('2222', 'CHAMPÚ KERASTASE CHRONOLOGISTE 2222', 'CHRONOLOGISTE BAIN RéGéNéRANT DE KéRASTASE. CHAMPú REGENERANTE Y REJUVENECEDOR. ', '../Images/2222.jpg', '28.10', '32.00', 1, 6),
('2223', 'CHAMPÚ KERASTASE CHRONOLOGISTE 2223', 'CHRONOLOGISTE BAIN RéGéNéRANT DE KéRASTASE. CHAMPú REGENERANTE Y REJUVENECEDOR 2223. ', '../Images/2222.jpg', '28.10', '32.00', 1, 6),
('2224', 'CHAMPÚ KERASTASE CHRONOLOGISTE 2224', 'CHRONOLOGISTE BAIN RéGéNéRANT DE KéRASTASE. CHAMPú REGENERANTE Y REJUVENECEDOR 2224. ', '../Images/2222.jpg', '28.10', '32.00', 1, 6),
('3333', 'KéRASTASE CHAMPú BAIN VOLUMIFIQUE', 'CHAMPú CORPORIZANTE PARA CABELLO FINO QUE LAVA APORTANDO VOLUMEN Y LIGEREZA.', '../Images/3333.jpg', '17.99', '0.00', 1, 6),
('4444', 'PLANCHA MINI GHD VIAJE', 'GHD MINI ES UNA EXCELENTE OPCIóN PARA CREAR PEINADOS BIEN DEFINIDOS SOBRE CABELLOS CORTOS', '../Images/4444.jpg', '149.17', '0.00', 1, 5),
('5555', 'SECADOR PELO GHD AIR', 'EL SECADOR GHD AIR NOS PROPORCIONA UN SECADO DOS VECES MáS RáPIDO GRACIAS A SU EXCLUSIVO MOTOR AC PROFESIONAL DE 2100W Y A SU POTENTE FILTRO DE AIRE, ', '../Images/5555.jpg', '95.00', '0.00', 1, 8),
('6666', 'GHD HELIOS PROFESSIONAL HAIRDRYER BLANCO', 'REVOLUCIONA TU RUTINA DIARIA DE PEINADO CON LA úLTIMA INNOVACIóN DE GHD: EL SECADOR PROFESIONAL GHD HELIOS BLANCO. CONSIGUE UN 30% MáS DE BRILLO* A LA', '../Images/6666.jpg', '199.00', '20.00', 1, 8),
('7777', 'BABYLISS SECADOR 6709DE 2100W AC SMOOTH PRO', 'AIRE FRíO SI NIVELES DE TEMPERATURA 2 TECNOLOGíA IóNICA TIPO PROFESIONAL VELOCIDADES 2 DIFUSOR DE AIRE SI CONCENTRADOR DE AIRE SI POTENCIA (W) 2100 TI', '../Images/7777.jpg', '49.90', '25.00', 1, 2),
('8888', 'KéRASTASE CHAMPú BAIN VOLUMIFIQUE', 'CHAMPú CORPORIZANTE PARA CABELLO FINO QUE LAVA APORTANDO VOLUMEN Y LIGEREZA.', '../Images/3333.jpg', '17.99', '0.00', 0, 6),
('9999', 'CHAMPÚ KERASTASE CHRONOLOGISTE', 'CHRONOLOGISTE BAIN RéGéNéRANT DE KéRASTASE. CHAMPú REGENERANTE Y REJUVENECEDOR. ', '../Images/2222.jpg', '28.10', '32.00', 1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `codServicio` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `descuento` decimal(6,2) NOT NULL,
  `duracionServicio` decimal(6,2) NOT NULL,
  `codFamilia` int(11) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`codServicio`, `descripcion`, `precio`, `descuento`, `duracionServicio`, `codFamilia`, `activo`) VALUES
(1, 'Cejas', '3.00', '0.00', '15.00', 1, 1),
(2, 'Labio Superior', '3.00', '0.00', '15.00', 1, 1),
(3, 'Piernas', '18.00', '0.00', '30.00', 1, 1),
(4, 'Pecho', '12.00', '0.00', '30.00', 1, 1),
(5, 'Brazos', '12.00', '0.00', '30.00', 1, 1),
(6, 'Inglés', '10.00', '0.00', '15.00', 1, 1),
(7, 'Manicura', '15.00', '0.00', '30.00', 2, 1),
(8, 'Manicura Permanente', '18.00', '0.00', '60.00', 2, 1),
(9, 'Pedicura', '20.00', '0.00', '60.00', 2, 1),
(10, 'Higiene Facial', '30.00', '0.00', '60.00', 3, 1),
(11, 'Tratamiento Facial: Punta de Diamante', '40.00', '0.00', '60.00', 3, 1),
(12, 'Tratamiento Facial: Ácido glicólico', '40.00', '0.00', '60.00', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `codUsuario` int(11) NOT NULL,
  `dni` varchar(9) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `direccion` varchar(60) NOT NULL,
  `cp` varchar(5) NOT NULL,
  `poblacion` varchar(40) NOT NULL,
  `provincia` varchar(40) NOT NULL,
  `telefono` varchar(9) NOT NULL,
  `tipoUsuario` int(11) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`codUsuario`, `dni`, `clave`, `email`, `nombre`, `direccion`, `cp`, `poblacion`, `provincia`, `telefono`, `tipoUsuario`, `activo`) VALUES
(7, '', '$2y$10$r75xUhQXAb87PVenHOtlgOv31.QRKIs8AdYXm2hzss1FOnnp8yJ9u', 'mcarmen@gmail.com', 'Mª CARMEN RUFIAS LIMORTE', '', '', '', '', '663455023', 1, 1),
(1, '03759666V', '$2y$10$GlwDu7i/G5RoRhV7yVzfv.uP3bxBoAcHLLA5Py9AwEh1UVSJbgxPW', 'vicentevaquerog@gmail.com', 'VICENTE VAQUERO PEREZ', 'C/ ANTONIO MORA FERRANDEZ, Nº 36', '48001', 'MADRID', 'MADRID', '965420686', 1, 1),
(2, '11111111H', '$2y$10$TWNUt9Y6diIPubftohDoW.lpjxZCcMgE.nfozMOHHPpOzI4972wpu', 'anagarcia@gmail.com', 'ANA GARCIA BAUTISTA', 'C/ GREGORIO MARAñON, Nº 125', '', 'VALENCIA', 'VALENCIA', '996542068', 2, 1),
(3, '22222222J', '$2y$10$.Rn4TikFqGiBjXNmo88duufBjaVDyFzYp57L2UQ4pXWkfzU.IKhju', 'merchequesada@hotmail.com', 'MERCHE QUESADA IRLES', 'C/ ANTONIO MORA FERRANDEZ, Nº 36', '', 'ALBACETE', 'ALBACETE', '666789218', 3, 1),
(4, '33490565N', '$2y$10$BzvrVGBxIsJpcIERxcGk9OU9AkofjWwmt41kINQKyolrHfMcC6ZK6', 'svg26@msn.com', 'SERGIO VAQUERO GARCIA', 'C/ HILARION ESLAVA, Nº 70', '', 'ELCHE', 'ALICANTE', '676312536', 1, 1),
(5, '45568550F', '$2y$10$8DfgwlNNoX9Umcyo4MlSg.gAct35K.qrIc8dTPNlPnFG0EKH4kOX2', 'jorgealedo@hotmail.com', 'JORGE ALEDO TERRES         ', ' C/ BARCELONA, Nº 125', '', 'MADRID', 'MADRID', '657067289', 3, 1),
(6, '74126394Q', '$2y$10$t9sO6jpzZvRXVpjYoyzLb.wVqvwLGIHnmwkGS6SJvG.SpPxrpUpTi', 'borrar@gmail.com', 'HOLA', 'HOLA', '', 'HOLA', 'HOLA', '676312536', 3, 1);

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
  ADD PRIMARY KEY (`numLinea`,`codCita`);

--
-- Indices de la tabla `linpedidos`
--
ALTER TABLE `linpedidos`
  ADD PRIMARY KEY (`numLinea`,`numPedido`) USING BTREE;

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
  ADD PRIMARY KEY (`codServicio`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`dni`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

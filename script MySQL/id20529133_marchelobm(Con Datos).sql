-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-12-2023 a las 07:56:35
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id20529133_marchelobm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `idadministrador` double NOT NULL COMMENT 'TRIAL',
  `correo` varchar(25) NOT NULL COMMENT 'TRIAL',
  `celular` varchar(25) DEFAULT NULL COMMENT 'TRIAL',
  `area` varchar(25) NOT NULL COMMENT 'TRIAL',
  `activo` double DEFAULT NULL COMMENT 'TRIAL',
  `usuario_idusuario` double NOT NULL COMMENT 'TRIAL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='TRIAL';

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`idadministrador`, `correo`, `celular`, `area`, `activo`, `usuario_idusuario`) VALUES
(8, 'info@duoc.cl', '985655256', 'Jefe', 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agenda`
--

CREATE TABLE `agenda` (
  `idagenda` double NOT NULL COMMENT 'TRIAL',
  `fechahora` datetime NOT NULL COMMENT 'TRIAL',
  `descripcion` varchar(25) NOT NULL COMMENT 'TRIAL',
  `tecnico_idtecnico` double NOT NULL COMMENT 'TRIAL',
  `cliente_idcliente` double NOT NULL COMMENT 'TRIAL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='TRIAL';

--
-- Volcado de datos para la tabla `agenda`
--

INSERT INTO `agenda` (`idagenda`, `fechahora`, `descripcion`, `tecnico_idtecnico`, `cliente_idcliente`) VALUES
(27, '2023-06-16 00:22:36', 'Revision de HP', 9, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` double NOT NULL COMMENT 'TRIAL',
  `direccion` varchar(25) DEFAULT NULL COMMENT 'TRIAL',
  `celular` varchar(25) NOT NULL COMMENT 'TRIAL',
  `correo` varchar(25) NOT NULL COMMENT 'TRIAL',
  `usuario_idusuario` double NOT NULL COMMENT 'TRIAL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='TRIAL';

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `direccion`, `celular`, `correo`, `usuario_idusuario`) VALUES
(6, 'mexico #5856', '9996856', 'marchelo.1989@live.cl', 1),
(7, 'Paseo Nadia #261', '85474545', 'marchelo.1989@live.cl', 2),
(38, 'mexico #5856', '9996856', 'ma.burgosm@duocuc.cl', 37);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `idequipo` double NOT NULL COMMENT 'TRIAL',
  `marca` varchar(25) NOT NULL COMMENT 'TRIAL',
  `modelo` varchar(25) DEFAULT NULL COMMENT 'TRIAL',
  `numserie` varchar(25) NOT NULL COMMENT 'TRIAL',
  `estado` varchar(25) DEFAULT NULL COMMENT 'TRIAL',
  `usuario_idusuario` double DEFAULT NULL COMMENT 'TRIAL',
  `presupuesto_idpresupuesto` double DEFAULT NULL COMMENT 'TRIAL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='TRIAL';

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`idequipo`, `marca`, `modelo`, `numserie`, `estado`, `usuario_idusuario`, `presupuesto_idpresupuesto`) VALUES
(19, 'HP', 'Pavilion', '65461651d651', 'Sin Revision', 1, 11),
(20, 'Samsung', '365', 'fsdfsd4564dsf', 'Esperando', 1, 12),
(21, 'Dell', NULL, 'asdasdasfasf', 'Terminado', 1, 13),
(22, 'ASUS', NULL, 'asfasfasf', 'Esperando', 1, 14),
(23, 'HP', 'HP2117la', '734782g348273g4', 'Terminado', 1, 15),
(24, 'compag', 'h565', '8955sdgs6464s', 'Terminado', 2, 16),
(25, 'Toshiba', '865ads6', 'sdfsdf646sf', 'Esperando', 2, 17),
(26, 'Lenovo', NULL, 'fsdfsd4564dsf', 'Terminado', 2, 18),
(43, 'Apple', 'MacBook Air 13', 'dsfadsgarhan', 'Sin Revision', 37, 39),
(44, 'Asus', 'dad46', 'asdasdasd', 'Esperando', 37, 40),
(45, 'MSI', NULL, 'adadwasdsadasd', 'Terminado', 37, 41),
(46, 'Raxer', NULL, 'dsjofsdofij', 'Esperando', 37, 42);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuesto`
--

CREATE TABLE `presupuesto` (
  `idpresupuesto` double NOT NULL COMMENT 'TRIAL',
  `tiporeparacion` varchar(25) NOT NULL COMMENT 'TRIAL',
  `fechaingreso` datetime NOT NULL COMMENT 'TRIAL',
  `fechatermino` datetime DEFAULT NULL COMMENT 'TRIAL',
  `estado` varchar(25) NOT NULL COMMENT 'TRIAL',
  `descripcion` varchar(125) DEFAULT NULL COMMENT 'TRIAL',
  `valor` double NOT NULL COMMENT 'TRIAL',
  `repuesto_idrepuesto` double DEFAULT NULL COMMENT 'TRIAL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='TRIAL';

--
-- Volcado de datos para la tabla `presupuesto`
--

INSERT INTO `presupuesto` (`idpresupuesto`, `tiporeparacion`, `fechaingreso`, `fechatermino`, `estado`, `descripcion`, `valor`, `repuesto_idrepuesto`) VALUES
(11, 'Formateo', '2023-06-19 20:59:29', '2023-06-23 20:59:32', 'Pendiente', 'Reinstalacion del sistema', 30000, NULL),
(12, 'Limpieza', '2023-06-18 20:59:29', '2023-06-22 20:59:32', 'En Proceso', 'Cambio de pasta termica', 30000, 32),
(13, 'Instalacion', '2023-06-06 20:59:29', '2023-06-13 20:59:32', 'Rechazado', 'Instalacion de office 2021', 30000, 32),
(14, 'Reparacion', '2023-06-12 20:59:29', '2023-06-19 20:59:32', 'En Proceso', 'Cambio de pantalla', 30000, 33),
(15, 'Formateo', '2023-06-05 20:59:29', '2023-06-12 20:59:32', 'Rechazado', 'Cambio del sistema operativo de windows 8 a windows 10', 30000, NULL),
(16, 'Limpieza', '2023-06-06 20:59:29', '2023-06-13 20:59:32', 'Rechazado', 'Cambio de pasta termica', 30000, 34),
(17, 'Instalacion', '2023-06-12 20:59:29', '2023-06-19 20:59:32', 'En Proceso', 'Instalacion de programas actualizados', 30000, NULL),
(18, 'Reparacion', '2023-06-05 20:59:29', '2023-06-12 20:59:32', 'Rechazado', 'Cambio del disco', 30000, 34),
(39, 'Formateo', '2023-06-19 20:59:29', '2023-06-23 20:59:32', 'Pendiente', 'Reinstalacion del sistema', 30000, NULL),
(40, 'Limpieza', '2023-06-18 20:59:29', '2023-06-22 20:59:32', 'En Proceso', 'Cambio de pasta termica', 30000, NULL),
(41, 'Instalacion', '2023-06-06 20:59:29', '2023-06-13 20:59:32', 'Rechazado', 'Instalacion de office 2021', 30000, NULL),
(42, 'Reparacion', '2023-06-12 20:59:29', '2023-06-19 20:59:32', 'En Proceso', 'Cambio de pantalla', 30000, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repuesto`
--

CREATE TABLE `repuesto` (
  `idrepuesto` double NOT NULL COMMENT 'TRIAL',
  `nombre` varchar(25) NOT NULL COMMENT 'TRIAL',
  `descripcion` varchar(125) DEFAULT NULL COMMENT 'TRIAL',
  `precio` double NOT NULL COMMENT 'TRIAL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='TRIAL';

--
-- Volcado de datos para la tabla `repuesto`
--

INSERT INTO `repuesto` (`idrepuesto`, `nombre`, `descripcion`, `precio`) VALUES
(32, 'Mantencion', 'Pasta termica Z5 - 3g', 9000),
(33, 'Actualizacion', 'Office 2021', 60000),
(34, 'Terminado', 'Pantalla Para Asus', 3000),
(35, 'Mantencion', 'Pasta termica Z10 - 5g', 14000),
(36, 'Mejora', 'SSD de 512', 50000),
(47, 'Mantencion', 'Pasta termica Z3 - 3g', 9000),
(48, 'Actualizacion', 'Office 2020', 40000),
(49, 'Terminado', 'Pantalla Para Asus', 3000),
(50, 'Mantencion', 'Pasta termica Z9 - 5g', 14000),
(51, 'Mejora', 'SSD de 512', 50000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnico`
--

CREATE TABLE `tecnico` (
  `idtecnico` double NOT NULL COMMENT 'TRIAL',
  `correo` varchar(25) NOT NULL COMMENT 'TRIAL',
  `celular` varchar(25) DEFAULT NULL COMMENT 'TRIAL',
  `especialidad` varchar(25) NOT NULL COMMENT 'TRIAL',
  `experiencia` decimal(11,0) NOT NULL COMMENT 'TRIAL',
  `activo` double DEFAULT NULL COMMENT 'TRIAL',
  `usuario_idusuario` double NOT NULL COMMENT 'TRIAL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='TRIAL';

--
-- Volcado de datos para la tabla `tecnico`
--

INSERT INTO `tecnico` (`idtecnico`, `correo`, `celular`, `especialidad`, `experiencia`, `activo`, `usuario_idusuario`) VALUES
(9, 'Karen@duoc.cl', '907554685', 'tecnico Sofware', 5, 1, 3),
(10, 'Laura@duoc.cl', '645796546', 'tecnico Hardware', 3, 1, 4),
(30, 'Leopoldoc@duoc.cl', '86595563', 'tecnico Sofware', 6, 0, 28),
(31, 'Noelia@duoc.cl', '85647756', 'tecnico Hardware', 2, 0, 29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` double NOT NULL COMMENT 'TRIAL',
  `rut` varchar(25) NOT NULL COMMENT 'TRIAL',
  `pass` varchar(20) NOT NULL COMMENT 'TRIAL',
  `nombre` varchar(25) NOT NULL COMMENT 'TRIAL',
  `apellido` varchar(25) NOT NULL COMMENT 'TRIAL',
  `tipousuario` varchar(25) NOT NULL COMMENT 'TRIAL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='TRIAL';

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `rut`, `pass`, `nombre`, `apellido`, `tipousuario`) VALUES
(1, '17.008.864-6', 'pass1', 'Marchelo', 'Burgos', 'Cliente'),
(2, '11.017.269-9', 'pass1', 'Juan', 'Pérez', 'Cliente'),
(3, '23.069.645-4', 'pass2', 'Karen', 'Ramirez', 'Técnico'),
(4, '14.671.476-5', 'pass2', 'Laura', 'Torres', 'Técnico'),
(5, '11.111.111-1', 'pass3', 'Carlos', 'Gómez', 'Administrador'),
(28, '22.832.064-1', 'pass2', 'Fabio', 'Leopoldo', 'Técnico'),
(29, '15.716.631-k', 'pass2', 'Noelia', 'Alarcon', 'Técnico'),
(37, '23.136.465-k', 'pass1', 'Eduardo', 'Sales', 'Cliente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`idadministrador`),
  ADD KEY `administrador_usuario_fk` (`usuario_idusuario`);

--
-- Indices de la tabla `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`idagenda`),
  ADD KEY `agenda_cliente_fk` (`cliente_idcliente`),
  ADD KEY `agenda_tecnico_fk` (`tecnico_idtecnico`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`),
  ADD KEY `cliente_usuario_fk` (`usuario_idusuario`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`idequipo`),
  ADD KEY `equipo_presupuesto_fk` (`presupuesto_idpresupuesto`),
  ADD KEY `equipo_usuario_fk` (`usuario_idusuario`);

--
-- Indices de la tabla `presupuesto`
--
ALTER TABLE `presupuesto`
  ADD PRIMARY KEY (`idpresupuesto`),
  ADD KEY `presupuesto_repuesto_fk` (`repuesto_idrepuesto`);

--
-- Indices de la tabla `repuesto`
--
ALTER TABLE `repuesto`
  ADD PRIMARY KEY (`idrepuesto`);

--
-- Indices de la tabla `tecnico`
--
ALTER TABLE `tecnico`
  ADD PRIMARY KEY (`idtecnico`),
  ADD KEY `tecnico_usuario_fk` (`usuario_idusuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `administrador_usuario_fk` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION;

--
-- Filtros para la tabla `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `agenda_cliente_fk` FOREIGN KEY (`cliente_idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE NO ACTION,
  ADD CONSTRAINT `agenda_tecnico_fk` FOREIGN KEY (`tecnico_idtecnico`) REFERENCES `tecnico` (`idtecnico`) ON DELETE NO ACTION;

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_usuario_fk` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION;

--
-- Filtros para la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD CONSTRAINT `equipo_presupuesto_fk` FOREIGN KEY (`presupuesto_idpresupuesto`) REFERENCES `presupuesto` (`idpresupuesto`) ON DELETE NO ACTION,
  ADD CONSTRAINT `equipo_usuario_fk` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION;

--
-- Filtros para la tabla `presupuesto`
--
ALTER TABLE `presupuesto`
  ADD CONSTRAINT `presupuesto_repuesto_fk` FOREIGN KEY (`repuesto_idrepuesto`) REFERENCES `repuesto` (`idrepuesto`) ON DELETE NO ACTION;

--
-- Filtros para la tabla `tecnico`
--
ALTER TABLE `tecnico`
  ADD CONSTRAINT `tecnico_usuario_fk` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

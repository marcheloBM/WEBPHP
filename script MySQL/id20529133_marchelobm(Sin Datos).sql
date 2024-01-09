-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-12-2023 a las 07:25:17
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

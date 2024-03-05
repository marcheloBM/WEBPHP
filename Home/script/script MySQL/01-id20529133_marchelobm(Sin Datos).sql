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

DROP TABLE `administrador`, `agenda`, `cliente`, `equipo`, `presupuesto`, `repuesto`, `tecnico`, `usuario`;
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
  `idadministrador` int(11) NOT NULL COMMENT 'ID de cada administrador registrado',
  `correo` varchar(25) NOT NULL COMMENT 'Correo electrónico de cada administrador',
  `celular` varchar(25) DEFAULT NULL COMMENT 'Celular del administrador',
  `area` varchar(25) NOT NULL COMMENT 'Área donde trabaja el administrador',
  `activo` int(11) DEFAULT NULL COMMENT 'Si es administrador se encuentra activos para el uso del sistema',
  `usuario_idusuario` int(11) NOT NULL COMMENT 'ID de usuario asignado '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Datos de los administradores del sistema';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agenda`
--

CREATE TABLE `agenda` (
  `idagenda` int(11) NOT NULL COMMENT 'Identificador de la tabla agenda',
  `fechahora` datetime NOT NULL COMMENT 'Fecha y hora para agendar con el técnico',
  `descripcion` varchar(25) NOT NULL COMMENT 'Pequeña descripción sobre los resultados de la hora toma',
  `tecnico_idtecnico` int(11) NOT NULL COMMENT 'Identificador del trabajador registrado',
  `cliente_idcliente` int(11) NOT NULL COMMENT 'Identificador de cada cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Todas las horas registradas';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL COMMENT 'Identificador de cada cliente',
  `direccion` varchar(25) DEFAULT NULL COMMENT 'Dirección de cada cliente',
  `celular` varchar(25) NOT NULL COMMENT 'Celular personal de cada cliente',
  `correo` varchar(25) NOT NULL COMMENT 'Correo personal de cada cliente',
  `usuario_idusuario` int(11) NOT NULL COMMENT 'Identificador de la tabla usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Todos los cliente registrados';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `idequipo` int(11) NOT NULL COMMENT 'Identificardor de cada equipo registrado',
  `marca` varchar(25) NOT NULL COMMENT 'Marca del computador',
  `modelo` varchar(25) DEFAULT NULL COMMENT 'Modelo del computador',
  `numserie` varchar(225) NOT NULL COMMENT 'Numero de serie de cada computador',
  `estado` varchar(225) DEFAULT NULL COMMENT 'Estado del proceso del Equipo en el sistema (Sin Revision- Esperando-En Reparacion- Terminado)',
  `usuario_idusuario` int(11) DEFAULT NULL COMMENT 'Identificador de la tabla usuario',
  `presupuesto_idpresupuesto` int(11) DEFAULT NULL COMMENT 'Identificador de la tabla presupuesto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla que almacena información sobre los equipos de cada cliente';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuesto`
--

CREATE TABLE `presupuesto` (
  `idpresupuesto` int(11) NOT NULL COMMENT 'Identificador único de cada presupuesto',
  `tiporeparacion` varchar(25) NOT NULL COMMENT 'Tipo de reparación efectuada al equipo (Formateo- Limpieza- Instalacion- Reparacion)',
  `fechaingreso` datetime NOT NULL COMMENT 'Fecha de ingreso del presupuesto',
  `fechatermino` datetime DEFAULT NULL COMMENT 'Fecha de termino del presupuesto',
  `estado` varchar(25) NOT NULL COMMENT 'Estado del presupuesto (Aprobado- Rechazado- En Proceso- Pendiente)',
  `descripcion` varchar(125) DEFAULT NULL COMMENT 'Descripción del presupuesto',
  `valor` int(11) NOT NULL COMMENT 'Valor asignado para el presupuesto',
  `repuesto_idrepuesto` int(11) DEFAULT NULL COMMENT 'Identificador único de cada repuesto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla que almacena información sobre los presupuestos de reparación de equipos';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repuesto`
--

CREATE TABLE `repuesto` (
  `idrepuesto` int(11) NOT NULL COMMENT 'Identificador único de cada repuesto',
  `nombre` varchar(25) NOT NULL COMMENT 'Nombre asignado para los repuestos',
  `descripcion` varchar(125) DEFAULT NULL COMMENT 'Descripción de cada repuesto solicitado',
  `precio` int(11) NOT NULL COMMENT 'precio asignado para los repuestos'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Repuesto para cada reparación de un equipo';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnico`
--

CREATE TABLE `tecnico` (
  `idtecnico` int(11) NOT NULL COMMENT 'Identificador del trabajador registrado',
  `correo` varchar(25) NOT NULL COMMENT 'Correo del técnico',
  `celular` varchar(25) DEFAULT NULL COMMENT 'Celular del técnico',
  `especialidad` varchar(25) NOT NULL COMMENT 'Especialidad o profesión',
  `experiencia` int(11) NOT NULL COMMENT 'Experiencia laboral',
  `activo` int(11) DEFAULT NULL COMMENT 'Si el técnico se encuentra activo para usar el sistema',
  `usuario_idusuario` int(11) NOT NULL COMMENT 'Identificador para la tabla usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Registro de todos lo trabajadores que trabajan en la empresa';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL COMMENT 'Identificador de la tabla usuario',
  `rut` varchar(25) NOT NULL COMMENT 'El rut de cada usuario registrado',
  `pass` varchar(225) NOT NULL COMMENT 'La contraseña para usar el sistema',
  `nombre` varchar(25) NOT NULL COMMENT 'Nombre de cada persona',
  `apellido` varchar(25) NOT NULL COMMENT 'Apellido de cada persona',
  `tipousuario` varchar(25) NOT NULL COMMENT 'El tipo de usuario en el sistema (clientes-técnico-administrador)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Registro de todos los clientes, técnico y administrador';

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `idadministrador` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID de cada administrador registrado';

--
-- AUTO_INCREMENT de la tabla `agenda`
--
ALTER TABLE `agenda`
  MODIFY `idagenda` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la tabla agenda';

--
-- AUTO_INCREMENT de la tabla `cliente` 
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de cada cliente';
  
--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `idequipo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificardor de cada equipo registrado';

--
-- AUTO_INCREMENT de la tabla `presupuesto`
--
ALTER TABLE `presupuesto`
  MODIFY `idpresupuesto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de cada presupuesto';

--
-- AUTO_INCREMENT de la tabla `repuesto`
--
ALTER TABLE `repuesto`
  MODIFY `idrepuesto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de cada repuesto';
  
--
-- AUTO_INCREMENT de la tabla `tecnico`
--
ALTER TABLE `tecnico`
  MODIFY `idtecnico` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del trabajador registrado';
  
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la tabla usuario';


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

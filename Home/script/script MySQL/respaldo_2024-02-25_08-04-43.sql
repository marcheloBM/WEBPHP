
INSERT INTO usuario (`idusuario`, `rut`, `pass`, `nombre`, `apellido`, `tipousuario`) VALUES 
('1', '17.008.864-6', 'f0578f1e7174b1a41c4ea8c6e17f7a8a3b88c92a', 'Marchelo', 'Burgos', 'Cliente'),
('2', '22.222.222-2', '8be52126a6fde450a7162a3651d589bb51e9579d', 'Marcelo', 'Burgos', 'Técnico'),
('3', '33.333.333-3', '8be52126a6fde450a7162a3651d589bb51e9579d', 'Maxi', 'Castro', 'Técnico'),
('4', '11.111.111-1', 'de2a4d5751ab06dc4f987142db57c26d50925c8a', 'Admin', 'Admin', 'Administrador'),
('5', '19.521.907-9', '7a405f8ee16625612869d2240f5d04fd61db4703', 'Barbara', 'Azocar', 'Cliente'),
('6', '18.242.450-1', '7a405f8ee16625612869d2240f5d04fd61db4703', 'Nicol', 'Peñafiel', 'Cliente'),
('7', '16.472.302-K', '7a405f8ee16625612869d2240f5d04fd61db4703', 'Rommy', 'Peñafiel', 'Cliente'),
('8', '21.185.681-5', '7a405f8ee16625612869d2240f5d04fd61db4703', 'Tihare', 'Villablanca ', 'Cliente'),
('9', '18.357.048-K', '7a405f8ee16625612869d2240f5d04fd61db4703', 'Camilo', 'Diaz', 'Cliente');
CREATE TABLE `administrador` (
  `idadministrador` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID de cada administrador registrado',
  `correo` varchar(25) NOT NULL COMMENT 'Correo electrónico de cada administrador',
  `celular` varchar(25) DEFAULT NULL COMMENT 'Celular del administrador',
  `area` varchar(25) NOT NULL COMMENT 'Área donde trabaja el administrador',
  `activo` int(11) DEFAULT NULL COMMENT 'Si es administrador se encuentra activos para el uso del sistema',
  `usuario_idusuario` int(11) NOT NULL COMMENT 'ID de usuario asignado ',
  PRIMARY KEY (`idadministrador`),
  KEY `administrador_usuario_fk` (`usuario_idusuario`),
  CONSTRAINT `administrador_usuario_fk` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Datos de los administradores del sistema';
INSERT INTO administrador VALUES ('1', 'info@duoc.cl', '985655256', 'Jefe', '1', '3');
CREATE TABLE `tecnico` (
  `idtecnico` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador del trabajador registrado',
  `correo` varchar(25) NOT NULL COMMENT 'Correo del técnico',
  `celular` varchar(25) DEFAULT NULL COMMENT 'Celular del técnico',
  `especialidad` varchar(25) NOT NULL COMMENT 'Especialidad o profesión',
  `experiencia` int(11) NOT NULL COMMENT 'Experiencia laboral',
  `activo` int(11) DEFAULT NULL COMMENT 'Si el técnico se encuentra activo para usar el sistema',
  `usuario_idusuario` int(11) NOT NULL COMMENT 'Identificador para la tabla usuario',
  PRIMARY KEY (`idtecnico`),
  KEY `tecnico_usuario_fk` (`usuario_idusuario`),
  CONSTRAINT `tecnico_usuario_fk` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Registro de todos lo trabajadores que trabajan en la empresa';
INSERT INTO tecnico VALUES ('1', 'info@duoc.cl', '990715586', 'tecnico Sofware', '8', '1', '2');
INSERT INTO tecnico VALUES ('2', 'info@duoc.cl', '999988777', 'tecnico RED', '4', '0', '3');
CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de cada cliente',
  `direccion` varchar(25) DEFAULT NULL COMMENT 'Dirección de cada cliente',
  `celular` varchar(25) NOT NULL COMMENT 'Celular personal de cada cliente',
  `correo` varchar(25) NOT NULL COMMENT 'Correo personal de cada cliente',
  `usuario_idusuario` int(11) NOT NULL COMMENT 'Identificador de la tabla usuario',
  PRIMARY KEY (`idcliente`),
  KEY `cliente_usuario_fk` (`usuario_idusuario`),
  CONSTRAINT `cliente_usuario_fk` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Todos los cliente registrados';
INSERT INTO cliente VALUES ('1', 'El Fardo #3848', '990715586', 'marchelo.1989@live.cl', '1');
INSERT INTO cliente VALUES ('2', 'Calle #xxxx', '995478579', 'barbara.azocar1996@gmail.', '5');
INSERT INTO cliente VALUES ('3', 'El Fardo #3857', '956192053', 'prueba@prueba.cl', '6');
INSERT INTO cliente VALUES ('4', 'El Fardo #3857', '999112305', 'garfield366@gmail.com', '7');
INSERT INTO cliente VALUES ('5', 'El Fardo #3857', '966944892', 'prueba@prueba.cl', '8');
INSERT INTO cliente VALUES ('6', 'Calle #xxxx', '979482992', 'prueba@prueba.cl', '9');
CREATE TABLE `agenda` (
  `idagenda` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la tabla agenda',
  `fechahora` datetime NOT NULL COMMENT 'Fecha y hora para agendar con el técnico',
  `descripcion` varchar(25) NOT NULL COMMENT 'Pequeña descripción sobre los resultados de la hora toma',
  `tecnico_idtecnico` int(11) NOT NULL COMMENT 'Identificador del trabajador registrado',
  `cliente_idcliente` int(11) NOT NULL COMMENT 'Identificador de cada cliente',
  PRIMARY KEY (`idagenda`),
  KEY `agenda_cliente_fk` (`cliente_idcliente`),
  KEY `agenda_tecnico_fk` (`tecnico_idtecnico`),
  CONSTRAINT `agenda_cliente_fk` FOREIGN KEY (`cliente_idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE NO ACTION,
  CONSTRAINT `agenda_tecnico_fk` FOREIGN KEY (`tecnico_idtecnico`) REFERENCES `tecnico` (`idtecnico`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Todas las horas registradas';
INSERT INTO agenda VALUES ('1', '2024-02-24 05:46:00', 'bjvjhv', '1', '1');
CREATE TABLE `repuesto` (
  `idrepuesto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de cada repuesto',
  `nombre` varchar(25) NOT NULL COMMENT 'Nombre asignado para los repuestos',
  `descripcion` varchar(125) DEFAULT NULL COMMENT 'Descripción de cada repuesto solicitado',
  `precio` int(11) NOT NULL COMMENT 'precio asignado para los repuestos',
  PRIMARY KEY (`idrepuesto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Repuesto para cada reparación de un equipo';
INSERT INTO repuesto VALUES ('1', 'Disco', 'SSD 250', '0');
CREATE TABLE `presupuesto` (
  `idpresupuesto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único de cada presupuesto',
  `tiporeparacion` varchar(25) NOT NULL COMMENT 'Tipo de reparación efectuada al equipo (Formateo- Limpieza- Instalacion- Reparacion)',
  `fechaingreso` datetime NOT NULL COMMENT 'Fecha de ingreso del presupuesto',
  `fechatermino` datetime DEFAULT NULL COMMENT 'Fecha de termino del presupuesto',
  `estado` varchar(25) NOT NULL COMMENT 'Estado del presupuesto (Aprobado- Rechazado- En Proceso- Pendiente)',
  `descripcion` varchar(125) DEFAULT NULL COMMENT 'Descripción del presupuesto',
  `valor` int(11) NOT NULL COMMENT 'Valor asignado para el presupuesto',
  `repuesto_idrepuesto` int(11) DEFAULT NULL COMMENT 'Identificador único de cada repuesto',
  PRIMARY KEY (`idpresupuesto`),
  KEY `presupuesto_repuesto_fk` (`repuesto_idrepuesto`),
  CONSTRAINT `presupuesto_repuesto_fk` FOREIGN KEY (`repuesto_idrepuesto`) REFERENCES `repuesto` (`idrepuesto`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla que almacena información sobre los presupuestos de reparación de equipos';
INSERT INTO presupuesto VALUES ('1', 'Formateo', '2024-02-20 08:04:38', '2018-12-29 13:00:00', 'Terminado', 'Reinstalacion del sistema operativo de windows 10', '0', '');
INSERT INTO presupuesto VALUES ('2', 'Formateo', '2024-02-20 08:06:18', '2018-12-28 15:30:00', 'Terminado', 'Reinstalacion del sistema operativo de windows 10
', '0', '');
INSERT INTO presupuesto VALUES ('3', 'Formateo', '2024-02-20 08:10:35', '2019-05-27 16:00:00', 'Terminado', 'instalacion del sistema operativo de nuevo', '0', '');
INSERT INTO presupuesto VALUES ('4', 'Formateo', '2024-02-20 08:12:01', '2019-12-23 16:00:00', 'Terminado', 'actualizacion del sistema operativo windows 10', '0', '');
INSERT INTO presupuesto VALUES ('5', 'Formateo', '2024-02-20 08:13:43', '2017-10-11 17:00:00', 'Terminado', 'instalacion del sistema windows 7', '0', '');
INSERT INTO presupuesto VALUES ('6', 'Formateo', '2024-02-20 08:15:08', '2019-08-20 11:00:00', 'Terminado', 'instalacion del sistema operativo', '0', '');
INSERT INTO presupuesto VALUES ('7', 'Instalacion', '2024-02-20 08:17:21', '2020-02-03 15:30:00', 'Terminado', 'instalacion de las actualizaciones del sistema operativo 
test de velicidad,temperatura y rendimiento del pc', '0', '');
INSERT INTO presupuesto VALUES ('8', 'Reparacion', '2024-02-20 08:19:26', '2020-02-05 16:30:00', 'Terminado', 'cambio del sistema de windows 7 a windows 10, instalacion del procesador antiguo y cambio de pasta permica', '0', '');
INSERT INTO presupuesto VALUES ('9', 'Formateo', '2024-02-20 08:22:47', '2020-03-16 14:30:00', 'Terminado', 'reinstalacion del sistema de windows 10', '0', '');
INSERT INTO presupuesto VALUES ('10', 'Formateo', '2024-02-20 08:24:09', '2020-03-10 12:30:00', 'Terminado', 'reinstalacion del sistema de windows 10
', '0', '');
INSERT INTO presupuesto VALUES ('11', 'Formateo', '2024-02-20 08:25:15', '2020-07-21 14:45:00', 'Terminado', 'Reinstalacion del sistema operativo', '0', '');
INSERT INTO presupuesto VALUES ('12', 'Formateo', '2024-02-20 08:26:33', '2020-09-01 16:30:00', 'Terminado', 'reinstalacion del sistema operativo', '0', '');
INSERT INTO presupuesto VALUES ('13', 'Formateo', '2024-02-20 08:27:45', '2021-08-09 11:00:00', 'Terminado', 'restalacion del sistema operativo y cambio de ram', '0', '');
INSERT INTO presupuesto VALUES ('14', 'Formateo', '2024-02-24 08:37:54', '2019-03-25 04:37:00', 'Terminado', 'cambio de HDD y reinstalacion de windows 10', '0', '');
INSERT INTO presupuesto VALUES ('15', 'Formateo', '2024-02-24 08:40:10', '2020-09-04 13:40:00', 'Terminado', 'cambio de disco por una SSD
', '15000', '1');
INSERT INTO presupuesto VALUES ('16', 'Formateo', '2024-02-24 08:45:28', '2019-03-27 16:00:00', 'Terminado', 'reinstalacion del sistema de windows 10
', '15000', '');
INSERT INTO presupuesto VALUES ('17', 'Formateo', '2024-02-24 08:46:24', '2021-03-15 14:30:00', 'Terminado', 'reinstalacion del sistema operativo windows 10
', '15000', '');
INSERT INTO presupuesto VALUES ('18', 'Formateo', '2024-02-24 08:49:13', '2016-12-08 13:50:00', 'Terminado', 'Instalacion del sistema de windows 7
', '0', '');
INSERT INTO presupuesto VALUES ('19', 'Formateo', '2024-02-24 08:51:57', '2020-01-20 20:30:00', 'Terminado', 'reinstalacion del sistema de windows 10
', '0', '');
INSERT INTO presupuesto VALUES ('20', 'Instalacion', '2024-02-24 08:54:23', '2020-06-08 13:30:00', 'Terminado', 'Instalacion de programas
', '0', '');
INSERT INTO presupuesto VALUES ('21', 'Formateo', '2024-02-24 08:55:48', '2020-10-23 16:00:00', 'Terminado', 'cambio del ventilador y reintalacion del sistema de windows 10
', '15000', '');
CREATE TABLE `equipo` (
  `idequipo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificardor de cada equipo registrado',
  `marca` varchar(25) NOT NULL COMMENT 'Marca del computador',
  `modelo` varchar(25) DEFAULT NULL COMMENT 'Modelo del computador',
  `numserie` varchar(225) NOT NULL COMMENT 'Numero de serie de cada computador',
  `estado` varchar(225) DEFAULT NULL COMMENT 'Estado del proceso del Equipo en el sistema (Sin Revision- Esperando-En Reparacion- Terminado)',
  `usuario_idusuario` int(11) DEFAULT NULL COMMENT 'Identificador de la tabla usuario',
  `presupuesto_idpresupuesto` int(11) DEFAULT NULL COMMENT 'Identificador de la tabla presupuesto',
  PRIMARY KEY (`idequipo`),
  KEY `equipo_presupuesto_fk` (`presupuesto_idpresupuesto`),
  KEY `equipo_usuario_fk` (`usuario_idusuario`),
  CONSTRAINT `equipo_presupuesto_fk` FOREIGN KEY (`presupuesto_idpresupuesto`) REFERENCES `presupuesto` (`idpresupuesto`) ON DELETE NO ACTION,
  CONSTRAINT `equipo_usuario_fk` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabla que almacena información sobre los equipos de cada cliente';
INSERT INTO equipo VALUES ('1', 'AMD-PC', 'MS-7640', '00000000-0000-0000-0000-D43D7ED820B5', 'Terminado', '1', '1');
INSERT INTO equipo VALUES ('2', 'TOSHIBA', 'Satellite L45-A', '5D019380K', 'Terminado', '1', '2');
INSERT INTO equipo VALUES ('3', 'TOSHIBA', 'Satellite L45-A', '5D019380K', 'Terminado', '1', '3');
INSERT INTO equipo VALUES ('4', 'TOSHIBA', 'Satellite L45-A', '5D019380K', 'Terminado', '1', '4');
INSERT INTO equipo VALUES ('5', 'COMPAQ', 'COMPAQ 610', 'VF483LA#ABM', 'Terminado', '1', '5');
INSERT INTO equipo VALUES ('6', 'SAMSUNG', '300E4A/300E5A/300E7A/3430', 'HPYJ91HC100108', 'Terminado', '1', '6');
INSERT INTO equipo VALUES ('7', 'SAMSUNG', '300E4A/300E5A/300E7A/3430', 'HPYJ91HC100108', 'Terminado', '1', '7');
INSERT INTO equipo VALUES ('8', 'SAMSUNG', '300E4A/300E5A/300E7A/3430', 'HPYJ91HC100108', 'Terminado', '1', '8');
INSERT INTO equipo VALUES ('9', 'AMD', 'MS-7640', '00000000-0000-0000-0000-D43D7ED820B5', 'Terminado', '1', '9');
INSERT INTO equipo VALUES ('10', 'TOSHIBA', 'Satellite L45-A', '5D019380K', 'Terminado', '1', '10');
INSERT INTO equipo VALUES ('11', 'Toshiba', 'Satellite L45-A', '5D019380K', 'Terminado', '1', '11');
INSERT INTO equipo VALUES ('12', 'AMD-FX', 'MS-7640', '00000000-0000-0000-0000-D43D7ED820B5', 'Terminado', '1', '12');
INSERT INTO equipo VALUES ('13', 'AMD-FX', 'MS-7640', '00000000-0000-0000-0000-D43D7ED820B5', 'Terminado', '1', '13');
INSERT INTO equipo VALUES ('14', 'ACER', 'Aspire ES1-311', 'NXG67AL00152504D926600', 'Terminado', '5', '14');
INSERT INTO equipo VALUES ('15', 'HP', 'HP Notebook', '5CG6263LDN', 'Terminado', '5', '15');
INSERT INTO equipo VALUES ('16', 'DELL', 'Inspiron 3421', 'CXYX1Z1', 'Terminado', '6', '16');
INSERT INTO equipo VALUES ('17', 'Lenovo', '81D1', 'PF15PANU', 'Terminado', '6', '17');
INSERT INTO equipo VALUES ('18', 'TOSHIBA', 'Satellite L305', '29216579Q', 'Terminado', '7', '18');
INSERT INTO equipo VALUES ('19', 'NotebookHP', 'HP ProBook 440 G3', '5CD6072F81', 'Terminado', '8', '19');
INSERT INTO equipo VALUES ('20', 'Intel', 'H310M H 2.0', '', 'Terminado', '9', '20');
INSERT INTO equipo VALUES ('21', 'MSI', 'CX62 6QD', '9S716J622050ZG4000076', 'Terminado', '9', '21');

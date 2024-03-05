--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `rut`, `pass`, `nombre`, `apellido`, `tipousuario`) VALUES
(1, '17.008.864-6', 'f0578f1e7174b1a41c4ea8c6e17f7a8a3b88c92a', 'Marchelo', 'Burgos', 'Cliente'),
(2, '23.069.645-4', '8be52126a6fde450a7162a3651d589bb51e9579d', 'Marcelo', 'Burgos', 'Técnico'),
(3, '11.111.111-1', 'de2a4d5751ab06dc4f987142db57c26d50925c8a', 'Admin', 'Admin', 'Administrador'),
(4,'16.472.302-K', 'f0578f1e7174b1a41c4ea8c6e17f7a8a3b88c92a', 'Rommy', 'Peñafiel', 'Cliente'),
(5,'18.538.234-6', 'cae521f40662bfce3d35823aae3624242268689b', 'Maximiliano ', 'Castro', 'Cliente'),
(6,'21.185.681-5', '8cb2237d0679ca88db6464eac60da96345513964', 'Tihare', 'Villablanca', 'Cliente'),
(7,'22.222.222-2', '8be52126a6fde450a7162a3651d589bb51e9579d', 'Juan', 'Bustos', 'Técnico');

INSERT INTO `administrador` (`idadministrador`, `correo`, `celular`, `area`, `activo`, `usuario_idusuario`) VALUES
(1, 'info@duoc.cl', '985655256', 'Jefe', 1, 3);

--
-- Volcado de datos para la tabla `tecnico`
--

INSERT INTO `tecnico` (`idtecnico`, `correo`, `celular`, `especialidad`, `experiencia`, `activo`, `usuario_idusuario`) VALUES
(1, 'info@duoc.cl', '990715586', 'tecnico Sofware', 8, 1, 2),
(2, 'info@duoc.cl', '999999999', 'tecnico Hardware', 5, 1, 7);

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `direccion`, `celular`, `correo`, `usuario_idusuario`) VALUES
(1, 'El Fardo #3848', '990715586', 'marchelo.1989@live.cl', 1),
(2, 'El Fardo #3857', '999112305', 'rommy_andrea@hotmail.com', 4),
(3, 'Calle #xxxx', '997323995', 'correo@prueba.com', 5),
(4, 'El Fardo #3857', '966944892', 'correo@prueba.com', 6);

--
-- Volcado de datos para la tabla `agenda`
--
INSERT INTO agenda (fechahora, descripcion, tecnico_idtecnico, cliente_idcliente) VALUES ('2023-06-16 00:22:36', 'Revision de HP', '1', '1');

--
-- Volcado de datos para la tabla `repuesto`
--
INSERT INTO repuesto (nombre,descripcion,precio) VALUES 
('Mantencion','Pasta termica Z5 - 3g',9000),
('Actualizacion','Office 2021',60000),
('Terminado','Pantalla Para Asus',3000),
('Mantencion','Pasta termica Z10 - 5g',14000),
('Mejora','SSD de 512',50000),
('Mantencion','Pasta termica Z5 - 3g',9000),
('Actualizacion','Office 2021',60000),
('Terminado','Pantalla Para Asus',3000),
('Mantencion','Pasta termica Z10 - 5g',14000),
('Mejora','SSD de 512',50000);

--
-- Volcado de datos para la tabla `presupuesto`
-- Tipo de reparación efectuada al equipo (Formateo- Limpieza- Instalacion- Reparacion)
-- Estado del presupuesto (Aprobado- Rechazado- En Proceso- Pendiente)
--

INSERT INTO `presupuesto` (`idpresupuesto`, `tiporeparacion`, `fechaingreso`, `fechatermino`, `estado`, `descripcion`, `valor`, `repuesto_idrepuesto`) VALUES
(1, 'Formateo', '2018-06-19 14:44:35', '2018-06-21 16:59:32', 'Rechazado', 'Reinstalacion del sistema', 30000, 1),
(2, 'Formateo', '2018-12-28 16:40:06', '2018-12-29 10:00:32', 'Aprobado', 'Reinstalacion del sistema', 30000, 2),
(3, 'Formateo', '2017-10-11 14:26:55', '2017-10-12 14:30:00', 'En Proceso', 'Instalacion del sistema windows 7', 20000, 3),
(4, 'Formateo', '2019-08-20 17:30:06', '2019-08-21 10:00:32', 'Pendiente', 'Reinstalacion del sistema', 20000, 4),
(5, 'Formateo', '2018-06-19 14:44:35', '2018-06-21 16:59:32', 'Rechazado', 'Reinstalacion del sistema', 30000, 5),
(6, 'Formateo', '2018-12-28 16:40:06', '2018-12-29 10:00:32', 'Aprobado', 'Reinstalacion del sistema', 30000, 6),
(7, 'Formateo', '2017-10-11 14:26:55', '2017-10-12 14:30:00', 'En Proceso', 'Instalacion del sistema windows 7', 20000, 7),
(8, 'Formateo', '2019-08-20 17:30:06', '2019-08-21 10:00:32', 'Pendiente', 'Reinstalacion del sistema', 20000, 8);

--
-- Volcado de datos para la tabla `equipo`
-- Estado del proceso del Equipo en el sistema (Sin Revision- Esperando-En Reparacion- Terminado)
--

INSERT INTO `equipo` (`idequipo`, `marca`, `modelo`, `numserie`, `estado`, `usuario_idusuario`, `presupuesto_idpresupuesto`) VALUES
(1, 'AMD-PC', 'MS-7640', '00000000-0000-0000-0000-D43D7ED820B5', 'Terminado', 1, 1),
(2, 'TOSHIBA', 'Satellite L45-A', '5D019380K', 'Terminado', 1, 2),
(3, 'COMPAQ', 'COMPAQ 610', 'VF483LA#ABM', 'En Reparacion', 1, 3),
(4, 'SAMSUNG', '300E4A/300E5A/300E7A/3430EA/3530EA', 'HPYJ91HC100108', 'Esperando', 1, 4),
(5, 'AMD-PC', 'MS-7640', '00000000-0000-0000-0000-D43D7ED820B5', 'Terminado', 5, 5),
(6, 'TOSHIBA', 'Satellite L45-A', '5D019380K', 'Terminado', 5, 6),
(7, 'COMPAQ', 'COMPAQ 610', 'VF483LA#ABM', 'En Reparacion', 5, 7),
(8, 'SAMSUNG', '300E4A/300E5A/300E7A/3430EA/3530EA', 'HPYJ91HC100108', 'Esperando', 5, 8);
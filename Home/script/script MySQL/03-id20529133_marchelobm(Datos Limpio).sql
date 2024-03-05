--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`rut`, `pass`, `nombre`, `apellido`, `tipousuario`) VALUES
('17.008.864-6', 'f0578f1e7174b1a41c4ea8c6e17f7a8a3b88c92a', 'Marchelo', 'Burgos', 'Cliente'),
('22.222.222-2', '8be52126a6fde450a7162a3651d589bb51e9579d', 'Marcelo', 'Burgos', 'Técnico'),
('33.333.333-3', '8be52126a6fde450a7162a3651d589bb51e9579d', 'Maxi', 'Castro', 'Técnico'),
('11.111.111-1', 'de2a4d5751ab06dc4f987142db57c26d50925c8a', 'Admin', 'Admin', 'Administrador');

INSERT INTO `administrador` (`correo`, `celular`, `area`, `activo`, `usuario_idusuario`) VALUES
('info@duoc.cl', '985655256', 'Jefe', 1, 3);

--
-- Volcado de datos para la tabla `tecnico`
--

INSERT INTO `tecnico` (`correo`, `celular`, `especialidad`, `experiencia`, `activo`, `usuario_idusuario`) VALUES
('info@duoc.cl', '990715586', 'tecnico Sofware', 8, 1, 2),
('info@duoc.cl', '999988777', 'tecnico RED', 4, 1, 3);

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`direccion`, `celular`, `correo`, `usuario_idusuario`) VALUES
('El Fardo #3848', '990715586', 'marchelo.1989@live.cl', 1);

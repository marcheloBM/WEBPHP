INSERT INTO usuario (rut,pass,nombre,apellido,tipousuario)VALUES('17.008.864-6','pass1','Marchelo','Burgos','Cliente');
INSERT INTO usuario (rut,pass,nombre,apellido,tipousuario)VALUES('11.017.269-9','pass1','Juan','Pérez','Cliente');
INSERT INTO usuario (rut,pass,nombre,apellido,tipousuario)VALUES('23.069.645-4','pass2','Karen','Ramirez','Técnico');
INSERT INTO usuario (rut,pass,nombre,apellido,tipousuario)VALUES('14.671.476-5','pass2','Laura','Torres','Técnico');
INSERT INTO usuario (rut,pass,nombre,apellido,tipousuario)VALUES('11.111.111-1','pass3','Carlos','Gómez','Administrador');
--select * from usuario;

INSERT INTO cliente (direccion,celular,correo,usuario_idusuario) VALUES ('mexico #5856','9996856','marchelo.1989@live.cl',1);
INSERT INTO cliente (direccion,celular,correo,usuario_idusuario) VALUES ('Paseo Nadia #261','85474545','marchelo.1989@live.cl',2);
--select * from cliente;

INSERT INTO administrador (correo,celular,area,activo,usuario_idusuario) VALUES ('info@duoc.cl','985655256','Jefe',1,5);
--select * from administrador;


INSERT INTO tecnico (correo,celular,especialidad,experiencia,activo,usuario_idusuario) VALUES ('Karen@duoc.cl',907554685,'tecnico Sofware',5,1,3);
INSERT INTO tecnico (correo,celular,especialidad,experiencia,activo,usuario_idusuario) VALUES ('Laura@duoc.cl',645796546,'tecnico Hardware',3,1,4);
--select * from tecnico;

INSERT INTO presupuesto (tiporeparacion, FECHAINGRESO, FECHATERMINO, ESTADO, DESCRIPCION, VALOR) VALUES('Formateo', TO_DATE('2023-06-19 20:59:29', 'YYYY-MM-DD HH24:MI:SS'), TO_DATE('2023-06-23 20:59:32', 'YYYY-MM-DD HH24:MI:SS'), 'Pendiente', 'Reinstalacion del sistema', '30000');
INSERT INTO presupuesto (tiporeparacion, FECHAINGRESO, FECHATERMINO, ESTADO, DESCRIPCION, VALOR) VALUES('Limpieza', TO_DATE('2023-06-18 20:59:29', 'YYYY-MM-DD HH24:MI:SS'), TO_DATE('2023-06-22 20:59:32', 'YYYY-MM-DD HH24:MI:SS'), 'En Proceso', 'Cambio de pasta termica', '30000');
INSERT INTO presupuesto (tiporeparacion, FECHAINGRESO, FECHATERMINO, ESTADO, DESCRIPCION, VALOR) VALUES('Instalacion', TO_DATE('2023-06-06 20:59:29', 'YYYY-MM-DD HH24:MI:SS'), TO_DATE('2023-06-13 20:59:32', 'YYYY-MM-DD HH24:MI:SS'), 'Rechazado', 'Instalacion de office 2021', '30000');
INSERT INTO presupuesto (tiporeparacion, FECHAINGRESO, FECHATERMINO, ESTADO, DESCRIPCION, VALOR) VALUES('Reparacion', TO_DATE('2023-06-12 20:59:29', 'YYYY-MM-DD HH24:MI:SS'), TO_DATE('2023-06-19 20:59:32', 'YYYY-MM-DD HH24:MI:SS'), 'En Proceso', 'Cambio de pantalla', '30000');
INSERT INTO presupuesto (tiporeparacion, FECHAINGRESO, FECHATERMINO, ESTADO, DESCRIPCION, VALOR) VALUES('Formateo', TO_DATE('2023-06-05 20:59:29', 'YYYY-MM-DD HH24:MI:SS'), TO_DATE('2023-06-12 20:59:32', 'YYYY-MM-DD HH24:MI:SS'), 'Rechazado', 'Cambio del sistema operativo de windows 8 a windows 10', '30000');
INSERT INTO presupuesto (tiporeparacion, FECHAINGRESO, FECHATERMINO, ESTADO, DESCRIPCION, VALOR) VALUES('Limpieza', TO_DATE('2023-06-06 20:59:29', 'YYYY-MM-DD HH24:MI:SS'), TO_DATE('2023-06-13 20:59:32', 'YYYY-MM-DD HH24:MI:SS'), 'Rechazado', 'Cambio de pasta termica', '30000');
INSERT INTO presupuesto (tiporeparacion, FECHAINGRESO, FECHATERMINO, ESTADO, DESCRIPCION, VALOR) VALUES('Instalacion', TO_DATE('2023-06-12 20:59:29', 'YYYY-MM-DD HH24:MI:SS'), TO_DATE('2023-06-19 20:59:32', 'YYYY-MM-DD HH24:MI:SS'), 'En Proceso', 'Instalacion de programas actualizados', '30000');
INSERT INTO presupuesto (tiporeparacion, FECHAINGRESO, FECHATERMINO, ESTADO, DESCRIPCION, VALOR) VALUES('Reparacion', TO_DATE('2023-06-05 20:59:29', 'YYYY-MM-DD HH24:MI:SS'), TO_DATE('2023-06-12 20:59:32', 'YYYY-MM-DD HH24:MI:SS'), 'Rechazado', 'Cambio del disco', '30000');
--SELECT * from presupuesto;


INSERT INTO equipo (marca,modelo,numserie,estado,usuario_idusuario,presupuesto_idpresupuesto) VALUES ('HP', 'Pavilion', '65461651d651', 'Sin Revision', 1, 11);
INSERT INTO equipo (marca,modelo,numserie,estado,usuario_idusuario,presupuesto_idpresupuesto) VALUES ('Samsung', '365', 'fsdfsd4564dsf', 'Esperando', 1, 12);
INSERT INTO equipo (marca,numserie,estado,usuario_idusuario,presupuesto_idpresupuesto) VALUES ('Dell', 'asdasdasfasf', 'Terminado', 1, 13);
INSERT INTO equipo (marca,numserie,estado,usuario_idusuario,presupuesto_idpresupuesto) VALUES ('ASUS', 'asfasfasf', 'Esperando', 1, 14);
INSERT INTO equipo (marca,modelo,numserie,estado,usuario_idusuario,presupuesto_idpresupuesto) VALUES ('HP', 'HP2117la', '734782g348273g4', 'Terminado', 1, 15);
INSERT INTO equipo (marca,modelo,numserie,estado,usuario_idusuario,presupuesto_idpresupuesto) VALUES ('compag', 'h565', '8955sdgs6464s', 'Terminado', 2, 16);
INSERT INTO equipo (marca,modelo,numserie,estado,usuario_idusuario,presupuesto_idpresupuesto) VALUES ('Toshiba', '865ads6', 'sdfsdf646sf', 'Esperando', 2, 17);
INSERT INTO equipo (marca,numserie,estado,usuario_idusuario,presupuesto_idpresupuesto) VALUES ('Lenovo', 'fsdfsd4564dsf', 'Terminado', 2, 18);
--select * from equipo;

INSERT INTO agenda (fechahora, descripcion, tecnico_idtecnico, cliente_idcliente) VALUES (TO_DATE('2023-06-16 00:22:36', 'YYYY-MM-DD HH24:MI:SS'), 'Revision de HP', '9', '6');
--SELECT * FROM agenda;

INSERT INTO usuario (rut,pass,nombre,apellido,tipousuario)VALUES('22.832.064-1','pass2','Fabio','Leopoldo','Técnico');
INSERT INTO usuario (rut,pass,nombre,apellido,tipousuario)VALUES('15.716.631-k','pass2','Noelia','Alarcon','Técnico');

INSERT INTO tecnico (correo,celular,especialidad,experiencia,activo,usuario_idusuario) VALUES ('Leopoldoc@duoc.cl',86595563,'tecnico Sofware',6,0,28);
INSERT INTO tecnico (correo,celular,especialidad,experiencia,activo,usuario_idusuario) VALUES ('Noelia@duoc.cl',85647756,'tecnico Hardware',2,0,29);


INSERT INTO repuesto (nombre,descripcion,precio) VALUES ('Mantencion','Pasta termica Z5 - 3g',9000);
INSERT INTO repuesto (nombre,descripcion,precio) VALUES ('Actualizacion','Office 2021',60000);
INSERT INTO repuesto (nombre,descripcion,precio) VALUES ('Terminado','Pantalla Para Asus',3000);
INSERT INTO repuesto (nombre,descripcion,precio) VALUES ('Mantencion','Pasta termica Z10 - 5g',14000);
INSERT INTO repuesto (nombre,descripcion,precio) VALUES ('Mejora','SSD de 512',50000);
--SELECT * FROM repuesto;
UPDATE presupuesto SET repuesto_idrepuesto = '32' WHERE idpresupuesto=12;//Cambio de pasta termica
UPDATE presupuesto SET repuesto_idrepuesto = '32' WHERE idpresupuesto=13;//Instalacion de office 2021
UPDATE presupuesto SET repuesto_idrepuesto = '33' WHERE idpresupuesto=14;//Cambio de pantalla
UPDATE presupuesto SET repuesto_idrepuesto = '34' WHERE idpresupuesto=16;//Cambio de pasta termica
UPDATE presupuesto SET repuesto_idrepuesto = '34' WHERE idpresupuesto=18;//Cambio del disco

INSERT INTO usuario (rut,pass,nombre,apellido,tipousuario)VALUES('23.136.465-k','pass1','Eduardo','Sales','Cliente');
INSERT INTO cliente (direccion,celular,correo,usuario_idusuario) VALUES ('mexico #5856','9996856','ma.burgosm@duocuc.cl',37);
INSERT INTO presupuesto (tiporeparacion, FECHAINGRESO, FECHATERMINO, ESTADO, DESCRIPCION, VALOR) VALUES('Formateo', TO_DATE('2023-06-19 20:59:29', 'YYYY-MM-DD HH24:MI:SS'), TO_DATE('2023-06-23 20:59:32', 'YYYY-MM-DD HH24:MI:SS'), 'Pendiente', 'Reinstalacion del sistema', '30000');
INSERT INTO presupuesto (tiporeparacion, FECHAINGRESO, FECHATERMINO, ESTADO, DESCRIPCION, VALOR) VALUES('Limpieza', TO_DATE('2023-06-18 20:59:29', 'YYYY-MM-DD HH24:MI:SS'), TO_DATE('2023-06-22 20:59:32', 'YYYY-MM-DD HH24:MI:SS'), 'En Proceso', 'Cambio de pasta termica', '30000');
INSERT INTO presupuesto (tiporeparacion, FECHAINGRESO, FECHATERMINO, ESTADO, DESCRIPCION, VALOR) VALUES('Instalacion', TO_DATE('2023-06-06 20:59:29', 'YYYY-MM-DD HH24:MI:SS'), TO_DATE('2023-06-13 20:59:32', 'YYYY-MM-DD HH24:MI:SS'), 'Rechazado', 'Instalacion de office 2021', '30000');
INSERT INTO presupuesto (tiporeparacion, FECHAINGRESO, FECHATERMINO, ESTADO, DESCRIPCION, VALOR) VALUES('Reparacion', TO_DATE('2023-06-12 20:59:29', 'YYYY-MM-DD HH24:MI:SS'), TO_DATE('2023-06-19 20:59:32', 'YYYY-MM-DD HH24:MI:SS'), 'En Proceso', 'Cambio de pantalla', '30000');
INSERT INTO equipo (marca,modelo,numserie,estado,usuario_idusuario,presupuesto_idpresupuesto) VALUES ('Apple', 'MacBook Air 13', 'dsfadsgarhan', 'Sin Revision', 37, 39);
INSERT INTO equipo (marca,modelo,numserie,estado,usuario_idusuario,presupuesto_idpresupuesto) VALUES ('Asus', 'dad46', 'asdasdasd', 'Esperando', 37, 40);
INSERT INTO equipo (marca,numserie,estado,usuario_idusuario,presupuesto_idpresupuesto) VALUES ('MSI', 'adadwasdsadasd', 'Terminado', 37, 41);
INSERT INTO equipo (marca,numserie,estado,usuario_idusuario,presupuesto_idpresupuesto) VALUES ('Raxer', 'dsjofsdofij', 'Esperando', 37, 42);
INSERT INTO repuesto (nombre,descripcion,precio) VALUES ('Mantencion','Pasta termica Z3 - 3g',9000);
INSERT INTO repuesto (nombre,descripcion,precio) VALUES ('Actualizacion','Office 2020',40000);
INSERT INTO repuesto (nombre,descripcion,precio) VALUES ('Terminado','Pantalla Para Asus',3000);
INSERT INTO repuesto (nombre,descripcion,precio) VALUES ('Mantencion','Pasta termica Z9 - 5g',14000);
INSERT INTO repuesto (nombre,descripcion,precio) VALUES ('Mejora','SSD de 512',50000);
UPDATE presupuesto SET repuesto_idrepuesto = '32' WHERE idpresupuesto=12;//Cambio de pasta termica
UPDATE presupuesto SET repuesto_idrepuesto = '32' WHERE idpresupuesto=13;//Instalacion de office 2021
UPDATE presupuesto SET repuesto_idrepuesto = '33' WHERE idpresupuesto=14;//Cambio de pantalla
UPDATE presupuesto SET repuesto_idrepuesto = '34' WHERE idpresupuesto=16;//Cambio de pasta termica
UPDATE presupuesto SET repuesto_idrepuesto = '34' WHERE idpresupuesto=18;//Cambio del disco

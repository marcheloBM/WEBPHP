SELECT * FROM usuario;
SELECT * FROM cliente;
SELECT c.idcliente as idcliente,u.nombre as nombre,u.apellido as apellido,c.usuario_idusuario as idcliente FROM cliente c join usuario u on c.usuario_idusuario = u.idusuario;

SELECT u.rut,u.nombre, e.marca from usuario u join equipo e on u.idusuario = e.usuario_idusuario;

SELECT * FROM presupuesto;
SELECT idpresupuesto,tiporeparacion,fechaingreso,fechatermino,estado,descripcion,valor,repuesto_idrepuesto FROM presupuesto;

SELECT u.idusuario as idu,u.nombre as nombre,u.apellido as apellido ,t.idtecnico as idt from usuario u join tecnico t on u.idusuario = t.usuario_idusuario;

SELECT idagenda,fechahora,descripcion,tecnico_idtecnico,cliente_idcliente FROM agenda;

select * from equipo;
select e.idequipo as idequipo,e.marca as marca,e.modelo as modelo,e.numserie as numserie,e.estado as estado,e.presupuesto_idpresupuesto as idPresupuesto,u.idusuario as idusuario,u.nombre as nombre,u.apellido as apellido from equipo e join usuario u on e.usuario_idusuario  = u.idusuario;
SELECT * FROM equipo e join presupuesto p on e.presupuesto_idpresupuesto  = p.idpresupuesto where e.idequipo=19;
SELECT idequipo,marca,modelo,numserie,estado,presupuesto_idpresupuesto,usuario_idusuario FROM equipo WHERE usuario_idusuario='1';


SELECT estado as tipoEstado, COUNT(*) AS cantidad FROM equipo GROUP BY estado;
SELECT estado, COUNT(*) AS cantidad FROM presupuesto GROUP BY estado;

SELECT * FROM tecnico ;
SELECT u.idusuario as idu,u.rut as rut,u.nombre as nombre,u.apellido as apellido ,t.idtecnico as idt,t.correo as correo,t.celular as celular,t.especialidad as especialidad,t.experiencia as experiencia from usuario u join tecnico t on u.idusuario = t.usuario_idusuario WHERE t.activo=1;
SELECT u.idusuario as idu,u.rut as rut,u.nombre as nombre,u.apellido as apellido ,t.idtecnico as idt,t.correo as correo,t.celular as celular,t.especialidad as especialidad,t.experiencia as experiencia,t.activo as activo from usuario u join tecnico t on u.idusuario = t.usuario_idusuario;

SELECT * from agenda;
select a.idagenda as idAgenda,a.fechahora as fecha,a.descripcion as descripcion,a.cliente_idcliente as idCliente,a.tecnico_idtecnico as idTecnico,
u1.nombre as nombreCli,u1.apellido as apellidoCli,
u2.nombre as nombreTec,u2.apellido as apellidoTec from agenda a 
join cliente c on a.cliente_idcliente = c.idcliente
join usuario u1 on u1.idusuario = c.usuario_idusuario
join tecnico t on t.idtecnico = a.tecnico_idtecnico
join usuario u2 on u2.idusuario = t.usuario_idusuario;

SELECT idrepuesto,nombre,descripcion,precio FROM repuesto;

SELECT * FROM equipo;
SELECT * FROM presupuesto;
SELECT * FROM repuesto;
SELECT * FROM presupuesto where estado='En Proceso';

--Para Implementar
SELECT u.idusuario as idUsuario, u.rut as rut, u.nombre as nombre, u.apellido as apellido, 
e.idequipo as idequipo, e.marca as marca, e.modelo as modelo, e.numserie as numserie, e.estado as estadoequipo, 
p.idpresupuesto as idpresupuesto, p.tiporeparacion as tiporeparacion, p.fechaingreso as fechaingreso, p.fechatermino as fechatermino, p.estado as estadopresupuesto, p.descripcion as descripcion, p.valor as valor, 
r.idrepuesto as idrepuesto, r.nombre AS nombrerepuesto, r.descripcion AS descripcionrepuesto, r.precio as precio 
FROM equipo e
JOIN usuario u ON e.usuario_idusuario = u.idusuario
LEFT JOIN presupuesto p ON e.presupuesto_idpresupuesto = p.idpresupuesto
LEFT JOIN repuesto r ON p.repuesto_idrepuesto = r.idrepuesto;

SELECT u.idusuario as idUsuario, u.rut as rut, u.nombre as nombre, u.apellido as apellido, 
e.idequipo as idequipo, e.marca as marca, e.modelo as modelo, e.numserie as numserie, e.estado as estadoequipo, e.presupuesto_idpresupuesto as idpresupuesto
FROM equipo e JOIN usuario u ON e.usuario_idusuario = u.idusuario;

SELECT c.correo as correo FROM usuario u join cliente c on u.idusuario = c.usuario_idusuario LEFT join equipo e on u.idusuario = e.usuario_idusuario LEFT join presupuesto pr on e.presupuesto_idpresupuesto = pr.idpresupuesto where pr.idpresupuesto = 11;
//Eliminar procedimiento
DROP PROCEDURE LISTAR_EQUIPO;

//Crear o remplaza un procedimiento 
CREATE OR REPLACE PROCEDURE LISTAR_EQUIPO (p_result OUT SYS_REFCURSOR)
AS
BEGIN
  OPEN p_result FOR SELECT u.idusuario as idUsuario, u.rut as rut, u.nombre as nombre, u.apellido as apellido, 
e.idequipo as idequipo, e.marca as marca, e.modelo as modelo, e.numserie as numserie, e.estado as estadoequipo, e.presupuesto_idpresupuesto as idpresupuesto
FROM equipo e JOIN usuario u ON e.usuario_idusuario = u.idusuario;
END;
/

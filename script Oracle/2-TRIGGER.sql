DROP SEQUENCE secuencia_id;
CREATE SEQUENCE secuencia_id
  START WITH 1
  INCREMENT BY 1;

CREATE OR REPLACE TRIGGER auto_usuario
BEFORE INSERT ON usuario
FOR EACH ROW
BEGIN
  :NEW.idusuario := secuencia_id.NEXTVAL;
END;
/
CREATE OR REPLACE TRIGGER auto_cliente
BEFORE INSERT ON cliente
FOR EACH ROW
BEGIN
  :NEW.idcliente := secuencia_id.NEXTVAL;
END;
/
CREATE OR REPLACE TRIGGER auto_administrador
BEFORE INSERT ON administrador
FOR EACH ROW
BEGIN
  :NEW.idadministrador := secuencia_id.NEXTVAL;
END;
/
CREATE OR REPLACE TRIGGER auto_tecnico
BEFORE INSERT ON tecnico
FOR EACH ROW
BEGIN
  :NEW.idtecnico := secuencia_id.NEXTVAL;
END;
/
CREATE OR REPLACE TRIGGER auto_equipo
BEFORE INSERT ON equipo
FOR EACH ROW
BEGIN
  :NEW.idequipo := secuencia_id.NEXTVAL;
END;
/
CREATE OR REPLACE TRIGGER auto_agenda
BEFORE INSERT ON agenda
FOR EACH ROW
BEGIN
  :NEW.idagenda := secuencia_id.NEXTVAL;
END;
/
CREATE OR REPLACE TRIGGER auto_presupuesto
BEFORE INSERT ON presupuesto
FOR EACH ROW
BEGIN
  :NEW.idpresupuesto := secuencia_id.NEXTVAL;
END;
/
CREATE OR REPLACE TRIGGER auto_repuesto
BEFORE INSERT ON repuesto
FOR EACH ROW
BEGIN
  :NEW.idrepuesto := secuencia_id.NEXTVAL;
END;
/
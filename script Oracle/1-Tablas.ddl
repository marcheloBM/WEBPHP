-- Generado por Oracle SQL Developer Data Modeler 23.1.0.087.0806
--   en:        2023-07-11 00:48:31 CLT
--   sitio:      Oracle Database 21c
--   tipo:      Oracle Database 21c



DROP TABLE administrador CASCADE CONSTRAINTS;

DROP TABLE agenda CASCADE CONSTRAINTS;

DROP TABLE cliente CASCADE CONSTRAINTS;

DROP TABLE equipo CASCADE CONSTRAINTS;

DROP TABLE presupuesto CASCADE CONSTRAINTS;

DROP TABLE repuesto CASCADE CONSTRAINTS;

DROP TABLE tecnico CASCADE CONSTRAINTS;

DROP TABLE usuario CASCADE CONSTRAINTS;

-- predefined type, no DDL - MDSYS.SDO_GEOMETRY

-- predefined type, no DDL - XMLTYPE

--  Datos de los administradores del sistema 
CREATE TABLE administrador ( 
--  ID de cada administrador registrado 
    idadministrador   NUMBER NOT NULL, 
--  Correo electrónico de cada administrador
    correo            NVARCHAR2(25) NOT NULL, 
--  Celular del administrador
    celular           NVARCHAR2(25), 
--  Área donde trabaja el administrador 
    area              NVARCHAR2(25) NOT NULL, 
--  Si es administrador se encuentra activos para el uso del sistema
    activo            NUMBER, 
--  ID de usuario asignado 
    usuario_idusuario NUMBER NOT NULL
);

COMMENT ON TABLE administrador IS
    'Datos de los administradores del sistema ';

COMMENT ON COLUMN administrador.idadministrador IS
    'ID de cada administrador registrado ';

COMMENT ON COLUMN administrador.correo IS
    'Correo electrónico de cada administrador';

COMMENT ON COLUMN administrador.celular IS
    'Celular del administrador';

COMMENT ON COLUMN administrador.area IS
    'Área donde trabaja el administrador ';

COMMENT ON COLUMN administrador.activo IS
    'Si es administrador se encuentra activos para el uso del sistema';

COMMENT ON COLUMN administrador.usuario_idusuario IS
    'ID de usuario asignado ';

ALTER TABLE administrador ADD CONSTRAINT administrador_pk PRIMARY KEY ( idadministrador );

--  Todas las horas registradas
CREATE TABLE agenda ( 
--  Identificador de la tabla agenda
    idagenda          NUMBER NOT NULL, 
--  Fecha y hora para agendar con el técnico
    fechahora         DATE NOT NULL, 
--  Pequeña descripción sobre los resultados de la hora toma
    descripcion       NVARCHAR2(25) NOT NULL, 
--  Identificador del trabajador registrado
    tecnico_idtecnico NUMBER NOT NULL, 
--  Identificador de cada cliente 
    cliente_idcliente NUMBER NOT NULL
);

COMMENT ON TABLE agenda IS
    'Todas las horas registradas';

COMMENT ON COLUMN agenda.idagenda IS
    'Identificador de la tabla agenda';

COMMENT ON COLUMN agenda.fechahora IS
    'Fecha y hora para agendar con el técnico';

COMMENT ON COLUMN agenda.descripcion IS
    'Pequeña descripción sobre los resultados de la hora toma';

COMMENT ON COLUMN agenda.tecnico_idtecnico IS
    'Identificador del trabajador registrado';

COMMENT ON COLUMN agenda.cliente_idcliente IS
    'Identificador de cada cliente ';

ALTER TABLE agenda ADD CONSTRAINT agenda_pk PRIMARY KEY ( idagenda );

--  Todos los cliente registrados 
CREATE TABLE cliente ( 
--  Identificador de cada cliente 
    idcliente         NUMBER NOT NULL, 
--  Dirección de cada cliente
    direccion         NVARCHAR2(25), 
--  Celular personal de cada cliente 
    celular           NVARCHAR2(25) NOT NULL, 
--  Correo personal de cada cliente 
    correo            NVARCHAR2(25) NOT NULL, 
--  Identificador de la tabla usuario
    usuario_idusuario NUMBER NOT NULL
);

COMMENT ON TABLE cliente IS
    'Todos los cliente registrados ';

COMMENT ON COLUMN cliente.idcliente IS
    'Identificador de cada cliente ';

COMMENT ON COLUMN cliente.direccion IS
    'Dirección de cada cliente';

COMMENT ON COLUMN cliente.celular IS
    'Celular personal de cada cliente ';

COMMENT ON COLUMN cliente.correo IS
    'Correo personal de cada cliente ';

COMMENT ON COLUMN cliente.usuario_idusuario IS
    'Identificador de la tabla usuario';

ALTER TABLE cliente ADD CONSTRAINT cliente_pk PRIMARY KEY ( idcliente );

--  Tabla que almacena información sobre los equipos de cada cliente
CREATE TABLE equipo ( 
--  Identificardor de cada equipo registrado
    idequipo                  NUMBER NOT NULL, 
--  Marca del computador
    marca                     NVARCHAR2(25) NOT NULL, 
--  Modelo del computador
    modelo                    NVARCHAR2(25), 
--  Numero de serie de cada computador
    numserie                  NVARCHAR2(25) NOT NULL, 
--  Estado del proceso del Equipo en el sistema (Sin Revision- Esperando-En
--  Reparacion- Terminado)
    estado                    NVARCHAR2(25), 
--  Identificador de la tabla usuario
    usuario_idusuario         NUMBER, 
--  Identificador de la tabla presupuesto 
    presupuesto_idpresupuesto NUMBER
);

COMMENT ON TABLE equipo IS
    'Tabla que almacena información sobre los equipos de cada cliente';

COMMENT ON COLUMN equipo.idequipo IS
    'Identificardor de cada equipo registrado';

COMMENT ON COLUMN equipo.marca IS
    'Marca del computador';

COMMENT ON COLUMN equipo.modelo IS
    'Modelo del computador';

COMMENT ON COLUMN equipo.numserie IS
    'Numero de serie de cada computador';

COMMENT ON COLUMN equipo.estado IS
    'Estado del proceso del Equipo en el sistema (Sin Revision- Esperando-En Reparacion- Terminado)';

COMMENT ON COLUMN equipo.usuario_idusuario IS
    'Identificador de la tabla usuario';

COMMENT ON COLUMN equipo.presupuesto_idpresupuesto IS
    'Identificador de la tabla presupuesto ';

ALTER TABLE equipo ADD CONSTRAINT equipo_pk PRIMARY KEY ( idequipo );

--  Tabla que almacena información sobre los presupuestos de reparación de
--  equipos
CREATE TABLE presupuesto ( 
--  Identificador único de cada presupuesto
    idpresupuesto       NUMBER NOT NULL, 
--  Tipo de reparación efectuada al equipo (Formateo- Limpieza- Instalacion-
--  Reparacion)
    tiporeparacion      NVARCHAR2(25) NOT NULL, 
--  Fecha de ingreso del presupuesto 
    fechaingreso        DATE NOT NULL, 
--  Fecha de termino del presupuesto 
    fechatermino        DATE, 
--  Estado del presupuesto (Aprobado- Rechazado- En Proceso- Pendiente)
    estado              NVARCHAR2(25) NOT NULL, 
--  Descripción del presupuesto 
    descripcion         NVARCHAR2(125), 
--  Valor asignado para el presupuesto 
    valor               NUMBER NOT NULL, 
--  Identificador de la tabla Repuesto Si se requiere 
    repuesto_idrepuesto NUMBER
);

COMMENT ON TABLE presupuesto IS
    'Tabla que almacena información sobre los presupuestos de reparación de equipos';

COMMENT ON COLUMN presupuesto.idpresupuesto IS
    'Identificador único de cada presupuesto';

COMMENT ON COLUMN presupuesto.tiporeparacion IS
    'Tipo de reparación efectuada al equipo (Formateo- Limpieza- Instalacion- Reparacion)';

COMMENT ON COLUMN presupuesto.fechaingreso IS
    'Fecha de ingreso del presupuesto ';

COMMENT ON COLUMN presupuesto.fechatermino IS
    'Fecha de termino del presupuesto ';

COMMENT ON COLUMN presupuesto.estado IS
    'Estado del presupuesto (Aprobado- Rechazado- En Proceso- Pendiente)';

COMMENT ON COLUMN presupuesto.descripcion IS
    'Descripción del presupuesto ';

COMMENT ON COLUMN presupuesto.valor IS
    'Valor asignado para el presupuesto ';

COMMENT ON COLUMN presupuesto.repuesto_idrepuesto IS
    'Identificador de la tabla Repuesto Si se requiere ';

ALTER TABLE presupuesto ADD CONSTRAINT presupuesto_pk PRIMARY KEY ( idpresupuesto );

--  Repuesto para cada reparación de un equipo 
CREATE TABLE repuesto ( 
--  Identificador único de cada repuesto
    idrepuesto  NUMBER NOT NULL, 
--  Nombre asignado para los repuestos
    nombre      NVARCHAR2(25) NOT NULL, 
--  Descripción de cada repuesto solicitado 
    descripcion NVARCHAR2(125), 
--  precio asignado para los repuestos 
    precio      NUMBER NOT NULL
);

COMMENT ON TABLE repuesto IS
    'Repuesto para cada reparación de un equipo ';

COMMENT ON COLUMN repuesto.idrepuesto IS
    'Identificador único de cada repuesto';

COMMENT ON COLUMN repuesto.nombre IS
    'Nombre asignado para los repuestos';

COMMENT ON COLUMN repuesto.descripcion IS
    'Descripción de cada repuesto solicitado ';

COMMENT ON COLUMN repuesto.precio IS
    'precio asignado para los repuestos ';

ALTER TABLE repuesto ADD CONSTRAINT repuesto_pk PRIMARY KEY ( idrepuesto );

--  Registro de todos lo trabajadores que trabajan en la empresa 
CREATE TABLE tecnico ( 
--  Identificador del trabajador registrado
    idtecnico         NUMBER NOT NULL, 
--  Correo del técnico 
    correo            NVARCHAR2(25) NOT NULL, 
--  Celular del técnico 
    celular           NVARCHAR2(25), 
--  Especialidad o profesión 
    especialidad      NVARCHAR2(25) NOT NULL, 
--  Experiencia laboral 
    experiencia       NUMBER(11) NOT NULL, 
--  Si el técnico se encuentra activo para usar el sistema
    activo            NUMBER, 
--  Identificador para la tabla usuario 
    usuario_idusuario NUMBER NOT NULL
);

COMMENT ON TABLE tecnico IS
    'Registro de todos lo trabajadores que trabajan en la empresa ';

COMMENT ON COLUMN tecnico.idtecnico IS
    'Identificador del trabajador registrado';

COMMENT ON COLUMN tecnico.correo IS
    'Correo del técnico ';

COMMENT ON COLUMN tecnico.celular IS
    'Celular del técnico ';

COMMENT ON COLUMN tecnico.especialidad IS
    'Especialidad o profesión ';

COMMENT ON COLUMN tecnico.experiencia IS
    'Experiencia laboral ';

COMMENT ON COLUMN tecnico.activo IS
    'Si el técnico se encuentra activo para usar el sistema';

COMMENT ON COLUMN tecnico.usuario_idusuario IS
    'Identificador para la tabla usuario ';

ALTER TABLE tecnico ADD CONSTRAINT tecnico_pk PRIMARY KEY ( idtecnico );

--  Registro de todos los clientes, técnico y administrador 
CREATE TABLE usuario ( 
--  Identificador de la tabla usuario
    idusuario   NUMBER NOT NULL, 
--  El rut de cada usuario registrado 
    rut         NVARCHAR2(25) NOT NULL, 
--  La contraseña para usar el sistema 
    pass        NVARCHAR2(20) NOT NULL, 
--  Nombre de cada persona  
    nombre      NVARCHAR2(25) NOT NULL, 
--  Apellido de cada persona 
    apellido    NVARCHAR2(25) NOT NULL, 
--  El tipo de usuario en el sistema (clientes-técnico-administrador)
    tipousuario NVARCHAR2(25) NOT NULL
);

ALTER TABLE usuario ADD CHECK ( idusuario BETWEEN 1 AND 1000 );

COMMENT ON TABLE usuario IS
    'Registro de todos los clientes, técnico y administrador ';

COMMENT ON COLUMN usuario.idusuario IS
    'Identificador de la tabla usuario';

COMMENT ON COLUMN usuario.rut IS
    'El rut de cada usuario registrado ';

COMMENT ON COLUMN usuario.pass IS
    'La contraseña para usar el sistema ';

COMMENT ON COLUMN usuario.nombre IS
    'Nombre de cada persona  ';

COMMENT ON COLUMN usuario.apellido IS
    'Apellido de cada persona ';

COMMENT ON COLUMN usuario.tipousuario IS
    'El tipo de usuario en el sistema (clientes-técnico-administrador)';

ALTER TABLE usuario ADD CONSTRAINT usuario_pk PRIMARY KEY ( idusuario );

ALTER TABLE administrador
    ADD CONSTRAINT administrador_usuario_fk FOREIGN KEY ( usuario_idusuario )
        REFERENCES usuario ( idusuario );

ALTER TABLE agenda
    ADD CONSTRAINT agenda_cliente_fk FOREIGN KEY ( cliente_idcliente )
        REFERENCES cliente ( idcliente );

ALTER TABLE agenda
    ADD CONSTRAINT agenda_tecnico_fk FOREIGN KEY ( tecnico_idtecnico )
        REFERENCES tecnico ( idtecnico );

ALTER TABLE cliente
    ADD CONSTRAINT cliente_usuario_fk FOREIGN KEY ( usuario_idusuario )
        REFERENCES usuario ( idusuario );

ALTER TABLE equipo
    ADD CONSTRAINT equipo_presupuesto_fk FOREIGN KEY ( presupuesto_idpresupuesto )
        REFERENCES presupuesto ( idpresupuesto );

ALTER TABLE equipo
    ADD CONSTRAINT equipo_usuario_fk FOREIGN KEY ( usuario_idusuario )
        REFERENCES usuario ( idusuario );

ALTER TABLE presupuesto
    ADD CONSTRAINT presupuesto_repuesto_fk FOREIGN KEY ( repuesto_idrepuesto )
        REFERENCES repuesto ( idrepuesto );

ALTER TABLE tecnico
    ADD CONSTRAINT tecnico_usuario_fk FOREIGN KEY ( usuario_idusuario )
        REFERENCES usuario ( idusuario );



-- Informe de Resumen de Oracle SQL Developer Data Modeler: 
-- 
-- CREATE TABLE                             8
-- CREATE INDEX                             0
-- ALTER TABLE                             17
-- CREATE VIEW                              0
-- ALTER VIEW                               0
-- CREATE PACKAGE                           0
-- CREATE PACKAGE BODY                      0
-- CREATE PROCEDURE                         0
-- CREATE FUNCTION                          0
-- CREATE TRIGGER                           0
-- ALTER TRIGGER                            0
-- CREATE COLLECTION TYPE                   0
-- CREATE STRUCTURED TYPE                   0
-- CREATE STRUCTURED TYPE BODY              0
-- CREATE CLUSTER                           0
-- CREATE CONTEXT                           0
-- CREATE DATABASE                          0
-- CREATE DIMENSION                         0
-- CREATE DIRECTORY                         0
-- CREATE DISK GROUP                        0
-- CREATE ROLE                              0
-- CREATE ROLLBACK SEGMENT                  0
-- CREATE SEQUENCE                          0
-- CREATE MATERIALIZED VIEW                 0
-- CREATE MATERIALIZED VIEW LOG             0
-- CREATE SYNONYM                           0
-- CREATE TABLESPACE                        0
-- CREATE USER                              0
-- 
-- DROP TABLESPACE                          0
-- DROP DATABASE                            0
-- 
-- REDACTION POLICY                         0
-- 
-- ORDS DROP SCHEMA                         0
-- ORDS ENABLE SCHEMA                       0
-- ORDS ENABLE OBJECT                       0
-- 
-- ERRORS                                   0
-- WARNINGS                                 0

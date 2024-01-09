--Otorgar premisos en caso de ERROR
alter session set "_ORACLE_SCRIPT"=true;
--Eliminar Todo
DROP USER TrackMyPC CASCADE;
drop tablespace TRACKMYPC_DATA including contents and datafiles;


--Crear Usuario BD + privilegio + table space
create user TrackMyPC  IDENTIFIED BY Duoc_2023;
GRANT all PRIVILEGES to TrackMyPC;
CREATE TABLESPACE TRACKMYPC_DATA
   DATAFILE 'tbs1.dbf'
   SIZE 256m
   AUTOEXTEND ON;
   
   

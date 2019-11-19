drop database if exists pesi_mantenimiento;
create database pesi_mantenimiento;
use pesi_mantenimiento;

create table producto (
	id VARCHAR(32) PRIMARY KEY,
    descripcion VARCHAR(32) NOT NULL,
    tipo VARCHAR(50) DEFAULT NULL, -- consumible o servicio???
    referencia VARCHAR(200) DEFAULT NULL,
    codigoSAP VARCHAR(10) DEFAULT NULL, -- 1000???
    grupo VARCHAR(32) DEFAULT NULL, -- de tabla grupo... muestra: [codigoGrupo] GP[serie]
    categoria VARCHAR(32) DEFAULT NULL, -- por defecto Todas
    moneda VARCHAR(3) DEFAULT NULL, -- $ o S/.
    costo decimal(10,2) DEFAULT NULL,
    estado INT(1) NOT NULL
    -- FOREIGN KEY 
);

INSERT INTO PRODUCTO VALUES 
	(uuid(), 'AUTO','CONSUMIBLE', NULL, '1000', '[1000] GP0001', 'TODAS', 'S/.', '100.00', 1);

CREATE TABLE sector (
	id VARCHAR(32) PRIMARY KEY,
    codigo VARCHAR(32) NOT NULL,
    descripcion  VARCHAR(50) NOT NULL,
    estado INT(1) NOT NULL
);

INSERT INTO SECTOR VALUES 
	('ddfdf2de-0a72-11ea-9dd4-e4e749869830', '10000', 'no sé qué es esto', 1);

CREATE TABLE ORDENTRABAJO (
	id VARCHAR(32) PRIMARY KEY,
    descripcion VARCHAR(32) NOT NULL,
    fecha DATE NOT NULL,
    responsable VARCHAR(32) NOT NULL,
    presupuesto DECIMAL(10,2) NOT NULL,
    costo DECIMAL(10,2) NULL,
    finalizado int(1) NOT NULL,
    estado INT(1) NOT NULL
);

INSERT INTO ORDENTRABAJO VALUES
	('d80a4015-0a7d-11ea-9dd4-e4e749869830', 'ARREGLAR AUTO', now(), 'ADMINISTRADOR', 1000.00, NULL, 0, 1);

CREATE TABLE peticion (
	id VARCHAR(32) PRIMARY KEY,
    descripcion VARCHAR(32) NOT NULL,
    sector VARCHAR(32) NULL,
    codigoSAP VARCHAR(32) NULL,
    idOrdenTrabajo VARCHAR(32) NULL,
    solicitadoX VARCHAR(32) NOT NULL,
    fecha date NOT NULL,
    fechaPrevista DATE NULL, -- fecha de cierre eliminado
    tipoMantenimiento VARCHAR(10) NOT NULL,
    equipo VARCHAR(32) NULL,
    -- responsable VARCHAR(32) NULL, -- eliminar
    fechaPrevista DATE NULL,
    prioridad int(1) NULL,
    -- peticionInicial VARCHAR(32) NULL, -- eliminar
    nota VARCHAR(500) NULL,
    progreso VARCHAR(32) NULL,
    estado INT(1) NOT NULL,
    FOREIGN KEY (idOrdenTrabajo) REFERENCES ordenTrabajo(id)
);

INSERT INTO PETICION VALUES
	(uuid(), 'SE ROMPIÓ AUTO 1000', '[10000] MA00001', '100000', NULL, 'Administrador', NOW(), NULL, 'CORRECTIVO', 'MANTENIMIENTO INTERNO', 1, NULL, 'INICIO', 1);

CREATE TABLE tarea (
	id VARCHAR(32) PRIMARY KEY,
    idOrdenTrabajo VARCHAR(32) NOT NULL,
    descripcion VARCHAR(32) NOT NULL,
    encargado VARCHAR(32) NOT NULL,
    presupuesto DECIMAL(10,2) NOT NULL,
    costo DECIMAL(10,2) NULL,
    finalizado int(1) NOT NULL,
    estado INT(1) NOT NULL
);

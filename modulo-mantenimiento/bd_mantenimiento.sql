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
    codigo VARCHAR(32) DEFAULT NULL, -- vacío
    categoria VARCHAR(32) DEFAULT NULL, -- por defecto Todas
    costo decimal(10,2) DEFAULT NULL,
    estado INT(1) NOT NULL
    -- FOREIGN KEY 
);

INSERT INTO PRODUCTO VALUES 
	(uuid(), 'AUTO','CONSUMIBLE', NULL, '1000', '[1000] GP0001', NULL, 'TODAS', '100.00', 1);

CREATE TABLE sector (
	id VARCHAR(32) PRIMARY KEY,
    codigo VARCHAR(32) NOT NULL,
    descripcion  VARCHAR(50) NOT NULL,
    estado INT(1) NOT NULL
);

CREATE TABLE ordenTrabajo (
	id VARCHAR(32) PRIMARY KEY,
    fecha DATE NOT NULL,
    responsable VARCHAR(32) NOT NULL,
    finalizado int(1) NOT NULL,
    estado INT(1) NOT NULL
);

CREATE TABLE peticion (
	id VARCHAR(32) PRIMARY KEY,
    sector VARCHAR(32) NOT NULL,
    codigoSAP VARCHAR(32) NOT NULL,
    idOrdenTrabajo VARCHAR(32) NULL,
    solicitadoX VARCHAR(32) NOT NULL,
    fecha date NOT NULL,
    fechaCierre DATE NOT NULL,
    tipoMantenimiento VARCHAR(10) NOT NULL,
    equipo VARCHAR(32) NOT NULL,
    responsable VARCHAR(32) NOT NULL,
    fechaPrevista DATE NOT NULL,
    prioridad int(1) NOT NULL,
    peticionInicial VARCHAR(32) NOT NULL,
    nota VARCHAR(500) NOT NULL,
    progreso VARCHAR(32) NOT NULL,
    estado INT(1) NOT NULL,
    FOREIGN KEY (idOrdenTrabajo) REFERENCES ordenTrabajo(id)
);

CREATE TABLE tarea (
	id VARCHAR(32) PRIMARY KEY,
    idOrdenTrabajo VARCHAR(32) NOT NULL,
    descripcion VARCHAR(32) NOT NULL,
    encargado VARCHAR(32) NOT NULL,
    presupuesto DECIMAL(10,2) NOT NULL,
    costo DECIMAL(10,2) NOT NULL,
    finalizado int(1) NOT NULL,
    estado INT(1) NOT NULL
);

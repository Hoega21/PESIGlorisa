drop database if exists pesi_mantenimiento;
create database pesi_mantenimiento;
use pesi_mantenimiento;

CREATE TABLE categoria (
	id VARCHAR(36) PRIMARY KEY,
    descripcion VARCHAR(100) NOT NULL,
    iniciales VARCHAR(5) NOT NULL,
    estado INT(1) NOT NULL
);

insert into categoria values 
	('727550a8-0c07-11ea-81c6-e4e749869830', 'CARROS', 'CAR', 1),
    ('214e9ecc-0c08-11ea-81c6-e4e749869830', 'COMPUTADORAS', 'COMP', 1);

create table EQUIPO (
	id VARCHAR(36) PRIMARY KEY,
    descripcion VARCHAR(50) NOT NULL,
    -- tipoEquipo VARCHAR(50) DEFAULT NULL, -- consumible o servicio???
    idCategoria VARCHAR(36) NOT NULL, -- DE TABLA CATEGORIA
    serie VARCHAR(5) DEFAULT NULL, -- 1000??? --CODIGOPRODUCTO (CALCULAR AUTOMATICAMENTE EN DISABLED)
    referencia VARCHAR(200) DEFAULT NULL,
    -- grupo VARCHAR(32) DEFAULT NULL, -- de tabla grupo... muestra: [codigoGrupo] GP[serie] -- acá puede ir el area de glorisa    
    costo decimal(10,2) DEFAULT NULL,
    estado INT(1) NOT NULL,
    FOREIGN KEY (idCategoria) REFERENCES CATEGORIA(id)
);

INSERT INTO EQUIPO VALUES 
	-- (uuid(), 'AUTO','CONSUMIBLE', NULL, '1000', '[1000] GP0001', 'TODAS', 'S/.', '100.00', 1);
    ('2cf530b6-0c08-11ea-81c6-e4e749869830', 'AUTO SUSUKI','727550a8-0c07-11ea-81c6-e4e749869830', '00001', 'PLACA T1L-554, AÑO 2009', '5300.00', 1),
    ('f484a2ab-0c08-11ea-81c6-e4e749869830', 'IPHONE XR','214e9ecc-0c08-11ea-81c6-e4e749869830', '00001', 'USO DEL ADMINISTRADOR', '1500.00', 1);

CREATE TABLE sector ( -- PUEDE SER LAS AREAS DE GLORISA
	id VARCHAR(36) PRIMARY KEY,
    codigo VARCHAR(32) NOT NULL,
    descripcion  VARCHAR(50) NOT NULL,
    estado INT(1) NOT NULL
);

INSERT INTO SECTOR VALUES 
	('ddfdf2de-0a72-11ea-9dd4-e4e749869830', '10000', 'no sé qué es esto', 1);

CREATE TABLE ORDENTRABAJO (
	id VARCHAR(36) PRIMARY KEY,
    descripcion VARCHAR(100) NOT NULL,
    fecha DATE NOT NULL,
    generadaX VARCHAR(32) NOT NULL,
    presupuesto DECIMAL(10,2) NOT NULL,
    costo DECIMAL(10,2) NULL,
    finalizado int(1) NOT NULL,
    estado INT(1) NOT NULL
);

INSERT INTO ORDENTRABAJO VALUES
	('d80a4015-0a7d-11ea-9dd4-e4e749869830', 'ARREGLAR AUTO', now(), 'ADMINISTRADOR', 1000.00, NULL, 0, 1);

CREATE TABLE peticion (
	id VARCHAR(36) PRIMARY KEY,
    descripcion VARCHAR(100) NOT NULL,
    tipoMantenimiento VARCHAR(10) NOT NULL, -- CORRECTIVO, preventido
    -- areas VARCHAR(32) NULL, -- evaluar para eliminar
    -- categoriaEquipo VARCHAR(32) NULL, -- categoria producto
    idEquipo VARCHAR(36) NULL, -- codigo producto
    idOrdenTrabajo VARCHAR(36) NULL,
    solicitadoX VARCHAR(32) NOT NULL,
    fecha date NOT NULL,
    fechaPrevista DATE NULL, -- fecha de cierre eliminado
    prioridad int(1) NULL, -- 1 2 3
    nota VARCHAR(500) NULL,
    progreso VARCHAR(32) NULL,
    estado INT(1) NOT NULL,
    FOREIGN KEY (idOrdenTrabajo) REFERENCES ordenTrabajo(id)
);

INSERT INTO PETICION VALUES
	('987cf827-0c0a-11ea-81c6-e4e749869830', 'SE ROMPIÓ PARABRISA DE AUTO SUSUKI', 'CORRECTIVO', '2cf530b6-0c08-11ea-81c6-e4e749869830', NULL, 'ADMINISTRADOR', NOW(), '2019-11-27', 1, NULL, 'INICIO', 1);

CREATE TABLE tarea (
	id VARCHAR(36) PRIMARY KEY,
    idOrdenTrabajo VARCHAR(36) NOT NULL,
    descripcion VARCHAR(200) NOT NULL,
    encargado VARCHAR(32) NOT NULL,
    presupuesto DECIMAL(10,2) NOT NULL,
    costo DECIMAL(10,2) NULL,
    finalizado int(1) NOT NULL,
    estado INT(1) NOT NULL,
    FOREIGN KEY (idOrdenTrabajo) REFERENCES ORDENTRABAJO(id)
);

CREATE TABLE categoria (
	id VARCHAR(36) PRIMARY KEY,
    descripcion VARCHAR(100) NOT NULL,
    iniciales VARCHAR(5) NOT NULL,
    estado INT(1) NOT NULL
);

INSERT INTO `categoria` (`id`, `descripcion`, `iniciales`, `estado`) VALUES
('214e9ecc-0c08-11ea-81c6-e4e749869830', 'COMPUTADORAS', 'COMP', 1),
('727550a8-0c07-11ea-81c6-e4e749869830', 'CARROS', 'CAR', 1),
('dfe61191-0c1f-11ea-81c6-e4e749869830', 'CELULARES', 'CEL', 1);

create table equipo (
	id VARCHAR(36) PRIMARY KEY,
    descripcion VARCHAR(50) NOT NULL,
    -- tipoEquipo VARCHAR(50) DEFAULT NULL, -- consumible o servicio???
    idCategoria VARCHAR(36) NOT NULL, -- DE TABLA CATEGORIA
    serie VARCHAR(5) DEFAULT NULL, -- 1000??? --CODIGOPRODUCTO (CALCULAR AUTOMATICAMENTE EN DISABLED)
    referencia VARCHAR(200) DEFAULT NULL,
    -- grupo VARCHAR(36) DEFAULT NULL, -- de tabla grupo... muestra: [codigoGrupo] GP[serie] -- acá puede ir el area de glorisa    
    costo decimal(10,2) DEFAULT NULL,
    estado INT(1) NOT NULL,
    FOREIGN KEY (idCategoria) REFERENCES categoria(id)
);

INSERT INTO `equipo` (`id`, `descripcion`, `idCategoria`, `serie`, `referencia`, `costo`, `estado`) VALUES
('2cf530b6-0c08-11ea-81c6-e4e749869830', 'AUTO SUSUKI', '727550a8-0c07-11ea-81c6-e4e749869830', '00001', 'PLACA T1L-554, AÑO 2009', '5300.00', 1),
('9b2ebdbb-0c70-11ea-81c6-e4e749869830', 'SAMSUNG S8', 'dfe61191-0c1f-11ea-81c6-e4e749869830', '00002', 'AÑO 2018, ENTEL', '1200.00', 1),
('f484a2ab-0c08-11ea-81c6-e4e749869830', 'IPHONE XR', 'dfe61191-0c1f-11ea-81c6-e4e749869830', '00001', 'USO DEL ADMINISTRADOR', '1500.00', 1);


CREATE TABLE ordentrabajo (
	id VARCHAR(36) PRIMARY KEY,
    serie VARCHAR(5) NOT NULL,
    codigo VARCHAR(10) NOT NULL,
    asunto VARCHAR(100) NOT NULL,
    descripcion VARCHAR(100) NOT NULL,
    fecha DATE NOT NULL,
    generadaX VARCHAR(36) NOT NULL,
    presupuesto DECIMAL(10,2) NOT NULL,
    costo DECIMAL(10,2) NULL,
    finalizado int(1) NOT NULL,
    estado INT(1) NOT NULL
);

INSERT INTO `ordentrabajo` (`id`, `serie`, `codigo`, `asunto`, `descripcion`, `fecha`, `generadaX`, `presupuesto`, `costo`, `finalizado`, `estado`) VALUES
('6ae86ebb-0ca7-11ea-81c6-e4e749869830', '00002', '[OT-00002]', 'ARREGLAR CELULARES', '[OT-00002] ARREGLAR CELULARES', '2019-11-21', 'ADMINISTRADOR', '1999.99', NULL, 0, 1),
('ad7e692e-0ca7-11ea-81c6-e4e749869830', '00003', '[OT-00003]', 'ARREGLO DE COMPUTADORAS', '[OT-00003] ARREGLO DE COMPUTADORAS', '2019-11-21', 'ADMINISTRADOR', '250.00', '0.00', 0, 1),
('d80a4015-0a7d-11ea-9dd4-e4e749869830', '00001', '[OT-00001]', 'ARREGLAR AUTO', '[OT-00001] ARREGLAR AUTO', '2019-11-21', 'ADMINISTRADOR', '1000.00', NULL, 0, 1);


CREATE TABLE peticion (
	id VARCHAR(36) PRIMARY KEY,
    descripcion VARCHAR(100) NOT NULL,
    tipoMantenimiento VARCHAR(10) NOT NULL, -- CORRECTIVO, preventido
    -- areas VARCHAR(36) NULL, -- evaluar para eliminar
    -- categoriaEquipo VARCHAR(36) NULL, -- categoria producto
    idEquipo VARCHAR(36) NULL, -- codigo producto
    idOrdenTrabajo VARCHAR(36) NULL,
    solicitadoX VARCHAR(36) NOT NULL,
    fecha date NOT NULL,
    fechaPrevista DATE NULL, 
    fechaCierre DATE NULL,
    prioridad int(1) NULL, -- 1 2 3
    nota VARCHAR(500) NULL,
    progreso VARCHAR(36) NULL,
    estado INT(1) NOT NULL,
    FOREIGN KEY (idOrdenTrabajo) REFERENCES ordentrabajo(id)
);

INSERT INTO `peticion` (`id`, `descripcion`, `tipoMantenimiento`, `idEquipo`, `idOrdenTrabajo`, `solicitadoX`, `fecha`, `fechaPrevista`, `fechaCierre`, `prioridad`, `nota`, `progreso`, `estado`) VALUES
('1276a702-0c8a-11ea-81c6-e4e749869830', 'CELULAR SIN BATERÍA', 'CORRECTIVO', 'f484a2ab-0c08-11ea-81c6-e4e749869830', '6ae86ebb-0ca7-11ea-81c6-e4e749869830', 'ADMINISTRADOR', '2019-11-21', '2020-03-28', NULL, 2, 'NO FUNCIONA', 'EN PROCESO', 1),
('72fa4e8b-0c80-11ea-81c6-e4e749869830', 'SE ROMPIÓ LA PANTALLA DE CELULAR SAMSUNG', 'PREVENTIVO', 'f484a2ab-0c08-11ea-81c6-e4e749869830', '6ae86ebb-0ca7-11ea-81c6-e4e749869830', 'Administrador', '2019-11-21', '2019-12-30', NULL, 2, 'AÚN FUNCIONA PERO SE VE FEO', 'EN PROCESO', 1),
('987cf827-0c0a-11ea-81c6-e4e749869830', 'SE ROMPIÓ PARABRISA DE AUTO SUSUKI', 'CORRECTIVO', '2cf530b6-0c08-11ea-81c6-e4e749869830', 'd80a4015-0a7d-11ea-9dd4-e4e749869830', 'ADMINISTRADOR', '2019-11-21', '2020-02-27', NULL, 1, '-', 'EN PROCESO', 1),
('c64c90b7-0c8a-11ea-81c6-e4e749869830', 'SE BAJÓ LA LLANTA', 'PREVENTIVO', '2cf530b6-0c08-11ea-81c6-e4e749869830', NULL, 'ADMINISTRADOR', '2019-11-21', '2019-11-26', NULL, 3, '-', 'INICIO', 1);


CREATE TABLE tarea (
	id VARCHAR(36) PRIMARY KEY,
    idOrdenTrabajo VARCHAR(36) NOT NULL,
    descripcion VARCHAR(200) NOT NULL,
    encargado VARCHAR(36) NOT NULL,
    presupuesto DECIMAL(10,2) NOT NULL,
    costo DECIMAL(10,2) NULL,
    finalizado int(1) NOT NULL,
    estado INT(1) NOT NULL,
    FOREIGN KEY (idOrdenTrabajo) REFERENCES ordentrabajo(id)
);

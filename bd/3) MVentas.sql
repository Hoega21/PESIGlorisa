CREATE TABLE serie
(
	idSerie              CHAR(3) PRIMARY KEY,
	Departamento         VARCHAR(25) NOT NULL,
	Provincia            VARCHAR(25) NOT NULL,
	Distrito             VARCHAR(25) NOT NULL,
	Direccion            VARCHAR(250) NOT NULL,
	Fiscal					BOOLEAN
);
INSERT INTO serie VALUES ('001','La Libertad','Trujillo','Trujillo','AV. AMERICA SUR MZA. N LOTE. 12 URB. LA MERCED III ETAPA LA LIBERTAD',true);

CREATE TABLE documento
(
	TipoDocumento        CHAR(1) NOT NULL PRIMARY KEY,
	Descripcion          Varchar(25) NOT NULL,
	Longitud             int NOT NULL
);

INSERT INTO documento VALUES ('1','DNI',8);
INSERT INTO documento VALUES ('2','RUC',11);


CREATE TABLE cliente
(
	NroDocumento         CHAR(11) PRIMARY KEY,
	TipoDocumento        CHAR(1) NOT NULL,
	NombreCliente        VARCHAR(150) NOT NULL,
	Telefono             VARCHAR(12) NULL,
	Direccion            VARCHAR(150) NULL,
	Correo               VARCHAR(150) NULL,
	FOREIGN KEY(TipoDocumento) REFERENCES documento(TipoDocumento)
);

INSERT INTO cliente VALUES ('10164779900','2','Bardales Merino Delia del Pilar','217077',NULL,NULL);
INSERT INTO cliente VALUES ('10178418250','2','Aguilar Llajaruna Lorenzo Manuel','217077',NULL,NULL);
INSERT INTO cliente VALUES ('10179656570','2','Gamboa Vasquez  Emeldo Rogelio','217077',NULL,NULL);
INSERT INTO cliente VALUES ('10181852360','2','Avila Rodriguez Bertha','217077',NULL,NULL);
INSERT INTO cliente VALUES ('10471724250','2','Ponse Gutierrez Irma Cecilia','217077',NULL,NULL);
INSERT INTO cliente VALUES ('10454490270','2','Rubio Mariños George Emerson','217077',NULL,NULL);
INSERT INTO cliente VALUES ('20481698210','2','Destinos Travel & Services S.A.C.','217077',NULL,NULL);
INSERT INTO cliente VALUES ('20482780190','2','Asoc. Prod. Agrop. Conache','217077',NULL,NULL);
INSERT INTO cliente VALUES ('10107204801','2','Villanueva Ramirez Magaly Roxana','217077',NULL,NULL);
INSERT INTO cliente VALUES ('10178087261','2','Rojas Bringas Luis Miguel','217077',NULL,NULL);
INSERT INTO cliente VALUES ('12345678','1','Jorge Manrique','217077',NULL,NULL);
INSERT INTO cliente VALUES ('13456789','1','Miguel Perez','217077',NULL,NULL);
INSERT INTO cliente VALUES ('75386942','1','Roberto Jose Garcia','217077',NULL,NULL);
INSERT INTO cliente VALUES ('67894561','1','Jean Manuel Rodriguez','217077',NULL,NULL);


CREATE TABLE moneda (
	idMoneda INT PRIMARY KEY,
	Monedita VARCHAR(3) NOT NULL,
	TipoCambio FLOAT NOT NULL
);

INSERT INTO moneda VALUES (1,'PER',1);
INSERT INTO moneda VALUES (2,'USD',3.36);

CREATE TABLE comprobante
(
	TipoComprobante		CHAR(2) NOT NULL,
	idEmp				INT(11) NOT NULL,
	idSerie             CHAR(3) NOT NULL,
	Correlativo         CHAR(8) NOT NULL,
	NroDocCliente       CHAR(15) NULL,
	FechaEmision        DATE NOT NULL,
	idMoneda            INT NOT NULL,
	ValorVentaTotal		FLOAT NOT NULL,
	PrecioVentaTotal	FLOAT NOT NULL,
	IGVTotal			FLOAT NOT NULL,
	Estado				VARCHAR(15) NOT NULL,
	TipoPago			VARCHAR(15) NOT NULL,
	CHECK (TipoPago in ('Contado','Credito')),
	CHECK (Estado in ('Pendiente','Pagado')),
	CHECK (TipoComprobante in ('01','03','07')),
	PRIMARY KEY (idSerie,Correlativo,TipoComprobante),
	FOREIGN KEY(NroDocCliente) REFERENCES cliente(NroDocumento),
	FOREIGN KEY(idMoneda) REFERENCES moneda(idMoneda),
	FOREIGN KEY (idSerie) REFERENCES serie (idSerie),
	FOREIGN KEY (idEmp)  REFERENCES tblemployees(id)
);

INSERT INTO comprobante VALUES ('01',1,'001','00000001','10164779900','2019-11-21',1,10.25,12.50,2.25,'Pagado','Contado');
INSERT INTO comprobante VALUES ('01',1,'001','00000002','20482780190','2019-11-21',1,10.25,12.50,2.25,'Pagado','Contado');
INSERT INTO comprobante VALUES ('01',2,'001','00000003','10164779900','2019-11-21',1,10.25,12.50,2.25,'Pendiente','Credito');
INSERT INTO comprobante VALUES ('01',2,'001','00000004','10178418250','2019-11-21',1,10.25,12.50,2.25,'Pagado','Contado');
INSERT INTO comprobante VALUES ('01',2,'001','00000005','10471724250','2019-11-21',1,10.25,12.50,2.25,'Pendiente','Credito');
INSERT INTO comprobante VALUES ('01',1,'001','00000006','10164779900','2019-11-21',1,10.25,12.50,2.25,'Pagado','Contado');
INSERT INTO comprobante VALUES ('01',3,'001','00000007','10179656570','2019-11-21',1,10.25,12.50,2.25,'Pagado','Contado');
INSERT INTO comprobante VALUES ('01',1,'001','00000008','10178087261','2019-11-21',1,10.25,12.50,2.25,'Pendiente','Credito');
INSERT INTO comprobante VALUES ('01',3,'001','00000009','10164779900','2019-11-21',1,10.25,12.50,2.25,'Pagado','Contado');
INSERT INTO comprobante VALUES ('01',1,'001','00000010','10164779900','2019-11-21',1,10.25,12.50,2.25,'Pagado','Contado');
INSERT INTO comprobante VALUES ('01',3,'001','00000011','10179656570','2019-11-21',1,10.25,12.50,2.25,'Pagado','Contado');
INSERT INTO comprobante VALUES ('01',1,'001','00000012','10454490270','2019-11-21',1,10.25,12.50,2.25,'Pagado','Contado');


CREATE TABLE detalleComprobante
(
	TipoComprobante		CHAR(2) NOT NULL,
	idSerie             CHAR(3) NOT NULL,
	Correlativo         CHAR(8) NOT NULL,
	NroItem				INT NOT NULL,
	idProd    			INT NOT NULL,
	Cantidad             FLOAT NOT NULL,
	ValorUnitario        FLOAT NOT NULL,
	ValorVenta	         FLOAT NOT NULL,
	PrecioVenta          FLOAT NOT NULL,
	IGV                  FLOAT NULL,
	FOREIGN KEY(idProd) REFERENCES Producto(idProd),
	FOREIGN KEY(idSerie) REFERENCES serie(idSerie)
);

ALTER TABLE detalleComprobante
ADD PRIMARY KEY (idSerie,Correlativo,TipoComprobante,NroItem);

ALTER TABLE detalleComprobante
ADD FOREIGN KEY R_1 (idSerie, Correlativo,TipoComprobante) REFERENCES comprobante (idSerie, Correlativo,TipoComprobante);

CREATE TABLE recibo_pago(
	IdRecibo_Pago			INT AUTO_INCREMENT PRIMARY KEY,
	TipoComprobante		CHAR(2) NOT NULL,
	idEmp						INT(11) NOT NULL,
	idSerie              CHAR(3) NOT NULL,
	Correlativo          CHAR(8) NOT NULL,
	Fecha 					DATE NOT NULL,
	CantPago					FLOAT NOT NULL,
	SaldoPendiente			FlOAT NOT NULL,
	FOREIGN KEY(idSerie) REFERENCES serie(idSerie),
	FOREIGN KEY (idEmp)  REFERENCES tblemployees(id)
);


ALTER TABLE recibo_pago
ADD FOREIGN KEY R_2 (idSerie, Correlativo,TipoComprobante) REFERENCES comprobante (idSerie, Correlativo,TipoComprobante);


CREATE TABLE devoluciones(
	idDevoluciones			INT PRIMARY KEY AUTO_INCREMENT,
	TipoComprobante		CHAR(2) NOT NULL,
	idEmp						INT(11) NOT NULL,
	idSerie                CHAR(3) NOT NULL,
	Correlativo          CHAR(8) NOT NULL,
	TotalDevolver			FLOAT NOT NULL,
	Estado					INT NOT NULL,
	FOREIGN KEY(idSerie) REFERENCES serie(idSerie),
	FOREIGN KEY (idEmp)  REFERENCES tblemployees(id)
);


ALTER TABLE devoluciones
ADD FOREIGN KEY R_3 (idSerie, Correlativo,TipoComprobante) REFERENCES comprobante (idSerie, Correlativo,TipoComprobante);

CREATE TABLE detalleDevoluciones(
	idDetalleDevoluciones INT PRIMARY KEY AUTO_INCREMENT,
	idDevoluciones			INT NOT NULL,
	idProd    				INT NOT NULL,
	Cantidad             FLOAT NOT NULL,
	Observaciones			TEXT NOT NULL,
	ValorUnitario        FLOAT NOT NULL,
	ValorVenta	         FLOAT NOT NULL,
	PrecioVenta          FLOAT NOT NULL,
	IGV                  FLOAT NULL,
	FOREIGN KEY(idProd) REFERENCES Producto(idProd),
	FOREIGN KEY(idDevoluciones) REFERENCES devoluciones(idDevoluciones)
);

CREATE TABLE pedidoVenta(
	idPedidoVenta 		INT AUTO_INCREMENT PRIMARY KEY,
	NroDocCliente 		CHAR(11) NOT NULL,
	Departamento 	    VARCHAR(20) NOT NULL,
	Provincia			VARCHAR(20) NOT NULL,
	Distrito 			VARCHAR(20) NOT NULL,
	Direccion			VARCHAR(100) NOT NULL,
	FechaPedido			DATE NOT NULL,
	FechaEntrega		DATE NOT NULL,
	ValorVentaTotal	FLOAT NOT NULL,
	PrecioVentaTotal	FLOAT NOT NULL,
	IGVTotal				FLOAT NOT NULL,
	Estado				VARCHAR(20) NOT NULL,
	TipoComprobante		CHAR(2) NULL,
	idSerie                CHAR(3) NULL,
	Correlativo          CHAR(8) NULL,
	CHECK (Estado in ('Pendiente','Entregado','Cancelado')),
	FOREIGN KEY(NroDocCliente) REFERENCES cliente(NroDocumento)
);

ALTER TABLE pedidoVenta
ADD FOREIGN KEY R_4 (idSerie, Correlativo,TipoComprobante) REFERENCES comprobante (idSerie, Correlativo,TipoComprobante);


CREATE TABLE detallePedido(
	idPedidoVenta			INT NOT NULL,
	NroItem					INT NOT NULL,
	idProd    				INT NOT NULL,
	Cantidad             FLOAT NOT NULL,
	ValorUnitario        FLOAT NOT NULL,
	ValorVenta	         FLOAT NOT NULL,
	PrecioVenta          FLOAT NOT NULL,
	IGV                  FLOAT NULL,
	PRIMARY KEY (NroItem,idPedidoVenta),
	FOREIGN KEY (idPedidoVenta) REFERENCES pedidoVenta(idPedidoVenta),
	FOREIGN KEY (idProd) REFERENCES producto(idProd)
);

CREATE TABLE detallitos(
	idDetallitos 		 INT PRIMARY KEY AUTO_INCREMENT,
	idProd				 INT NOT NULL,
	Descrip 			 VARCHAR(40) NOT NULL,
	Cantidad             FLOAT NOT NULL,
	ValorUnitario        FLOAT NOT NULL,
	PrecioVenta          FLOAT NOT NULL
);

DELIMITER //
CREATE PROCEDURE ListarClientes()  
BEGIN
	SELECT NroDocumento, 
	CASE TipoDocumento
		WHEN "1" THEN "Persona Natural"
		WHEN "2" THEN "Persona Juridica"
	END AS TipoPersona, 
	NombreCliente,IFNULL(Direccion,'No indicado') as Direccion,
	IFNULL(Correo,'No indicado') as Correo
	FROM cliente;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE AgregarCliente(
	NroDocumento     CHAR(11),
	TipoDocumento    CHAR(1),
	NombreCliente    VARCHAR(150),
	Telefono         VARCHAR(12),
	Direccion        VARCHAR(150),
	Correo           VARCHAR(150)
)  
BEGIN
	INSERT INTO cliente VALUES(NroDocumento,TipoDocumento,NombreCliente,Telefono,Telefono,Correo);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE ListarRecibos()  
BEGIN
	SELECT C.Fecha as Fecha, 
	C.TipoComprobante as Tipo,
	C.idSerie as Serie,
	C.Correlativo as Corr,
	M.NombreCliente as Cliente, 
	C.CantPago AS Pagado, 
	C.SaldoPendiente AS Saldo
	FROM recibo_pago C INNER JOIN Comprobante O
	ON C.TipoComprobante=O.TipoComprobante AND C.idSerie=O.idSerie
	AND C.Correlativo=O.Correlativo
	INNER JOIN cliente M ON C.idEmp=M.NroDocumento;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE InsertarDetallito(
	VidProd				  INT,
	VCantidad             FLOAT,
	VDescrip			  VARCHAR(40),
	VValorUnitario        FLOAT,
	VPrecioVenta          FLOAT
)  
BEGIN
	IF EXISTS (SELECT idProd FROM Detallitos WHERE idProd=VidProd) THEN
		UPDATE Detallitos SET Cantidad=Cantidad+VCantidad, PrecioVenta=PrecioVenta+VPrecioVenta  WHERE idProd=VidProd;
	ELSE
		INSERT INTO Detallitos(idProd,Descrip,Cantidad,ValorUnitario,PrecioVenta) values(VidProd,VDescrip,VCantidad,VValorUnitario,VPrecioVenta);
	END IF;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE ListarCompCompletos()  
BEGIN

	SELECT concat(t.FirstName," ",t.LastName) AS Empleado,
	CASE TipoComprobante
		WHEN "01" THEN "FACTURA"
		WHEN "03" THEN "BOLETA"
	END AS TipoComp, 
	CONCAT(c.idSerie,'-',c.Correlativo) AS NroComp,
	L.NombreCliente as Client,m.Monedita as Mone,
	c.Estado as Estado, c.TipoPago as Pago,
	c.PrecioVentaTotal as PrecioVent, c.FechaEmision as Fecha
	FROM comprobante c INNER JOIN tblemployees t 
	on c.idEmp=t.id INNER JOIN cliente L 
	on c.NroDocCliente=L.NroDocumento INNER JOIN moneda m 
	on m.idMoneda=c.idMoneda;
	
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE InsertarComprobante(
	TipoComprobante		CHAR(2),
	idEmp				INT(11),
	idSerie             CHAR(3),
	Correlativo         CHAR(8),
	NroDocCliente       CHAR(15),
	FechaEmision        DATE,
	idMoneda            INT,
	PrecioVentaTotal	FLOAT,
	TipoPago			VARCHAR(15)
)  
BEGIN
	DECLARE ValorVentaTotal FLOAT;
	DECLARE IGVTotal FLOAT;
	DECLARE ESTADO varchar(15);
	SET ESTADO='Contado';
	IF(TipoPago='Credito') THEN
		SET ESTADO='Pendiente';
	END IF;
	SELECT SUM((ValorUnitario-(ValorUnitario*0.18))*Cantidad)
	INTO ValorVentaTotal
	FROM Detallitos;
	SELECT SUM(ValorUnitario*0.18*Cantidad)
	INTO IGVTotal
	FROM Detallitos;

	INSERT INTO Comprobante VALUES (TipoComprobante,idEmp,idSerie,Correlativo,NroDocCliente,FechaEmision,idMoneda,ValorVentaTotal,PrecioVentaTotal,IGVTotal,ESTADO,TipoPago);

END //
DELIMITER ;


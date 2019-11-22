insert into Proveedor(nomProveedor) values ('Ceramicas Mimas');
insert into Proveedor(nomProveedor) values ('Roca Sanitario S.A');

insert into Producto (codProd,nomProd,marProd,idCat,cantMin,cantTotal,precio,unidadMedida,dimensiones) values ('0001','Burdeos Caramelo','Trebol',1,30,40,16.5,'Cajas','60cm x 60cm');
insert into Producto (codProd,nomProd,marProd,idCat,cantMin,cantTotal,precio,unidadMedida,dimensiones) values ('0002','Niza Caramelo','Trebol',1,35,40,18.5,'Cajas','60cm x 60cm');
insert into Producto (codProd,nomProd,marProd,idCat,cantMin,cantTotal,precio,unidadMedida,dimensiones) values ('0003','Laminado Balsa','Trebol',1,40,45,20.5,'Cajas','60cm x 60cm');
insert into Producto (codProd,nomProd,marProd,idCat,cantMin,cantTotal,precio,unidadMedida,dimensiones) values ('0004','WC One Piece','Fanaloza',2,20,35,54.9,'Unidades','32.5 Kilogramos');
 

create table SolicitudCompra(
	idSolicitud int auto_increment primary key, 
	fechaSolicitud date not null,
	usuario int not null,
	estadoSol varchar(10),
	check (estadoSol in ('Aprobado','Rechazado','Pendiente'))
);


create table DetalleSolicitudCompra(
	idDetalleSolicitudCompra int auto_increment primary key,
	idSolicitud int null,
	idProd int not null,
	cantRequerida int not null,
	Observacion text not null,
	foreign key (idSolicitud) references SolicitudCompra(idSolicitud),
	foreign key (idProd) references Producto(idProd)
);

create table entrada_salidas (
	idTipo varchar(7) not null,
	idEntrada int not null,
	primary key(idTipo,idEntrada),
	check (idTipo in ('Entrada','Salida')),
	descripcion text
);

INSERT INTO entrada_salidas VALUES ('Entrada',1,'Entrada por Compras');
INSERT INTO entrada_salidas VALUES ('Salida',1,'Salida por Venta');

create table movimientoAlmacen (
	idMovimiento int auto_increment primary key,
	idTipo varchar(7) not null,
	idEntrada int not null,
	foreign key(idTipo,idEntrada) references entrada_salidas(idTipo,idEntrada),
	idProd int,
	costo float,
	cantidad int,
	precioVenta float,
	fecha date,
	idProveedor int,
	foreign key(idProveedor) references Proveedor(idProveedor),
	foreign key(idProd) references Producto(idProd)
);

INSERT INTO movimientoAlmacen (idTipo,idEntrada,idProd,costo,cantidad,precioVenta,fecha,idProveedor) VALUES ('Entrada',1,1,50,12,16.5,'2019/06/12',1);
INSERT INTO movimientoAlmacen (idTipo,idEntrada,idProd,costo,cantidad,precioVenta,fecha,idProveedor) VALUES ('Entrada',1,2,50,10,18.5,'2019/08/15',1);
INSERT INTO movimientoAlmacen (idTipo,idEntrada,idProd,costo,cantidad,precioVenta,fecha,idProveedor) VALUES ('Entrada',1,3,50,8,20.5,'2019/07/02',1);
INSERT INTO movimientoAlmacen (idTipo,idEntrada,idProd,costo,cantidad,precioVenta,fecha,idProveedor) VALUES ('Salida',1,4,35,10,54.9,'2019/09/10',2);



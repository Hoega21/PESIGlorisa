	
use elms;
create table cuenta(codCuenta int primary key ,descripcion varchar(70) not null);

create table subcuenta(codSubCuenta int primary key, descripcion varchar(70) not null,codCuenta int not null,foreign key (codCuenta) references cuenta(codCuenta));

create table libroM(idLibroM int primary key auto_increment,mes varchar(40),año char(4),descripcion varchar(70) not null,estado int not null);

create table asiento(nroAsiento int primary key auto_increment,correlativo int not null, descripcion varchar(70) not null,fecha datetime not null,idLibroM int not null,estado int not null, foreign key (idLibroM)references libroM(idLibroM));

create table movimiento(idMovimiento int primary key auto_increment,codCuenta int not null,importe decimal(10,2) not null,fecha datetime not null,foreign key(codCuenta) references cuenta(codCuenta));

create table tMovimiento(id int primary key auto_increment,debe decimal(10,2),haber decimal(10,2),nroAsiento int not null,codSubCuenta int not null, foreign key(nroAsiento) references asiento(nroAsiento),foreign key(codSubCuenta) references subcuenta(codSubCuenta));

create table cBalance(id int primary key auto_increment,codCuenta int not null, resultado decimal(10,2) not null,idLibroM int not null,foreign key (codCuenta) references cuenta(codCuenta),foreign key (idLibroM) references libroM(idLibroM));

create table SituacionFinanciera(id int primary key auto_increment,activoCorriente decimal(10,2),activoNoCorriente decimal(10,2), pasivoCorriente decimal(10,2),pasivoNoCorriente decimal(10,2),patrimonio decimal(10,2),idLibroM int,foreign key(idLibroM) references libroM(idLibroM));

create table sumaMovimientos(idSuma int primary key auto_increment,idLibroM int not null,codCuenta int not null,debe decimal(10,2) not null,haber decimal(10,2) not null,foreign key (idLibroM)references libroM(idLibroM),foreign key(codCuenta)references cuenta(codCuenta));

create table tasa( valor decimal (4,2) primary key);

create table UtlImp(idUtlImp int primary key auto_increment, utilidad decimal(10,2)not null,impuesto decimal(10,2) not null,idLibroM int not null,valor decimal(4,2) not null,foreign key (idLibroM) references libroM(idLibroM),foreign key (valor) references tasa(valor));


insert into cuenta values(10,"Efectivo y equivivalente de efectivo");
insert into cuenta values(12,"Cuentas por cobrar comerciales terceros");
insert into cuenta values(14,"Cuentas por Cobrar al Personal,Accionistas,etc");
insert into cuenta values(20,"Mercaderias");
insert into cuenta values(33,"Inmuebles, maquinaria y equipo");
insert into cuenta values(39,"Depreciación");
insert into cuenta values(40,"Tributos y aportes al SPP y EsSalud");
insert into cuenta values(41,"Remuneraciones y particiones por pagar");
insert into cuenta values(42,"Cuentas por pagar comerciales terceros");
insert into cuenta values(45,"Obligaciones financieras");
insert into cuenta values(46,"Cuentas por pagar diversas");
insert into cuenta values(50,"Capital");
insert into cuenta values(59,"Resultados acumulados");
insert into cuenta values(60,"Compras variacion de existencias");
insert into cuenta values(61,"Variación de existencias");
insert into cuenta values(62,"Gastos de personal, directores y gerentes");
insert into cuenta values(63,"Gastos de servicios prestaciones a terceros");
insert into cuenta values(68,"Valuacion y deteccion de activos");
insert into cuenta values(69,"Costo de ventas");
insert into cuenta values(70,"Ventas");
insert into cuenta values(79,"Cargas imputables a Cta de costos y gastos");
insert into cuenta values(94,"Gastos de administracion");
insert into cuenta values(95,"Gastos de ventas");


insert into subcuenta values(101,"Caja",10);
insert into subcuenta values(1041,"Cuentas corriente",10);
insert into subcuenta values(103,"Efectivo en transito",10);
insert into subcuenta values(1212,"Facturas, boletas,etc. por cobrar- Emitidas en cartera",12);
insert into subcuenta values(1213,"Facturas, boletas,etc. port cobrar- En cobranza",12);
insert into subcuenta values(1411,"Prestamos al personal",14);
insert into subcuenta values(2011,"Mercaderias manufacturadas",20);
insert into subcuenta values(332,"Edificaciones",33);
insert into subcuenta values(333,"Maquinarias",33);
insert into subcuenta values(3911,"Inversion Inmuebles",39);
insert into subcuenta values(4011,"IGV",40);
insert into subcuenta values(4031,"EsSalud",40);
insert into subcuenta values(4032,"ONP",40);
insert into subcuenta values(4111,"Remuneraciones por pagar",41);
insert into subcuenta values(4212,"Facturas, boletas,etc. por pagar-Emitidas en cartera",42);
insert into subcuenta values(4511,"Pagares",45);
insert into subcuenta values(4654,"Inmuebles,maquinaria,equipo",46);
insert into subcuenta values(5011,"capital",50);
insert into subcuenta values(591,"Resultados acumulados",59);
insert into subcuenta values(6011,"Mercaderias",60);
insert into subcuenta values(6111,"Mercaderias",61);
insert into subcuenta values(6211,"Sueldos",62);
insert into subcuenta values(6271,"EsSalud",62);
insert into subcuenta values(6371,"Publicidad",63);
insert into subcuenta values(6364,"Telefono",63);
insert into subcuenta values(6811,"Depreciación",68);
insert into subcuenta values(6911,"Mercaderias",69);
insert into subcuenta values(709,"Nota de credito-Devoluciones sobre ventas",70);
insert into subcuenta values(7011,"Venta de mercaderias",70);
insert into subcuenta values(79,"Cargas imputables a Cta de costos y gastos",79);
insert into subcuenta values(94,"Gastos de administracion",94);
insert into subcuenta values(95,"Gastos de ventas",95);


insert into libroM(mes,año,descripcion,estado)values("enero",2019,"Libro del mes de enero del 2019",3);


insert into asiento(correlativo,descripcion,fecha,idLibroM,estado)values(1,"Por la reapertura de operaciones del mes de enero","20190102",1,1);
insert into asiento(correlativo,descripcion,fecha,idLibroM,estado)values(2,"Por la centralizacion de compras","20190131",1,1);
insert into asiento(correlativo,descripcion,fecha,idLibroM,estado)values(3,"Por el destino de las mercaderias-Almacen","20190131",1,1);
insert into asiento(correlativo,descripcion,fecha,idLibroM,estado)values(4,"Por destino de los gastos","20190131",1,1);
insert into asiento(correlativo,descripcion,fecha,idLibroM,estado)values(5,"Por las ventas de mercaderias","20190131",1,1);
insert into asiento(correlativo,descripcion,fecha,idLibroM,estado)values(6,"Por el costo de mercaderias vendidas","20190131",1,1);
insert into asiento(correlativo,descripcion,fecha,idLibroM,estado)values(7,"Por las entradas de efectivo","20190131",1,1);
insert into asiento(correlativo,descripcion,fecha,idLibroM,estado)values(8,"Por la salida de efectivo","20190131",1,1);
insert into asiento(correlativo,descripcion,fecha,idLibroM,estado)values(9,"Por las entradas de dinero en cta cte","20190131",1,1);
insert into asiento(correlativo,descripcion,fecha,idLibroM,estado)values(10,"Por las salidas de dinero en cta cte","20190131",1,1);
insert into asiento(correlativo,descripcion,fecha,idLibroM,estado)values(11,"Por la planilla de sueldos","20190131",1,1);
insert into asiento(correlativo,descripcion,fecha,idLibroM,estado)values(12,"Por el destino de los gastos a su centro","20190131",1,1);
insert into asiento(correlativo,descripcion,fecha,idLibroM,estado)values(13,"Por la Depreciación","20190131",1,1);
insert into asiento(correlativo,descripcion,fecha,idLibroM,estado)values(14,"Por otros gastos","20190131",1,1);


insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("28000","0.00",1,101);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("20000","0.00",1,1041);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("3800","0.00",1,1212);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("63000","0.00",1,332);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("0.00","18000",1,4511);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("0.00","25750",1,4212);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("0.00","30000",1,5011);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("0.00","41050",1,591);

insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("70500","0.00",2,333);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("40000","0.00",2,6011);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("2966.10","0.00",2,6371);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("338.98","0.00",2,6364);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("20484.92","0.00",2,4011);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("0.00","51100",2,4212);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("0.00","83190",2,4654);

insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("40000","0.00",3,2011);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("0.00","40000",3,6111);	

insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("338.98","0.00",4,94);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("2966.10","0.00",4,95);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("0.00","3305.08",4,79);

insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("173400","0.00",5,1212);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("0.00","23400",5,4011);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("0.00","150000",5,7011);

insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("38000","0.00",6,6911);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("0.00","38000",6,2011);	

insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("1900","0.00",7,101);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("0.00","1900",7,1212);	

insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("1500","0.00",8,4212);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("400","0.00",8,4212);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("0.00","1900",8,101);

insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("2500","0.00",9,1041);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("0.00","1000",9,1212);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("0.00","1500",9,103);

insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("11800","0.00",10,4212);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("2500","0.00",10,1411);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("6960","0.00",10,4111);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("0.00","21260",10,1041);

insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("8000","0.00",11,6211);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("720","0.00",11,6271);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("0.00","720",11,4031);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("0.00","1040",11,4032);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("0.00","6960",11,4111);

insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("4360","0.00",12,94);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("4360","0.00",12,95);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("0.00","8720",12,79);

insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("1000","0.00",13,6811);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("0.00","1000",13,3911);	

insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("1000","0.00",14,94);
insert into tMovimiento(debe,haber,nroAsiento,codSubCuenta) values("0.00","1000",14,79);	



insert into sumaMovimientos(idLibroM,codCuenta,debe,haber)values(1,10,"52400","24660");
insert into sumaMovimientos(idLibroM,codCuenta,debe,haber)values(1,12,"177200","2900");
insert into sumaMovimientos(idLibroM,codCuenta,debe,haber)values(1,14,"2500","0.00");
insert into sumaMovimientos(idLibroM,codCuenta,debe,haber)values(1,20,"40000","38000");
insert into sumaMovimientos(idLibroM,codCuenta,debe,haber)values(1,33,"133500","0.00");
insert into sumaMovimientos(idLibroM,codCuenta,debe,haber)values(1,39,"0.00","1000");
insert into sumaMovimientos(idLibroM,codCuenta,debe,haber)values(1,40,"20484.92","25160");
insert into sumaMovimientos(idLibroM,codCuenta,debe,haber)values(1,41,"6960","6960");
insert into sumaMovimientos(idLibroM,codCuenta,debe,haber)values(1,42,"13700","76850");
insert into sumaMovimientos(idLibroM,codCuenta,debe,haber)values(1,45,"0.00","18000");
insert into sumaMovimientos(idLibroM,codCuenta,debe,haber)values(1,46,"0.00","83190");
insert into sumaMovimientos(idLibroM,codCuenta,debe,haber)values(1,50,"0.00","30000");
insert into sumaMovimientos(idLibroM,codCuenta,debe,haber)values(1,59,"0.00","41050");
insert into sumaMovimientos(idLibroM,codCuenta,debe,haber)values(1,60,"40000","0.00");
insert into sumaMovimientos(idLibroM,codCuenta,debe,haber)values(1,61,"0.00","40000");
insert into sumaMovimientos(idLibroM,codCuenta,debe,haber)values(1,62,"8720","0.00");
insert into sumaMovimientos(idLibroM,codCuenta,debe,haber)values(1,63,"3305.08","0.00");
insert into sumaMovimientos(idLibroM,codCuenta,debe,haber)values(1,68,"1000","0.00");
insert into sumaMovimientos(idLibroM,codCuenta,debe,haber)values(1,69,"38000","0.00");
insert into sumaMovimientos(idLibroM,codCuenta,debe,haber)values(1,70,"0.00","150000");
insert into sumaMovimientos(idLibroM,codCuenta,debe,haber)values(1,79,"0.00","13025.08");
insert into sumaMovimientos(idLibroM,codCuenta,debe,haber)values(1,94,"5698.98","0.00");
insert into sumaMovimientos(idLibroM,codCuenta,debe,haber)values(1,95,"7326.10","0.00");


insert into cBalance(codCuenta,resultado,idLibroM) values(10,"-27740",1);
insert into cBalance(codCuenta,resultado,idLibroM) values(12,"-174300",1);
insert into cBalance(codCuenta,resultado,idLibroM) values(14,"-2500",1);
insert into cBalance(codCuenta,resultado,idLibroM) values(20,"-2000",1);
insert into cBalance(codCuenta,resultado,idLibroM) values(33,"-133500",1);
insert into cBalance(codCuenta,resultado,idLibroM) values(39,"1000",1);
insert into cBalance(codCuenta,resultado,idLibroM) values(40,"4675.08",1);
insert into cBalance(codCuenta,resultado,idLibroM) values(41,"0",1);
insert into cBalance(codCuenta,resultado,idLibroM) values(42,"63150",1);
insert into cBalance(codCuenta,resultado,idLibroM) values(45,"18000",1);
insert into cBalance(codCuenta,resultado,idLibroM) values(46,"83190",1);
insert into cBalance(codCuenta,resultado,idLibroM) values(50,"30000",1);
insert into cBalance(codCuenta,resultado,idLibroM) values(59,"41050",1);
insert into cBalance(codCuenta,resultado,idLibroM) values(60,"-40000",1);
insert into cBalance(codCuenta,resultado,idLibroM) values(61,"40000",1);
insert into cBalance(codCuenta,resultado,idLibroM) values(62,"-8720",1);
insert into cBalance(codCuenta,resultado,idLibroM) values(63,"-3305.08",1);
insert into cBalance(codCuenta,resultado,idLibroM) values(68,"-1000",1);
insert into cBalance(codCuenta,resultado,idLibroM) values(69,"-38000",1);
insert into cBalance(codCuenta,resultado,idLibroM) values(70,"150000",1);
insert into cBalance(codCuenta,resultado,idLibroM) values(79,"13025.08",1);
insert into cBalance(codCuenta,resultado,idLibroM) values(94,"-5698.98",1);
insert into cBalance(codCuenta,resultado,idLibroM) values(95,"-7326.10",1);

insert into tasa(valor)values("1.5");

insert into UtlImp(utilidad,impuesto,idLibroM,valor)values("97490.3","1484.62",1,"1.5");

insert into SituacionFinanciera(activoCorriente,activoNoCorriente,pasivoCorriente,pasivoNoCorriente,patrimonio,idLibroM)values("206540","132500","152499.7","18000","168540.3",1)

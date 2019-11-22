create table Categoriap(
	idCat int auto_increment primary key,
	nomCat varchar(40) not null,
	descCat varchar(40) not null
);

insert into Categoriap(nomCat,descCat) values('Ceramicos','Todo tipo de ceramicos para el hogar');
insert into Categoriap(nomCat,descCat) values('Articulos de liempieza','Articulos para el baño');

-- -----------------------------------------------------
-- Table `Producto`
-- -----------------------------------------------------
create table Producto(
	idProd int auto_increment primary key,
	codProd varchar(10) not null,
	nomProd varchar(40) not null,
	marProd varchar(40) not null,
	idCat int not null,
	cantMin int not null,
	cantTotal int not null,
	url varchar(150),
	precio float,
	unidadMedida varchar(30),
	dimensiones varchar(20),
	foreign key (idCat) references Categoriap(idCat),
	check (unidadMedida in ('Unidades','Docenas','Kilogramos','Cajas'))
);


-- -----------------------------------------------------
-- Table `Proveedor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Proveedor` (
  `idProveedor` INT NOT NULL AUTO_INCREMENT,
  `rucProveedor` VARCHAR(11) NOT NULL,
  `nomProveedor` VARCHAR(50) NOT NULL,
  `dirProveedor` VARCHAR(100) NOT NULL,
  `telProveedor` VARCHAR(30) NOT NULL,
  `ciuProveedor` VARCHAR(50) NOT NULL,
  `paiProveedor` VARCHAR(50) NOT NULL,
  `corProveedor` VARCHAR(50) NOT NULL,
  `estProveedor` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`idProveedor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Ingreso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ingreso` (
  `idIngreso` INT NOT NULL AUTO_INCREMENT,
  `fecIngreso` DATE NOT NULL,
  `fecPedido` DATE NOT NULL,
  `estado` VARCHAR(20) NOT NULL,
  `totalIngreso` DECIMAL(18,2) NOT NULL,
  `factura` VARCHAR(150) NOT NULL,
  `Proveedor_idProveedor` INT NOT NULL,
  `tblemployees_id` INT(11) NOT NULL,
  PRIMARY KEY (`idIngreso`),
  INDEX `fk_Ingreso_Proveedor1_idx` (`Proveedor_idProveedor` ASC),
  INDEX `fk_Ingreso_tblemployees1_idx` (`tblemployees_id` ASC),
  CONSTRAINT `fk_Ingreso_Proveedor1`
    FOREIGN KEY (`Proveedor_idProveedor`)
    REFERENCES `Proveedor` (`idProveedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Ingreso_tblemployees1`
    FOREIGN KEY (`tblemployees_id`)
    REFERENCES `tblemployees` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DetalleIngreso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `detalleingreso` (
  `iddetalle_ingreso` INT NOT NULL AUTO_INCREMENT,
  `Ingreso_idIngreso` INT NOT NULL,
  `Producto_idProducto` INT NOT NULL,
  `cantidad` INT NOT NULL,
  `precio` DECIMAL(18,2) NOT NULL,
  PRIMARY KEY (`iddetalle_ingreso`, `Ingreso_idIngreso`, `Producto_idProducto`),
  FOREIGN KEY (`Ingreso_idIngreso`) REFERENCES `ingreso` (`idIngreso`),
  FOREIGN KEY (`Producto_idProducto`) REFERENCES `Producto` (`idProd`)
)
ENGINE = InnoDB;


CREATE PROCEDURE `proc_actualizar_proveedor` (`_ruc` VARCHAR(11), `_nombre` VARCHAR(50), `_direccion` VARCHAR(100), `_telefono` VARCHAR(30), `_ciudad` VARCHAR(50), `_pais` VARCHAR(50), `_correo` VARCHAR(50))  UPDATE `Proveedor` SET `nomProveedor`=_nombre,`dirProveedor`=_direccion,`telProveedor`=_telefono,`ciuProveedor`=_ciudad,`paiProveedor`=_pais,`corProveedor`=_correo WHERE rucProveedor=_ruc;

CREATE PROCEDURE `proc_actualizar_totalingreso` (`_idIngreso` INT, `_totaldetalle` DECIMAL(18,2))  UPDATE `ingreso` SET `totalIngreso`= `totalIngreso`+_totaldetalle WHERE idIngreso = _idIngreso;

CREATE PROCEDURE `proc_agregar_producto` (`_idIngreso` INT, `_idproducto` INT, `_cantidad` INT, `_precio` DECIMAL(18,2))  INSERT INTO `detalleingreso`(`Ingreso_idIngreso`, `Producto_idProducto`, `cantidad`, `precio`) VALUES (_idIngreso,_idproducto,_cantidad,_precio);

CREATE PROCEDURE `proc_buscar_Empleado` (IN `_emailid` VARCHAR(200), IN `_password` VARCHAR(180))  SELECT * FROM tblemployees WHERE EmailId = _emailid  and  Password = _password;

CREATE PROCEDURE `proc_buscar_Producto_Repetido` (`_idIngreso` INT, `_idproducto` INT)  SELECT * FROM `detalleingreso` WHERE iddetalle_ingreso = _idIngreso AND Producto_idProducto = _idproducto;

CREATE PROCEDURE `proc_buscar_Proveedor_Repetido` (IN `_nombre` VARCHAR(50), IN `_direccion` VARCHAR(100), IN `_RUC` VARCHAR(11))  SELECT * FROM Proveedor WHERE (nomProveedor = _nombre OR dirProveedor = _direccion OR rucProveedor = _RUC);

CREATE PROCEDURE `proc_deshabilitar_proveedor` (`_ruc` VARCHAR(11))  UPDATE `Proveedor` SET `estProveedor`='deshabilitado' WHERE rucProveedor = _ruc;

CREATE PROCEDURE `proc_registrar_ingreso` (`_fecIngreso` DATE, `_fecPedido` DATE, `_estado` VARCHAR(20), `_total` DECIMAL(18,2), `_factura` VARCHAR(50), `_idempleado` INT, `_idproveedor` INT)  INSERT INTO `ingreso`(`fecIngreso`, `fecPedido`, `estado`, `totalIngreso`, `factura`, `tblemployees_id`, `Proveedor_idProveedor`) VALUES (_fecIngreso,_fecPedido,_estado,_total,_factura,_idempleado,_idproveedor);

CREATE PROCEDURE `proc_registrar_proveedor` (`_ruc` VARCHAR(11), `_nombre` VARCHAR(50), `_direccion` VARCHAR(100), `_telefono` VARCHAR(30), `_ciudad` VARCHAR(50), `_pais` VARCHAR(50), `_correo` VARCHAR(50), `_estado` VARCHAR(50))  INSERT INTO `proveedor`(`rucProveedor`, `nomProveedor`, `dirProveedor`, `telProveedor`, `ciuProveedor`, `paiProveedor`, `corProveedor`,`estProveedor`) VALUES (_ruc,_nombre,_direccion,_telefono,_ciudad,_pais,_correo,_estado);

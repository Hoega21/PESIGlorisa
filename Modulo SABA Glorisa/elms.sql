

drop database if exists elms;
create database elms;
use elms;



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla tbldepartments
--

CREATE TABLE IF NOT EXISTS tbldepartments (
id int(11) NOT NULL,
  DepartmentName varchar(150) DEFAULT NULL,
  DepartmentShortName varchar(100) NOT NULL,
  DepartmentCode varchar(50) DEFAULT NULL,
  CreationDate timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla tbldepartments
--

INSERT INTO tbldepartments (id, DepartmentName, DepartmentShortName, DepartmentCode, CreationDate) VALUES
(1, 'Recursos Humanos', 'HR', 'HR001', '2017-11-01 12:16:25'),
(2, 'TI', 'TI', 'IT001', '2017-11-01 12:19:37'),
(3, 'Ventas', 'VT', 'OP1', '2017-12-03 02:28:56'),
(4, 'Compras', 'CP', '003223', '2018-06-26 22:02:30'),
(5, 'Redes', 'red', '032034', '2018-06-26 22:15:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla tblemployees
--

CREATE TABLE IF NOT EXISTS tblemployees (
  id int(11) NOT NULL,
  EmpId varchar(100) NOT NULL,
  FirstName varchar(150) NOT NULL,
  LastName varchar(150) NOT NULL,
  EmailId varchar(200) NOT NULL,
  Password varchar(180) NOT NULL,
  Gender varchar(100) NOT NULL,
  Dob varchar(100) NOT NULL,
  Puesto varchar(100),
  Department varchar(255) NOT NULL,
  Address varchar(255) NOT NULL,
  City varchar(200) NOT NULL,
  Country varchar(150) NOT NULL,
  Phonenumber char(11) NOT NULL,
  Status int(1) NOT NULL,
  RegDate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;




--
-- Volcado de datos para la tabla tblemployees
--

INSERT INTO tblemployees (id, EmpId, FirstName, LastName, EmailId, Password, Gender, Dob, Department, Address, City, Country, Phonenumber, Status, RegDate) VALUES
(1, 'saba', 'Jhon ', 'Saba', 'saba', '123', 'Male', '21 June, 1999', 'Recursos Humanos', 'N NEPO', 'sochi', 'IRE', '9857555554', 1, '2017-11-10 16:29:59'),
(2, 'señorita', 'Señorita Rosa', 'Alvarado', 'sanchez', '123', 'Male', '3 February, 1990', 'TI', 'N NEPO', 'NEPO', 'IRE', '8587944255', 1, '2017-11-10 18:40:02'),
(3, 'loquillo', 'Nilson', 'Delgado', 'jhon', '123', 'Male', '23 June, 2018', 'Ventas', 'av sata ana', 'cusco', 'peru', '912233454', 1, '2018-06-26 22:06:01'),
(4, 'asdasd', 'sdasasdad', 'assdaasdsdaa', 'jairo', '123', '', '30 June, 2018', 'Redes', 'santa maria', 'lima', 'peru', '932435423', 1, '2018-06-26 22:16:30');



CREATE TABLE IF NOT EXISTS usuario (
  id int(11) NOT NULL,
  UserName varchar(100) NOT NULL,
  Password varchar(100) NOT NULL,
  updationDate timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  idempleado int(11) not null
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla usuario
--

INSERT INTO usuario (id, UserName, Password, updationDate,idempleado) VALUES
(1, 'admin', '123', '2018-06-26 22:01:25',1);



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla tblleaves
--

CREATE TABLE IF NOT EXISTS tblleaves (
  id int(11) NOT NULL,
  LeaveType varchar(110) NOT NULL,
  ToDate varchar(120) NOT NULL,
  FromDate varchar(120) NOT NULL,
  Description mediumtext NOT NULL,
  PostingDate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  adminRemark mediumtext,
  adminRemarkDate varchar(120) DEFAULT NULL,
  Status int(1) NOT NULL,
  IsRead int(1) NOT NULL,
  empid int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla tblleaves
--

INSERT INTO tblleaves (id, LeaveType, ToDate, FromDate, Description, PostingDate, adminRemark,  adminRemarkDate, Status, IsRead, empid) VALUES
(7, 'Motivos externo', '30/11/2017', '29/10/2017', 'test description test descriptiontest descriptiontest descriptiontest descriptiontest descriptiontest descriptiontest description', '2017-11-19 18:11:21', 'Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.\r\n', '2017-12-02 23:26:27 ', 2, 1, 1),
(8, 'Permiso medico', '21/10/2017', '25/10/2017', 'test description test descriptiontest descriptiontest descriptiontest descriptiontest descriptiontest descriptiontest description', '2017-11-20 16:14:14', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2017-12-02 23:24:39 ', 1, 1, 1),
(9, 'Permiso medico', '08/12/2017', '12/12/2017', 'Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.\r\n', '2017-12-02 23:26:01', 'esta aprobada esta solcitud del empleado', '2018-06-26 22:47:13 ', 1, 1, 2),
(10, 'Restricted Holiday(RH)', '25/12/2017', '25/12/2017', 'Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', '2017-12-03 13:29:07', 'Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', '2017-12-03 14:06:12 ', 1, 1, 1),
(11, 'vacaciones empleados', '01/06/2018', '28/06/2018', 'permiso vaciones', '2018-06-26 22:19:43', 'aprobada por vacaciones', '2018-06-26 22:50:35 ', 1, 1, 4),
(12, 'Motivos externos', '05/11/2019', '12/11/2019', 'asdsadsasda', '2019-11-03 23:27:43', NULL, NULL, 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla tblleavetype
--

CREATE TABLE IF NOT EXISTS tblleavetype (
  id int(11) NOT NULL,
  LeaveType varchar(200) DEFAULT NULL,
  Description mediumtext,
  CreationDate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla tblleavetype
--

INSERT INTO tblleavetype (id, LeaveType, Description, CreationDate) VALUES
(1, 'Motivos externos', 'Casual Leave ', '2017-11-01 17:07:56'),
(2, 'Permiso medico', 'Medical Leave  test', '2017-11-06 18:16:09'),
(4, 'permiso salud', 'salud', '2018-06-26 22:03:29'),
(5, 'vacaciones empleados', 'vacaciones empleados', '2018-06-26 22:18:05');


CREATE TABLE IF NOT EXISTS CAPACITACIONES(
  id int(11) NOT NULL,
  tipo varchar(20) DEFAULT "General",
  tema varchar(50) NOT NULL,
  descripcion varchar(500) DEFAULT null,
  fecha varchar(50),
  lugar varchar(50),
  hora varchar(30),
  cargo int(11) not null
)ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO CAPACITACIONES(id,tipo,tema,fecha,lugar,hora,cargo) VALUES
(1,'General','Drywall','2019-11-04','Local 1 Glorisa','21:30',1);
--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla usuario
--
ALTER TABLE usuario
 ADD PRIMARY KEY (id), ADD KEY idempleado (idempleado);

--
-- Indices de la tabla tbldepartments
--
ALTER TABLE tbldepartments
 ADD PRIMARY KEY (id);

--
-- Indices de la tabla tblemployees
--
ALTER TABLE tblemployees
 ADD PRIMARY KEY (id);

--
-- Indices de la tabla tblleaves
--
ALTER TABLE tblleaves
 ADD PRIMARY KEY (id), ADD KEY UserEmail (empid);

--
-- Indices de la tabla tblleavetype
--
ALTER TABLE tblleavetype
 ADD PRIMARY KEY (id);

ALTER TABLE CAPACITACIONES
 ADD PRIMARY KEY (id) , ADD KEY cargo (cargo);


--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla usuario
--
ALTER TABLE usuario
MODIFY id int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla tbldepartments
--
ALTER TABLE tbldepartments
MODIFY id int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla tblemployees
--
ALTER TABLE tblemployees
MODIFY id int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla tblleaves
--
ALTER TABLE tblleaves
MODIFY id int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla tblleavetype
--
ALTER TABLE tblleavetype
MODIFY id int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;

ALTER TABLE CAPACITACIONES
MODIFY id int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;


ALTER TABLE usuario
  ADD CONSTRAINT usuario_ibfk_1 FOREIGN KEY (idempleado) REFERENCES tblemployees (id);


ALTER TABLE tblleaves
  ADD CONSTRAINT tblleaves_ibfk_1 FOREIGN KEY (empid) REFERENCES tblemployees (id);



ALTER TABLE CAPACITACIONES
  ADD CONSTRAINT CAPACITACIONES_ibfk_1 FOREIGN KEY (cargo) REFERENCES tblemployees (id);

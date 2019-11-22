CREATE TABLE IF NOT EXISTS capacitaciones (
  id int(11) NOT NULL,
  tipo varchar(20) DEFAULT 'General',
  tema varchar(50) NOT NULL,
  descripcion varchar(500) DEFAULT NULL,
  fecha varchar(50) DEFAULT NULL,
  lugar varchar(50) DEFAULT NULL,
  hora varchar(30) DEFAULT NULL,
  cargo int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla capacitaciones
--

INSERT INTO capacitaciones (id, tipo, tema, descripcion, fecha, lugar, hora, cargo) VALUES
(1, 'General', 'Drywall', NULL, '2019-11-04', 'Local 1 Glorisa', '21:30', 1),
(2, 'Personal', 'Madera ', 'Maderita', '2019-11-22', 'Local 2 Glorisa', '08:00 AM', 3);

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
(1, 'Recursos Humanos', 'HR', 'HR001', '2017-11-01 22:16:25'),
(2, 'TI', 'TI', 'IT001', '2017-11-01 22:19:37'),
(3, 'Ventas', 'VT', 'OP1', '2017-12-03 12:28:56'),
(4, 'Compras', 'CP', '003223', '2018-06-27 08:02:30'),
(5, 'Redes', 'red', '032034', '2018-06-27 08:15:19');

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
  Puesto varchar(100) DEFAULT NULL,
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

INSERT INTO tblemployees (id, EmpId, FirstName, LastName, EmailId, Password, Gender, Dob, Puesto, Department, Address, City, Country, Phonenumber, Status, RegDate) VALUES
(1, 'saba', 'Jhon ', 'Saba', 'saba', '123', 'Male', '22 June, 1999', 'administrador', 'Recursos Humanos', 'N NEPO', 'sochi', 'IRE', '9857555554', 1, '2017-11-11 02:29:59'),
(2, 'señorita', 'Señorita Rosa', 'Alvarado', 'sanchez', '123', 'Male', '3 February, 1990', 'desarrollador', 'TI', 'N NEPO', 'NEPO', 'IRE', '8587944255', 1, '2017-11-11 04:40:02'),
(3, 'loquillo', 'Nilson', 'Delgado', 'jhon', '123', 'Male', '23 June, 2018', 'vendedor', 'Ventas', 'av sata ana', 'cusco', 'peru', '912233454', 1, '2018-06-27 08:06:01'),
(4, 'asdasd', 'jairillo', 'bobillo', 'jairo', '123', 'Male', '18 November, 1992', 'practicante', 'Compras', 'asd', 'trux', 'Peru', '9492789741', 1, '2018-06-27 08:16:30');

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
  PostingDate datetime NOT NULL ,
  adminRemark mediumtext,
  adminRemarkDate varchar(120) DEFAULT NULL,
  Status int(1) NOT NULL,
  IsRead int(1) NOT NULL,
  empid int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla tblleaves
--

INSERT INTO tblleaves (id, LeaveType, ToDate, FromDate, Description, PostingDate, adminRemark, adminRemarkDate, Status, IsRead, empid) VALUES
(7, 'Motivos externo', '30/11/2017', '29/10/2017', 'test description test descriptiontest descriptiontest descriptiontest descriptiontest descriptiontest descriptiontest description', '2017-11-19 23:11:21', 'Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.\r\n', '2017-12-02 23:26:27 ', 2, 1, 1),
(8, 'Permiso medico', '21/10/2017', '25/10/2017', 'test description test descriptiontest descriptiontest descriptiontest descriptiontest descriptiontest descriptiontest description', '2017-11-20 21:14:14', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2017-12-02 23:24:39 ', 1, 1, 1),
(9, 'Permiso medico', '08/12/2017', '12/12/2017', 'Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.\r\n', '2017-12-03 04:26:01', 'esta aprobada esta solcitud del empleado', '2018-06-26 22:47:13 ', 1, 1, 2),
(10, 'Restricted Holiday(RH)', '25/12/2017', '25/12/2017', 'Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', '2017-12-03 18:29:07', 'Lorem Ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', '2017-12-03 14:06:12 ', 1, 1, 1),
(11, 'vacaciones empleados', '01/06/2018', '28/06/2018', 'permiso vaciones', '2018-06-27 03:19:43', 'aprobada por vacaciones', '2018-06-26 22:50:35 ', 1, 1, 4),
(12, 'Motivos externos', '05/11/2019', '12/11/2019', 'asdsadsasda', '2019-11-04 04:27:43', 'Porque es genial', '2019-11-16 3:41:51 ', 1, 1, 1);

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
(1, 'Motivos externos', 'Casual Leave ', '2017-11-02 03:07:56'),
(2, 'Permiso medico', 'Medical Leave  test', '2017-11-07 04:16:09'),
(4, 'permiso salud', 'salud', '2018-06-27 08:03:29'),
(5, 'vacaciones empleados', 'vacaciones empleados', '2018-06-27 08:18:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla tblpostulantes
--

CREATE TABLE IF NOT EXISTS tblpostulantes (
id int(11) NOT NULL,
  FirstName varchar(150) NOT NULL,
  LastName varchar(150) NOT NULL,
  Email varchar(200) NOT NULL,
  Gender varchar(100) NOT NULL,
  Dob varchar(100) NOT NULL,
  Puesto varchar(100) DEFAULT NULL,
  Department varchar(255) NOT NULL,
  Address varchar(255) NOT NULL,
  City varchar(200) NOT NULL,
  Country varchar(150) NOT NULL,
  Phonenumber char(11) NOT NULL,
  RegDate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla tblpostulantes
--

INSERT INTO tblpostulantes (id, FirstName, LastName, Email, Gender, Dob, Puesto, Department, Address, City, Country, Phonenumber, RegDate) VALUES
(1, 'Jhon ', 'Saba', 'saba@hotmail.com', 'Male', '21 June, 1999', 'administrador', 'Recursos Humanos', 'N NEPO', 'sochi', 'peru', '9857555554', '2017-11-11 02:29:59'),
(2, 'Señorita Rosa', 'Alvarado', 'sanchez@hotmail.com', 'Male', '3 February, 1990', 'desarrollador', 'TI', 'N NEPO', 'NEPO', 'peru', '8587944255', '2017-11-11 04:40:02'),
(3, 'Nilson', 'Delgado', 'jhon@hotmail.com', 'Male', '23 June, 2018', 'vendedor', 'Ventas', 'av sata ana', 'cusco', 'peru', '912233454', '2018-06-27 08:06:01'),
(4, 'jairillo', 'bobillo', 'jairo@hotmail.com', 'Male', '18 November, 1992', 'practicante', 'Compras', 'asd', 'trux', 'Peru', '9492789741', '2018-06-27 08:16:30');

-- --------------------------------------------------------
--
-- Indices de la tabla capacitaciones
--
ALTER TABLE capacitaciones
 ADD PRIMARY KEY (id), ADD KEY cargo (cargo);

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

--
-- Indices de la tabla tblpostulantes
--
ALTER TABLE tblpostulantes
 ADD PRIMARY KEY (id);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla capacitaciones
--
ALTER TABLE capacitaciones
MODIFY id int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
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
--
-- AUTO_INCREMENT de la tabla tblpostulantes
--
ALTER TABLE tblpostulantes
MODIFY id int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;

--
-- Filtros para la tabla capacitaciones
--
ALTER TABLE capacitaciones
ADD CONSTRAINT CAPACITACIONES_ibfk_1 FOREIGN KEY (cargo) REFERENCES tblemployees (id);

--
-- Filtros para la tabla tblleaves
--
ALTER TABLE tblleaves
ADD CONSTRAINT tblleaves_ibfk_1 FOREIGN KEY (empid) REFERENCES tblemployees (id);

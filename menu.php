<?php 
?>
<div class="account2">
                    <div class="image img-cir img-120">
                        <img src="images/icon/avatar-big-01.jpg" alt="John Doe" />
                    </div>
                    <h4 class="name">Usuario - <?= $_SESSION['puesto']?></h4>
                    <a href="#" onclick="modalsito('¿Estas seguro que deseas cerrar sesion?','Cerrar Sesion')">Cerrar Sesión</a>
</div>
<nav class="navbar-sidebar2">
			<ul class="list-unstyled navbar__list">
                         <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas  fa-adjust"></i>Inventario
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="./MAprovisionamiento/GestionInventario.php" target="gloricenter">
                                        <i class="fas fa-dot-circle-o"></i>Gestión de inventario</a>
                                </li>

                            </ul>
                        </li>
                        <li>
                            <a class="js-arrow" href="#">
                                <i class="fas fa-chart-bar"></i>Compras
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="./MCompras/Proveedores/Proveedores.php" target="gloricenter">
                                        <i class="fas fa-tachometer-alt"></i>Gestión Proveedores</a>
                                </li>
                                <li>
                                    <a href="./MCompras/Solicitud de Compra/SolicitudCompra.php" target="gloricenter">
                                        <i class="fas fa-tachometer-alt"></i>Gestión Solicitudes de Compra</a>
                                </li>
                                <li>
                                    <a href="./MCompras/Ordenes de Compra/OrdenesCompra.php" target="gloricenter">
                                        <i class="fas fa-tachometer-alt"></i>Gestión Ordenes de Compra</a>
                                </li>
                            </ul>

                        </li>
                        <li>
                            <a class="js-arrow" href="#">
                                <i class="fas fa-shopping-basket"></i>Ventas
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="./modulo-ventas/Clientes/MainClientes.php" target="gloricenter">
                                        Clientes</a>
                                </li>
                                <li>
                                    <a href="./modulo-ventas/Ventas/MainFactu.php" target="gloricenter">
                                        Ventas</a>
                                </li>
                                <li>
                                    <a href="./modulo-ventas/Devolucion/Devoluciones.php" target="gloricenter">
                                        Devoluciones</a>
                                </li>
                                <li>
                                    <a href="./modulo-ventas/Recibo/ListarRecibo.php" target="gloricenter">
                                        Recibo de Pago</a>
                                </li>
                            </ul>

                        </li>

                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-trophy"></i>Recursos Humanos
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="MRecursosHumanos/dashboard.php" target="gloricenter">
                                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                                </li>
                                <li class="has-sub">
                                        <a class="js-arrow" href="#">&nbsp&nbsp&nbsp
                                            <i class="fas fa-trophy"></i>Postulantes
                                            <span class="arrow">
                                                <i class="fas fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul class="list-unstyled navbar__sub-list js-sub-list">
                                            <li>
                                                <a href="MRecursosHumanos/postulantes-agregar.php" target="gloricenter">
                                                <i class="fas "></i>Agregar</a>
                                            </li>
                                            <li>
                                                <a href="MRecursosHumanos/postulantes-listar.php"  target="gloricenter">
                                                <i class="fas "></i>Administrar</a>
                                            </li>
                                         </ul>
                                </li>
                                <li class="has-sub">
                                        <a class="js-arrow" href="#">&nbsp&nbsp&nbsp
                                            <i class="fas fa-trophy"></i>Empleados
                                            <span class="arrow">
                                                <i class="fas fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul class="list-unstyled navbar__sub-list js-sub-list">
                                            <li>
                                                <a href="MRecursosHumanos/addemployee.php" target="gloricenter">
                                                <i class="fas "></i>Agregar</a>
                                            </li>
                                            <li>
                                                <a href="MRecursosHumanos/manageemployee.php"  target="gloricenter">
                                                <i class="fas "></i>Administrar </a>
                                            </li>
                                         </ul>
                                </li>

                                <li class="has-sub">
                                        <a class="js-arrow" href="#">&nbsp&nbsp&nbsp
                                            <i class="fas fa-trophy"></i>Areas
                                            <span class="arrow">
                                                <i class="fas fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul class="list-unstyled navbar__sub-list js-sub-list">
                                            <li>
                                                <a href="MRecursosHumanos/adddepartment.php" target="gloricenter">
                                                <i class="fas "></i>Agregar</a>
                                            </li>
                                            <li>
                                                <a href="MRecursosHumanos/managedepartments.php"  target="gloricenter">
                                                <i class="fas "></i>Administrar</a>
                                            </li>
                                         </ul>
                                </li>
                                <li class="has-sub">
                                        <a class="js-arrow" href="#">&nbsp&nbsp&nbsp
                                            <i class="fas fa-trophy"></i>Permisos
                                            <span class="arrow">
                                                <i class="fas fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul class="list-unstyled navbar__sub-list js-sub-list">
                                            <li>
                                                <a href="MRecursosHumanos/leaves.php" target="gloricenter">
                                                <i class="fas "></i>Todos</a>
                                            </li>
                                            <li>
                                                <a href="MRecursosHumanos/pending-leavehistory.php"  target="gloricenter">
                                                <i class="fas "></i>&nbsp&nbsp&nbsp Pendientes</a>
                                                <a href="MRecursosHumanos/approvedleave-history.php"  target="gloricenter">
                                                <i class="fas "></i>&nbsp&nbsp&nbsp Aprobados</a>
                                                <a href="MRecursosHumanos/notapproved-leaves.php"  target="gloricenter">
                                                <i class="fas "></i>&nbsp&nbsp&nbsp Rechazados</a>
                                            </li>
                                         </ul>
                                </li>
                                <li class="has-sub">
                                        <a class="js-arrow" href="#">&nbsp&nbsp&nbsp
                                            <i class="fas fa-trophy"></i>Capacitaciones
                                            <span class="arrow">
                                                <i class="fas fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul class="list-unstyled navbar__sub-list js-sub-list">
                                            <li>
                                                <a href="MRecursosHumanos/agregar-capacitaciones.php" target="gloricenter">
                                                <i class="fas "></i>&nbsp&nbsp&nbspAgregar Capacitaciones</a>
                                            </li>
                                            <li>
                                                <a href="MRecursosHumanos/todas-capacitaciones.php" target="gloricenter">
                                                <i class="fas "></i>&nbsp&nbsp&nbspTodas</a>
                                            </li>
                                            <li>
                                                <a href="MRecursosHumanos/capacitaciones-personal.php"  target="gloricenter">
                                                <i class="fas "></i>&nbsp&nbsp&nbspA personal</a>
                                                <a href="MRecursosHumanos/capacitaciones-generales.php"  target="gloricenter">
                                                <i class="fas "></i>&nbsp&nbsp&nbspGenerales</a>
                                            </li>
                                         </ul>
                                </li>
                                <li class="has-sub">
                                        <a class="js-arrow" href="#">&nbsp&nbsp&nbsp
                                            <i class="fas fa-trophy"></i>Asistencias
                                            <span class="arrow">
                                                <i class="fas fa-angle-down"></i>
                                            </span>
                                        </a>
                                        <ul class="list-unstyled navbar__sub-list js-sub-list">
                                            <li>
                                                <a href="MRecursosHumanos/agregar-asistencia.php" target="gloricenter">
                                                <i class="fas "></i>&nbsp&nbsp&nbspAgregar Agregar Asistencia </a>
                                            </li>
                                            <li>
                                                <a href="MRecursosHumanos/listar-asistencia.php" target="gloricenter">
                                                <i class="fas "></i>&nbsp&nbsp&nbspListar</a>
                                            </li>
                                         </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-box-open"></i>Mantenimiento
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
							  <li>
								<a href="MMantenimiento/#!/administrador/productos">
								  <i class="fas fa-tachometer-alt"></i>Inventario de productos
								</a>
							  </li>
							  <li>
								<a href="MMantenimiento/#!/administrador/peticiones">
								  <i class="fas fa-tachometer-alt"></i>Peticiones de mantenimiento
								</a>
							  </li>
							  <!-- <li>
								<a href="#">
								  <i class="fas fa-tachometer-alt"></i>Calendario de mantenimiento
								</a>
							  </li> -->
							  <li>
								<a href="MMantenimiento/#!/administrador/ordenes">
								  <i class="fas fa-tachometer-alt"></i>Órdenes de trabajo
								</a>
							  </li>
							</ul>
                        </li>
                         <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>Financiero
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="MFinanzas/Asiento/mainAsiento.php" target="gloricenter">
                                        <i class="fas fa-tachometer-alt"></i>Asientos</a>
                                </li>
                                <li>
                                    <a href="MFinanzas/Estados/mainEstados.php" target="gloricenter">
                                        <i class="fas fa-tachometer-alt"></i>Estados Financieros</a>
                                </li>
                                <li>
                                    <a href="MFinanzas/Devoluciones/mainDevoluciones.php" target="gloricenter">
                                        <i class="fas fa-tachometer-alt"></i>Devoluciones</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
    </nav>

<?php
?>

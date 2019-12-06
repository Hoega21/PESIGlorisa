<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Forms</title>

    <!-- Fontfaces CSS-->
    <link href="../css/font-face.css" rel="stylesheet" media="all">
    <link href="../vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="../vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="../vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="../vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="../vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="../vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="../vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="../vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="../vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="../vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="images/icon/logo.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>

        </header>
        <!-- END HEADER MOBILE-->

        <!-- PAGE CONTAINER-->
         <div class="page-container">
            
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Registro de salidas del inventario</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" class="form-horizontal">


                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="selectSm" class=" form-control-label">Tipo de salidas</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                        <select class="form-control" id="val-tipoEntrada" name="val-categorias">
                                                            <option value="#" disabled selected="">Selecionar tipo</option>
                                                            <option value="Entrada por compra">Salidas por venta</option>
                                                        
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Nombre de producto</label>
                                                </div>
                                                    <div class="col-12 col-md-9">
                                                        <?php
                                                        require ("../Conexion.php");
                                                        $con = mysqli_connect($host,$usuario,$clave,$BaseDatos);
                                                        $con->set_charset("utf8");
                                                         $res=$con->query("select * from Producto");
                                                    ?>
                                                        <select class="form-control" id="val-nameproducto" name="val-nameproducto">
                                                    <?php 
                                                        while ($row=mysqli_fetch_row($res)) {
                                                    ?>
                                                        <option value=<?php echo $row[0]; ?>><?php echo $row[2]; ?></option> 
                                                    <?php
                                                        }
                                                    ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Cantidad de salida</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="number" min="1" id="text-input" name="Cantidad" required placeholder="Cantidad a ingresar" class="form-control">
                                                </div>
                                            </div>
                                                <div class="card-footer">
                                                     <input class="btn btn-outline-primary btn-lg btn-block" type="submit" name="RegistrarSalida" value="Registrar salida">
                                                </div>
                                </form>
                                <?php 
                                        require ("../Conexion.php");
                                        $conexion = mysqli_connect($host,$usuario,$clave,$BaseDatos);
                                        if (isset($_POST['RegistrarSalida'])) {
                                            $Tipo = 'Salida';
                                            $idEntrada = 1;
                                            $idProd= $_POST['val-nameproducto'];
                                            $Cantidad=$_POST['Cantidad'];
                                            $Fecha= date("Y/m/d");

                                            $sql = $conexion->query("INSERT INTO movimientoAlmacen(idTipo,idEntrada,idProd,cantidad,fecha) VALUES ('".$Tipo."','".$idEntrada."','".$idProd."','".$Cantidad."','".$Fecha."')");
                                            $sql2=$conexion->query("UPDATE Producto set cantTotal= cantTotal -".$Cantidad." WHERE idProd='".$idProd."';");
                                            if ($sql==true and $sql2==true) {
                                                echo '<script>alert("Registro correcto");</script>';
                                            }else {
                                                echo '<script>alert("Registro incorrecto");</script>';
                                            }
                                        }
                                     ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="../vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="../vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="../vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="../vendor/slick/slick.min.js">
    </script>
    <script src="../vendor/wow/wow.min.js"></script>
    <script src="../vendor/animsition/animsition.min.js"></script>
    <script src="../vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="../vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="../vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="../vendor/circle-progress/circle-progress.min.js"></script>
    <script src="../vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="../vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="../js/main.js"></script>

</body>

</html>
<!-- end document-->

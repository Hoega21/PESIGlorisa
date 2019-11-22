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
    <link href="theme.css" rel="stylesheet" media="all">

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
         <div class="page-container" align="center">
            
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content" >
                <div class="section__content section__content--p30">
                    <div class="container-fluid"> 
                        <div >
                            <div class="col-lg-20" > 
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Listar productos</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" class="form-horizontal">

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="selectSm" class=" form-control-label">Categoria</label>
                                                </div>
                                                <div class="col-12 col-md-5">
                                                    <?php
                                                        require ("../Conexion.php");
                                                        $con = mysqli_connect($host,$usuario,$clave,$BaseDatos);
                                                        $con->set_charset("utf8");
                                                         $res=$con->query("select * from Categoriap");
                                                    ?>
                                                        <select class="form-control" id="val-categorias" name="val-categorias">
                                                    <?php 
                                                        while ($row=mysqli_fetch_row($res)) {
                                                    ?>
                                                        <option value=<?php echo $row[1]; ?>><?php echo $row[1]; ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row ">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Ingresar codigo</label>
                                                </div>
                                                <div class="col-8 col-md-5">
                                                    <input type="text" id="text-input" name="ListarProducto" required placeholder="Buscar por codigo" class="form-control" >
                                                        
                                                </div>
                                                <div class="col-1 col-md-4">
                                                    <input class="btn btn-primary" type="submit" name="BuscarProducto" value="Buscar" >
                                                </div>
                                            </div>


                                            <div >
                                                <div class="col-lg-20">
                                                    <div class="table-responsive table--no-card m-b-30">
                                                        <table class="table table-borderless table-striped table-earning" align="center">
                                                            <thead>
                                                                <tr align="center">
                                                                    <th>#</th>
                                                                    <th>Codigo</th>
                                                                    <th>Nombre</th>
                                                                    <th>Marca</th>
                                                                    <th>Categoria</th>
                                                                    <th>Stock minimo</th>
                                                                    <th>Stock total</th>
                                                                    <th>Opciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                    if (isset($_POST['BuscarProducto'])==false){
                                                                    require ("../Conexion.php");
                                                                    $con=mysqli_connect($host,$usuario,$clave,$BaseDatos);
                                                                    $con->set_charset("utf8");
                                                                    $res=$con->query("SELECT Producto.idProd,Producto.codProd,Producto.nomProd,Producto.marProd,Categoriap.nomCat,Producto.cantMin,Producto.cantTotal from Producto INNER JOIN  Categoriap on Producto.idCat=Categoriap.idCat;");
                                                                        while ($row1=mysqli_fetch_row($res)) {
                                                                 ?>
                                                                            <tr align=" center">
                                                                                <th><?php echo $row1[0]; ?></th>
                                                                                <th><?php echo $row1[1]; ?></th>
                                                                                <th><?php echo $row1[2]; ?></th>
                                                                                <th><?php echo $row1[3]; ?></th>
                                                                                <th><?php echo $row1[4]; ?></th>
                                                                                <th><?php echo $row1[5]; ?></th>
                                                                                <th><?php echo $row1[6]; ?></th>
                                                                                <th><a  href="#" onclick="modalsito('<?php echo $row1[1]; ?>','<?php echo $row1[2]; ?>','<?php echo $row1[4]; ?>','<?php echo $row1[3]; ?>','<?php echo $row1[5]; ?>')" class="btn btn-primary" >Editar</a></th>
                                                                            </tr>
                                                                 <?php            
                                                                        }

                                                                    $con->close();
                                                                }
                                                                ?>               
                                                            </tbody>
                                                            <?php
                                                                if (isset($_POST['BuscarProducto'])) { 

                                                                require ("../Conexion.php");
                                                                    $conexion = mysqli_connect($host,$usuario,$clave,$BaseDatos);
                                                                    $CodigoProducto = $_POST['ListarProducto'];
                                                                    $NomCategoria= $_POST['val-categorias'];
                                                                    $sql= $conexion->query("SELECT producto.idProd,producto.codProd,producto.nomProd,producto.marProd,categoriap.nomCat,producto.cantMin,producto.cantTotal from producto INNER JOIN  categoriap on producto.idCat=categoriap.idCat WHERE producto.codProd='".$CodigoProducto."' and categoriap.nomCat='".$NomCategoria."';");
                                                                   while ($row=mysqli_fetch_row($sql)) {
                                                                     ?>
                                                                                <tr align="center">
                                                                                    <th><?php echo $row[0]; ?></th>
                                                                                    <th><?php echo $row[1]; ?></th>
                                                                                    <th><?php echo $row[2]; ?></th>
                                                                                    <th><?php echo $row[3]; ?></th>
                                                                                    <th><?php echo $row[4]; ?></th>
                                                                                    <th><?php echo $row[5]; ?></th>
                                                                                    <th><?php echo $row[6]; ?></th>
                                                                                    <th><a  href="#" onclick="modalsito('<?php echo $row[1]; ?>','<?php echo $row[2]; ?>','<?php echo $row[4]; ?>','<?php echo $row[3]; ?>','<?php echo $row[5]; ?>')" class="btn btn-primary">Editar</a></th>
                                                                                </tr>
                                                                     <?php
                                                                     }            
                                                                }
                                                            ?>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                                                        
<?php  include('modalInfo.php'); ?>

    <script type="text/javascript">
      function modalsito(codigo,nombre,categoria,marca,cantMin) {
        $("div").find("h5").text('Editar producto');
        $(".modal-body #text-codigo").val(codigo);
        $(".modal-body #text-nombre").val(nombre);
        $(".modal-body #text-categoria").val(categoria);
        $(".modal-body #text-marca").val(marca);
        $(".modal-body #text-canMin").val(cantMin);
        
        $('#exampleModal2').modal('show');
      }
    </script>


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

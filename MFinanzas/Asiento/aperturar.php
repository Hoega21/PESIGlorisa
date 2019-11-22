<?php
session_start();
error_reporting(0);
include('../../MRecursosHumanos/includes/config.php');

if(isset($_POST['add']))
{

$mes=$_POST['mes'];   
$anio=$_POST['anio'];
$descripcion=$_POST['descripcion'];
$valorx=1;
$sql12="Select max(l.idLibroM) as maxi from librom l";
$query12 = $dbh->prepare($sql12);
$query12->execute();
$resu12=$query12->fetchAll(PDO::FETCH_OBJ);
if($query12->rowCount() > 0){
foreach($resu12 as $re12){
$vaMax=$re12->maxi;
}
$sql56="select estado from libroM where idLibroM=:id";
$query56 = $dbh->prepare($sql56);
$query56->bindParam(':id',$vaMax,PDO::PARAM_INT);
$query56->execute();
$resu56=$query56->fetchAll(PDO::FETCH_OBJ);
if($query56->rowCount() > 0){
foreach($resu56 as $re56){
$libEstado=$re56->estado;
}
}
if($libEstado==3){
  $sql="INSERT INTO libroM (mes,año,descripcion,estado) VALUES(:mes,:anio,:descripcion,:estado)";
$query = $dbh->prepare($sql);

$query->bindParam(':mes',$mes,PDO::PARAM_STR);
$query->bindParam(':anio',$anio,PDO::PARAM_STR);
$query->bindParam(':descripcion',$descripcion,PDO::PARAM_STR);
$query->bindParam(':estado',$valorx,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Libro diario creado con exito";
}
else 
{
$error="Error al crear libro diario";
}
}
else{
  $error="Tiene que guardar los estados del anterior libro";
}
}
else{
$sql="INSERT INTO libroM (mes,año,descripcion,estado) VALUES(:mes,:anio,:descripcion,:estado)";
$query = $dbh->prepare($sql);

$query->bindParam(':mes',$mes,PDO::PARAM_STR);
$query->bindParam(':anio',$anio,PDO::PARAM_STR);
$query->bindParam(':descripcion',$descripcion,PDO::PARAM_STR);
$query->bindParam(':estado',$valorx,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Libro diario creado con exito";
}
else 
{
$error="Error al crear libro diario";
}
}
}

    ?>
<!DOCTYPE html>
<html>
<head>
  <!-- Custom styles for this template -->
  <link href="../../lib/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/main.css">
  <!-- Custom styles for this page -->
  <link href="../../lib/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="../../vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
</head>
<body style="background-color: #e5e5e5">
   <div class="container-fluid">
          <!-- Page Heading -->
          <br><br>
          <h1 class="h3 mb-2 text-gray-800" align="center">Nuevo Libro Diario</h1>
          <br>
          
          <div class="card shadow mb-4">
            <div class="card-body">
              <form method="post">
              <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>ÉXITO</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
            <div class="form-group">
            <label class="control-label">Seleccione mes</label>
            <select class="form-control" id="mes" name="mes">
              <option>enero</option>
              <option>febrero</option>
              <option>marzo</option>
              <option>abril</option>
              <option>mayo</option>
              <option>junio</option>
              <option>julio</option>
              <option>agosto</option>
              <option>septiembre</option>
              <option>octubre</option>
              <option>noviembre</option>
              <option>diciembre</option>
              </select>
            </div>
            <div class="form-group label-floating">
              <label class="control-label">Escribir año</label>
              <input class="form-control" type="number" min="1900" id="anio" name="anio" required="">
            </div>
            <div class="form-group label-floating">
              <label class="control-label">Escribir una descripcion del libro</label>
              <input class="form-control" type="text" id="descripcion" name="descripcion" required="">
            </div>
              <p class="text-center">
              <button type="submit" name="add" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> GUARDAR</button>
              </p>
            </form>
                </div>
            </div>
          </div>
        </div>

   <!-- Bootstrap core JavaScript-->
  <script src="../../lib/vendor/jquery/jquery.min.js"></script>
  <script src="../../lib/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../../lib/js/sb-admin-2.min.js"></script>
      <!-- Jquery JS-->
    <script src="../../vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="../../vendor/bootstrap-4.1/bootstrap.min.js"></script>
  <!--====== Scripts -->
  <script src="../js/jquery-3.1.1.min.js"></script>
  <script src="../js/sweetalert2.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/material.min.js"></script>
  <script src="../js/ripples.min.js"></script>
  <script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="../js/main.js"></script>
  <script>
    $.material.init();
  </script>

</body>
</html>
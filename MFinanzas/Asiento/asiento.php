<?php
session_start();
error_reporting(0);
$contadorcito=intval($_GET['contador']);
include('../../MRecursosHumanos/includes/config.php');
if($contadorcito==2){
  $numerito=intval($_GET['nroAs']);
  $numb=$numerito;

  $sql81="select *from tmovimiento tm inner join asiento a on a.nroAsiento=tm.nroAsiento where tm.nroAsiento=:asie and a.estado=1 ";
  $query81 = $dbh->prepare($sql81);
  $query81->bindParam(':asie',$numb,PDO::PARAM_INT);
  $query81->execute();
  if($query81->rowCount() > 0){
    $_SESSION['array1']=$query81->fetchAll(PDO::FETCH_OBJ);
  }
}
$idLibro = $_SESSION["genial"];
$sql="select codSubCuenta from subcuenta";
$query = $dbh->prepare($sql);
$query->execute();

if (isset($_POST['actualiza'])) {
  $verificador=1;
  $idMovi=$_POST['idi'];
  $movimiento=$_POST['movimiento'];
  $habi=$_POST['habi'];
  if($contadorcito==2){
    $sq322="update asiento set estado=2 where nroAsiento=:ide";
    $query322 = $dbh->prepare($sq322);
    $query322->bindParam(':ide',$numb,PDO::PARAM_INT);
    $query322->execute();
  }
  if($movimiento=="Debe"){
    $sq44="update tMovimiento set debe=:deber ,haber='0.00' where id=:ide";
    $query44 = $dbh->prepare($sq44);
    $query44->bindParam(':deber',$habi,PDO::PARAM_STR);
    $query44->bindParam(':ide',$idMovi,PDO::PARAM_INT);
    $query44->execute();
  }
  else{
    $sq44="update tMovimiento set debe='0.00' ,haber=:haber where id=:ide";
    $query44 = $dbh->prepare($sq44);
    $query44->bindParam(':haber',$habi,PDO::PARAM_STR);
    $query44->bindParam(':ide',$idMovi,PDO::PARAM_INT);
    $query44->execute();
  }
$sql222="select nroAsiento from tMovimiento where id=:ide";
$query222 = $dbh->prepare($sql222);
$query222->bindParam(':ide',$idMovi,PDO::PARAM_INT);
$query222->execute();
$rest22=$query222->fetchAll(PDO::FETCH_OBJ);
foreach($rest22 as $resa22){
$numb=$resa22->nroAsiento;
}
$contadorcito++;
}
if (isset($_POST['eliminar'])) {
  $verificador=1;
$idd=$_POST['idd'];
  if($contadorcito==2){
    $sq322="update asiento set estado=2 where nroAsiento=:ide";
    $query322 = $dbh->prepare($sq322);
    $query322->bindParam(':ide',$numb,PDO::PARAM_INT);
    $query322->execute();
  }
$sql111="select nroAsiento from tMovimiento where id=:ide";
$query111 = $dbh->prepare($sql111);
$query111->bindParam(':ide',$idd,PDO::PARAM_INT);
$query111->execute();
$rest111=$query111->fetchAll(PDO::FETCH_OBJ);
foreach($rest111 as $resa111){
$numb=$resa111->nroAsiento;
}

$sq123="delete from tMovimiento where id=:ide";
$query123 = $dbh->prepare($sq123);
$query123->bindParam(':ide',$idd,PDO::PARAM_INT);
$query123->execute();

$contadorcito++;
}

if(isset($_POST['add']))
{
  $verificador=1;
$monto=$_POST['monto'];
$movimiento=$_POST['movimiento'];
$cuenta=$_POST['cuenta'];
$descripcion=$_POST['descripcion'];
$anio = date("Y");
$mes=date("m");
$dia=date("d");
$fecha=$anio.$mes.$dia;
  if($contadorcito==2){
    $sq322="update asiento set estado=2 where nroAsiento=:ide";
    $query322 = $dbh->prepare($sq322);
    $query322->bindParam(':ide',$numb,PDO::PARAM_INT);
    $query322->execute();
  }
if($movimiento=="Debe"){
$debe=$monto;
$haber="";
}
else{
$debe="";
$haber=$monto;
}
$sqll="select max(correlativo) as max from asiento where idLibroM=:idLib";
$query1 = $dbh->prepare($sqll);
$query1->bindParam(':idLib',$idLibro,PDO::PARAM_INT);
$query1->execute();
$resu=$query1->fetchAll(PDO::FETCH_OBJ);
if($query1->rowCount() > 0){
foreach($resu as $re){
$re->max;
}
$correlativo=$re->max +1;
}
else{
$correlativo=1;
}
if($descripcion==""){
}
else{
$sql1="INSERT INTO asiento(correlativo,descripcion,fecha,idLibroM,estado) VALUES(:correlativo,:descripcion,:fecha,:idLibroM,2) ";
$query2 = $dbh->prepare($sql1);
$query2->bindParam(':correlativo',$correlativo,PDO::PARAM_INT);
$query2->bindParam(':descripcion',$descripcion,PDO::PARAM_STR);
$query2->bindParam(':fecha',$fecha,PDO::PARAM_STR);
$query2->bindParam(':idLibroM',$idLibro,PDO::PARAM_INT);
$query2->execute();
}
if($contadorcito==1){
$sql3="select max(nroAsiento) as maxi from asiento where idLibroM=:idLib";
$query4 = $dbh->prepare($sql3);
$query4->bindParam(':idLib',$idLibro,PDO::PARAM_INT);
$query4->execute();
$rest=$query4->fetchAll(PDO::FETCH_OBJ);
foreach($rest as $resa){
$resa->maxi;
}
$numb=$resa->maxi;
}
$sql2="INSERT INTO tMovimiento (debe,haber,nroAsiento,codSubCuenta) VALUES(:debe,:haber,:numero,:codi)";
$query3 = $dbh->prepare($sql2);
$query3->bindParam(':debe',$debe,PDO::PARAM_STR);
$query3->bindParam(':haber',$haber,PDO::PARAM_STR);
$query3->bindParam(':numero',$numb,PDO::PARAM_INT);
$query3->bindParam(':codi',$cuenta,PDO::PARAM_INT);
$query3->execute();

$contadorcito++;
}


if (isset($_POST['guarda'])) {
    $asie=$_POST['asie'];

  if($contadorcito==2){
    $resu811=$_SESSION['array1'];
  foreach($resu811 as $re800){
      $cuenta12=$re800->codSubCuenta;
      $debe12=$re800->debe;
      $haber12=$re800->haber;

      $sql77="select c.codCuenta from cuenta c INNER join subcuenta s on s.codCuenta=c.codCuenta where s.codSubCuenta=:codi";
      $query77 = $dbh->prepare($sql77);
      $query77->bindParam(':codi',$cuenta12,PDO::PARAM_INT);
      $query77->execute();
      $resu77=$query77->fetchAll(PDO::FETCH_OBJ);
      foreach($resu77 as $re107){
      $codigoC7=$re107->codCuenta;
      }

      $sql87="select s.debe, s.haber from sumaMovimientos s where s.idLibroM=:idLib and s.codCuenta=:codi";
      $query87 = $dbh->prepare($sql87);
      $query87->bindParam(':idLib',$idLibro,PDO::PARAM_INT);
      $query87->bindParam(':codi',$codigoC7,PDO::PARAM_INT);
      $query87->execute();
      $resu87=$query87->fetchAll(PDO::FETCH_OBJ);
      if($query87->rowCount() > 0){
      foreach($resu87 as $re127){
      $debe127=$re127->debe;
      $haber127=$re127->haber;
      }   
      $debe137=$debe127-$debe12;
      $haber137=$haber127-$haber12;

      $sql97="update sumaMovimientos set debe=:debe,haber=:haber where codCuenta=:codi and idLibroM=:idLib";
      $query97 = $dbh->prepare($sql97);
      $query97->bindParam(':debe',$debe137,PDO::PARAM_STR);
      $query97->bindParam(':haber',$haber137,PDO::PARAM_STR);
      $query97->bindParam(':codi',$codigoC7,PDO::PARAM_INT);
      $query97->bindParam(':idLib',$idLibro,PDO::PARAM_INT);
      $query97->execute();
      }
    }
  }

$sql71="select *from tmovimiento tm inner join asiento a on a.nroAsiento=tm.nroAsiento where tm.nroAsiento=:asie and a.estado=2 ";
$query71 = $dbh->prepare($sql71);
$query71->bindParam(':asie',$asie,PDO::PARAM_INT);
$query71->execute();
$resu71=$query71->fetchAll(PDO::FETCH_OBJ);
foreach($resu71 as $re101){
$cuenta=$re101->codSubCuenta;
$debe=$re101->debe;
$haber=$re101->haber;


$sql7="select c.codCuenta from cuenta c INNER join subcuenta s on s.codCuenta=c.codCuenta where s.codSubCuenta=:codi";
$query7 = $dbh->prepare($sql7);
$query7->bindParam(':codi',$cuenta,PDO::PARAM_INT);
$query7->execute();
$resu7=$query7->fetchAll(PDO::FETCH_OBJ);
foreach($resu7 as $re10){
$codigoC=$re10->codCuenta;
}

$sql8="select s.debe, s.haber from sumaMovimientos s where s.idLibroM=:idLib and s.codCuenta=:codi";
$query8 = $dbh->prepare($sql8);
$query8->bindParam(':idLib',$idLibro,PDO::PARAM_INT);
$query8->bindParam(':codi',$codigoC,PDO::PARAM_INT);
$query8->execute();
$resu8=$query8->fetchAll(PDO::FETCH_OBJ);
if($query8->rowCount() > 0){
foreach($resu8 as $re12){
$debe12=$re12->debe;
$haber12=$re12->haber;
}
$debe13=$debe12+$debe;
$haber13=$haber12+$haber;
$sql9="update sumaMovimientos set debe=:debe,haber=:haber where codCuenta=:codi and idLibroM=:idLib";
$query9 = $dbh->prepare($sql9);
$query9->bindParam(':debe',$debe13,PDO::PARAM_STR);
$query9->bindParam(':haber',$haber13,PDO::PARAM_STR);
$query9->bindParam(':codi',$codigoC,PDO::PARAM_INT);
$query9->bindParam(':idLib',$idLibro,PDO::PARAM_INT);
$query9->execute();
}
else{
$sql9="insert into sumaMovimientos(idLibroM,codCuenta,debe,haber)values(:idLib,:codi,:debe,:haber)";
$query9 = $dbh->prepare($sql9);
$query9->bindParam(':idLib',$idLibro,PDO::PARAM_INT);
$query9->bindParam(':codi',$codigoC,PDO::PARAM_INT);
$query9->bindParam(':debe',$debe,PDO::PARAM_STR);
$query9->bindParam(':haber',$haber,PDO::PARAM_STR);
$query9->execute();
}
}


    $sq32="update asiento set estado=1 where nroAsiento=:ide";
    $query32 = $dbh->prepare($sq32);
    $query32->bindParam(':ide',$asie,PDO::PARAM_INT);
    $query32->execute();
    echo "<script>parent.location = 'mainAsiento.php';</script>";
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
          <h1 class="h3 mb-2 text-gray-800" align="center">Asiento</h1>
          <br>
          
          <div class="card shadow mb-4">
            <div class="card-body">
               <div class="table-responsive">
                <?php if($contadorcito>1){ ?>
                  <table class="table table-hover text-center">
                    <thead >
                      <tr>
                        <td colspan="2"> CUENTA CONTABLE</td>
                        <td colspan="2"> MOVIMIENTO</td>
                        <td colspan="2">OPCIONES</td>
                      </tr>
                      <tr>
                        <td>Codigo</td>
                        <td>Cuenta-Subcuenta</td>
                        <td>Debe</td>
                        <td>Haber</td>
                        <td>Editar</td>
                        <td>Eliminar</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $sql4="select t.id, t.codSubCuenta,c.descripcion,t.debe,t.haber from tMovimiento t INNER join subcuenta c on c.codSubCuenta=t.codSubCuenta where nroAsiento=:numas";
                            $query5 = $dbh->prepare($sql4);
                            $query5->bindParam(':numas',$numb,PDO::PARAM_INT);
                            $query5->execute();
                            $r21=$query5->fetchAll(PDO::FETCH_OBJ);
                            $c=1;
                            if($query5->rowCount() > 0){
                            foreach($r21 as $r22)
                              {
                                $id1=$r22->id;
                              $codSubCuenta1=$r22->codSubCuenta;
                              $descripcion1=$r22->descripcion;
                              $debe1=$r22->debe;
                              $haber1=$r22->haber;
                              $sumaDebe=$sumaDebe+$debe1;
                              $sumaHaber=$sumaHaber+$haber1;
                              $datos=$id1."||".$codSubCuenta1."||".$descripcion1."||".$debe1."||".$haber1;
                                ?>
                                <tr>
                                  <td><?php echo htmlentities($r22->codSubCuenta);?></td>
                                  <td><?php echo htmlentities($r22->descripcion);?></td>
                                  <td><?php echo htmlentities($r22->debe);?></td>
                                  <td><?php echo htmlentities($r22->haber);?></td>
                                  <td><button type="submit" class="btn btn-info btn-raised btn-sm" data-toggle="modal" data-target="#miModal" onclick="agregarDatos('<?php echo htmlentities($datos);?>')"><i class="zmdi zmdi-floppy"></i> Editar </button></td>
                                  <td><form method="post"><input type="text"  name="idd" value="<?php echo($id1) ?>" style="border: none;color: white; width: 2px;" ><button type="submit" name="eliminar">Eliminar</button></form></td>
                                </tr><?php $c++;} } ?>
                    </tbody>
                  </table>
                  <?php }?>
            <form action="" method="post">
              <?php
              if($contadorcito==1){ ?>
              <div class="form-group label-floating">
              <label class="control-label">Escribir descripcion del asiento</label>
              <input class="form-control" type="text"  id="descripcion" name="descripcion" required="">
            </div>
              <?php }
              else{
                if($sumaDebe=="null" && $sumaHaber=="null"){
                  ?>
                  <label >Necesita ingresar cuentas</label>
                  <?php 
                }
                else if($sumaDebe>$sumaHaber){
                  $faltante=$sumaDebe-$sumaHaber;
                  ?>
                  <label >Para que este balanceado este asiento debe ingresar en el haber <?php echo($faltante);?></label>
                  <?php
                }
                else if($sumaHaber>$sumaDebe){
                  $faltante=$sumaHaber-$sumaDebe;
                  ?>
                  <label >Para que este balanceado este asiento debe ingresar en el debe <?php echo($faltante);?></label>
                  <?php
                }
                else{
                  ?>
                  <label>Si desea puede guardar el asiento</label>
                  <form method="post">
                    <input type="text" name="asie" style="color: white; border: none;" value="<?php echo($numb); ?>" ><br>
                    <button type="submit" name="guarda" class="btn btn-info btn-raised btn-sm">GUARDAR</button>
                  </form>
                  <?php
                }
              }?>
            <div class="form-group">
            <label class="control-label">Seleccione Cuenta-Subcuenta</label>
            <select class="form-control" id="cuenta" name="cuenta">
              <?php $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                    foreach($results as $result)
                  {
               ?>
              <option><?php echo htmlentities($result->codSubCuenta);?></option><?php $cnt++; }}?>
              </select>
            </div>
            <div class="form-group">
            <label class="control-label">Seleccione movimiento</label>
            <select class="form-control" id="movimiento" name="movimiento">
            <option>Debe</option>
            <option>Haber</option>
            </select>
            </div>
            <div class="form-group label-floating">
              <label class="control-label">Escribir monto</label>
              <input class="form-control" type="number" step="any" min="1" id="monto" name="monto" required="">
            </div>
              <p class="text-center">
              <button type="submit" name="add" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> AGREGAR</button>
              </p>
            </form>
                </div>
            </div>
          </div>
        </div>


<!-- MODAL -->
<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <h4 class="modal-title" id="myModalLabel" align="center">Actualizar Datos</h4>
      <div class="modal-body">
        <form method="post">
          <input type="tex" name="idi" id="idi" readonly="" style="border: none;color: white;" >
        <div class="form-group label-floating">
              <label>Cuenta:</label>
              <input class="form-control" type="text" id="cuentita" name="cuentita" readonly="readonly">
        </div>
        <div class="form-group label-floating">
              <label>Descripción:</label>
              <input class="form-control" type="text" id="descrip" name="descrip" readonly="readonly">
        </div>
        <label class="control-label">Seleccione movimiento</label>
        <select class="form-control" id="movimiento" name="movimiento">
            <option>Debe</option>
            <option>Haber</option>
        </select>
        <div class="form-group label-floating">
              <label>Monto:</label>
              <input class="form-control" type="number" step="any" min="1" id="habi" name="habi" required="">
        </div>
              <p class="text-center">
              <button type="submit" name="actualiza" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Actualizar</button>
              </p>
            </form>
      </div>
    </div>
  </div>
</div>

<!-- End Modal -->

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
    function agregarDatos(datos){
      d=datos.split('||');
      $('#idi').val(d[0]);
      $('#cuentita').val(d[1]);
      $('#descrip').val(d[2]);
      if(d[3]>0){
        $('#habi').val(d[3]);
      }
      else{
      $('#habi').val(d[4]);}
    }
  </script>

</body>
</html>
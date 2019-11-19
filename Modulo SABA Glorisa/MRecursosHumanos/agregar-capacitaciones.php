<?php
session_start();
error_reporting(0);
include('includes/config.php');
/*
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{

*/


if(isset($_POST['add']))
{

$tipo=$_POST['tipo'];   
$tituloCapacitacion=$_POST['tituloCapacitacion'];
$descripcion=$_POST['descripcion'];
$fecha=$_POST['fecha'];   
$lugar=$_POST['lugar'];  
$hora=$_POST['hora'];  
$cargo=$_POST['cargo'];  

$sql="INSERT INTO capacitaciones (tipo,tema,descripcion,fecha,lugar,hora,cargo) VALUES(:tipo,:tituloCapacitacion,:descripcion,:fecha,:lugar,:hora,:cargo)";
$query = $dbh->prepare($sql);

$query->bindParam(':tipo',$tipo,PDO::PARAM_STR);
$query->bindParam(':tituloCapacitacion',$tituloCapacitacion,PDO::PARAM_STR);
$query->bindParam(':descripcion',$descripcion,PDO::PARAM_STR);
$query->bindParam(':fecha',$fecha,PDO::PARAM_STR);
$query->bindParam(':lugar',$lugar,PDO::PARAM_STR);
$query->bindParam(':hora',$hora,PDO::PARAM_STR);
$query->bindParam(':cargo',$cargo,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Capacitacion creada con exito";
}
else 
{
$error="Something went wrong. Please try again";
}

}

    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Agregar departamento</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet"> 
        <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
  <style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
        </style>
    </head>
    <body>
            <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title">Agregar Capacitaciones</div>
                    </div>
                    <div class="col s12 m12 l6">
                        <div class="card">
                            <div class="card-content">
                              
                                <div class="row">
                                    <form class="col s12" name="chngpwd" method="post">
                                          <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>ÉXITO</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                                        <div class="row">
                     <div class="input-field col s12">
                    <select  name="tipo" autocomplete="off">
                    <option value="">Tipo Capacitacion</option>                                          
                    <option value="General">Publico General</option>
                    <option value="Personal">Personal de Glorisa</option>
                    </select>
                    </div>                                   
                    
                    <div class="input-field col s12">
                        <input id="tituloCapacitacion" type="text"  class="validate" autocomplete="off" name="tituloCapacitacion"  required>
                        <label for="deptname">Titulo de la Capacitacion</label>
                    </div>


          <div class="input-field col s12">
<input id="descripcion" type="text"  class="validate" autocomplete="off" name="descripcion"  required>
                                                <label for="deptshortname">Descripción</label>
                                            </div>
  <div class="input-field col s12">
 <input id="lugar" type="text" name="lugar" class="validate" autocomplete="off" required>
                                                <label for="password">Lugar</label>
                                            </div>

<div class="input-field col m6 s12">
<label for="birthdate">Fecha</label><br>
<input id="fecha" name="fecha" type="date" class="datepicker" autocomplete="off" >
</div>

  <div class="input-field col s12">
 <input id="hora" type="text" name="hora" class="validate" autocomplete="off" required>
                                                <label for="password">Hora</label>
                                            </div>

<div class="input-field col m6 s12">
    <label for="password">Empleado a cargo</label><br><br>
<select  name="cargo" autocomplete="off">
<option value="<?php echo htmlentities($result->Department);?>"><?php echo htmlentities($result->Department);?></option>
<?php $sql = "SELECT id,EmpId from tblemployees";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $resultt)
{   ?>                                            
<option value="<?php echo htmlentities($resultt->id);?>"><?php echo htmlentities($resultt->EmpId);?></option>
<?php }} ?>
</select>
</div>
<div class="input-field col s12">
<button type="submit" name="add" class="waves-effect waves-light btn indigo m-b-xs">AÑADIR</button>

</div>




                                        </div>
                                       
                                    </form>
                                </div>
                            </div>
                        </div>
                     
             
                   
                    </div>
                
                </div>
            </main>

        </div>
        <div class="left-sidebar-hover"></div>
        
        <!-- Javascripts -->
        <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/alpha.min.js"></script>
        <script src="assets/js/pages/table-data.js"></script>
        
    </body>
</html>
<?php // } ?>
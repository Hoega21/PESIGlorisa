<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json; charset=UTF-8');

  $response = [];
  $json_array = array();
  // $data = json_decode(file_get_contents("php://input"));
  //RECIBE VARIABLES
  $id = $_GET['id'];
  $descripcion = $_GET['descripcion'];
  $fechaPrevista = $_GET['fechaPrevista'];
  $prioridad = $_GET['prioridad'];
  $nota = $_GET['nota'];

  // $username = mysqli_real_escape_string($con, $data->username);
  $con = mysqli_connect('127.0.0.1', 'root', '', 'pesi_mantenimiento') or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
  //
  $tildes = $con->query("SET NAMES 'utf8'"); //Para que se muestren las tildes correctamente
  //
  $query = "update peticion set descripcion = upper('$descripcion'), nota = upper('$nota'), prioridad = '$prioridad', fechaPrevista = '$fechaPrevista' where id = '$id'";
  // echo json_encode("$query");
  try {
    $result = mysqli_query($con, $query) or die ( "Algo ha ido mal en la consulta a la base de datos");
    echo json_encode("HECHO SIN ERRORES");
  } catch (\Exception $e) {
    echo json_encode("$e.");
  }
?>

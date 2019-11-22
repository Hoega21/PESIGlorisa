<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json; charset=UTF-8');

  $response = [];
  $json_array = array();
  // $data = json_decode(file_get_contents("php://input"));
  //RECIBE VARIABLES
  $serie = $_GET['serie'];
  $codigo = $_GET['codigo'];
  $asunto = $_GET['asunto'];
  $generadaX = $_GET['generadaX'];
  $presupuesto = $_GET['presupuesto'];

  // $username = mysqli_real_escape_string($con, $data->username);
  $con = mysqli_connect('sql10.freesqldatabase.com', 'sql10313127', 'ruVDugdGr1', 'sql10313127') or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
  // echo json_encode($query);
  $tildes = $con->query("SET NAMES 'utf8'"); //Para que se muestren las tildes correctamente
  // $query = "select * from usuarios where NombreUsuario = '$username' and PassUsuario = '$password'";

  $query = "insert into ordentrabajo values (uuid(), '$serie', '$codigo', upper('$asunto'), concat('$codigo',' ',upper('$asunto')), now(), '$generadaX', '$presupuesto', 0, 0, 1)";
  // echo json_encode("$query");
  //
  try {
    $result = mysqli_query($con, $query) or die ( "Algo ha ido mal en la consulta a la base de datos");
    echo json_encode("HECHO SIN ERRORES");
  } catch (\Exception $e) {
    echo json_encode("$e.");
  }
?>

<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json; charset=UTF-8');

  $response = [];
  $json_array = array();
  // $data = json_decode(file_get_contents("php://input"));
  $categoria = $_GET['idCategoria'];
  $con = mysqli_connect('70.38.123.185:3306', 'wssac_prueba', 'qweasdzxc123', 'wssac_prueba') or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
  // $username = mysqli_real_escape_string($con, $data->username);

  $tildes = $con->query("SET NAMES 'utf8'"); //Para que se muestren las tildes correctamente
  $query = "select serie from equipo where idCategoria = '$categoria' and estado = 1 limit 1";
  //
  $result = mysqli_query($con, $query) or die ( "Algo ha ido mal en la consulta a la base de datos");
  // //
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){
      $json_array = $row;
    }
    echo (json_encode($json_array));
  } else {
    $response['status'] = "Error";
    echo json_encode($response);
  }
?>

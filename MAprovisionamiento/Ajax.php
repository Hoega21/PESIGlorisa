<?php 
    require ("../Conexion.php");
    $conexion = mysqli_connect($host,$usuario,$clave,$BaseDatos);
    session_start();
    $idSolicitud=  $_SESSION['puchis'];
    $idProducto= $_POST['CodProducto'];
    $CantidaRequerida= $_POST['CantReq'];
    $Observacion= $_POST['Observ'];
    $fechaActual=date("Y/m/d");
    $estado='Pendiente';


    if ($_SESSION['Lian']==1){
        $sql = $conexion->query("INSERT INTO DetalleSolicitudCompra (idSolicitud,idProd,cantRequerida,Observacion) VALUES ('".$idSolicitud."','".$idProducto."','".$CantidaRequerida."','".$Observacion."')");

    }else{
        $sql2 = $conexion->query("INSERT INTO SolicitudCompra (fechaSolicitud,estadoSol) values ('".$fechaActual."','".$estado."')");
        $sql = $conexion->query("INSERT INTO DetalleSolicitudCompra (idSolicitud,idProd,cantRequerida,Observacion) VALUES ('".$idSolicitud."','".$idProducto."','".$CantidaRequerida."','".$Observacion."')");
        $_SESSION['Lian']=1;
    }
    echo 'Holi';                                        
?>

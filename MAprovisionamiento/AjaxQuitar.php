<?php 
    require ("../Conexion.php");
    $conexion = mysqli_connect($host,$usuario,$clave,$BaseDatos);
    session_start();
    $idDetalleSolicitud=  $_POST['idDetallitos'];

    $sql = $conexion->query("DELETE FROM DetalleSolicitudCompra where idDetalleSolicitudCompra='".$idDetalleSolicitud."';");
    echo 'Holi';                                        
?>
<table class="table table-borderless table-striped table-earning" align="center">
                                                            <thead>
                                                                <tr align="center">
                                                                    <th>#</th>
                                                                    <th>Producto</th>
                                                                    <th>Cantida</th>
                                                                    <th>Descripción</th>
                                                                    <th>Opciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                session_start();
                                                                    require ("../Conexion.php");
                                                                    $con = mysqli_connect($host,$usuario,$clave,$BaseDatos);
                                                                    $con->set_charset("utf8");
                                                                    $res=$con->query("SELECT idDetalleSolicitudCompra,nomProd,cantRequerida,Observacion FROM DetalleSolicitudCompra inner JOIN Producto on 
                                                                    Producto.idProd=DetalleSolicitudCompra.idProd where idSolicitud='".$_SESSION['puchis']."';");
                                                                        while ($row1=mysqli_fetch_row($res)) {
                                                                 ?>
                                                                            <tr align=" center" style="font-size: 11px">
                                                                                <th><?php echo $row1[0]; ?></th>
                                                                                <th ><?php echo $row1[1]; ?></th>
                                                                                <th><?php echo $row1[2]; ?></th>
                                                                                <th><?php echo $row1[3]; ?></th>
                                                                                <td><span onclick="EliminarDetalle(<?php echo $row1[0]; ?>)" class="btn btn-primary">Quitar</span></td>
                                                                            </tr>
                                                                 <?php            
                                                                        }

                                                                ?>               
                                                            </tbody>
                                                        </table>

<script type="text/javascript">
    function EliminarDetalle(quitar){
        var parametros = { 
        "idDetallitos" : quitar
    };
        $.ajax({
            data:  parametros,
            url:   'AjaxQuitar.php', 
            type:  'post', //método de envio
            success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
            $('#tablita').load('tablatemp.php');
            }
        });
    }
</script>
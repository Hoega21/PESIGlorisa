<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" >Modal title</h5>
      </div>
      <form method="post">
      <div class="modal-body">
          <div class="row form-group">
              <div class="col col-md-3">
              <label for="text-input" class=" form-control-label">Codigo</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-codigo" name="text-codigo"  readonly class="form-control">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Nombre</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-nombre" name="text-nombre" class="form-control">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="selectSm" class=" form-control-label">Categoria</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-categoria" name="text-categoria"  disabled="" class="form-control">
                                                </div>
                                              
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Marca</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-marca" name="text-marca" class="form-control">
                                                </div>
                                            </div>
                                             <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Cantidad mínima</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-canMin" name="text-canMin"  class="form-control">
                                                </div>
                                            </div>
                             
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <input class="btn btn-primary" type="submit" name="ModificarProducto" value="Confirmar" >
      </div>
      </form>
                                      <?php 
                                          require ("../Conexion.php");
                                          $conexion = mysqli_connect($host,$usuario,$clave,$BaseDatos);
                                           if (isset($_POST['ModificarProducto'])) {
                                            $NombreProd= $_POST['text-nombre'];
                                            $MarcaProd= $_POST['text-marca'];
                                            $CantidadProd = $_POST['text-canMin'];
                                            $codigo=$_POST['text-codigo'];

                                            $sql= $conexion->query("UPDATE Producto SET nomProd ='".$NombreProd."', marProd='".$MarcaProd."', cantMin=".$CantidadProd." WHERE codProd ='".$codigo."';");
                                            if ($sql) {
                                                        echo '<script>alert("Modificación correcta");</script>';                                               
                                            }
                                            else {
                                                    echo '<script>alert("Modificacion incorrecta");</script>';
                                                } 
                                        }
                                     ?>                                                                
    </div>
  </div>
</div>
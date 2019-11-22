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
                                                    <label for="text-input" class=" form-control-label">Tipo Cliente</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-tipo" name="text-tipo" class="form-control" disabled="">
                                                </div>
                                            </div>

                                           
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="nro" class=" form-control-label">Nro Documento</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="nro" name="nro" class="form-control">
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-nombre" class=" form-control-label">Nombre Completo</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-nombre" name="text-nombre" class="form-control">
                                                </div>
                                            </div>
                                             <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-correo" class=" form-control-label">Correo</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-correo" name="text-correo"  class="form-control">
                                                </div>
                                            </div>
                                             <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-direc" class=" form-control-label">Direccion</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-direc" name="text-direc"  class="form-control">
                                                </div>
                                            </div>
                             
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <input class="btn btn-primary" type="submit" name="ModificarProducto" value="Confirmar" >
      </div>
      </form>
                                                                                                    
    </div>
  </div>
</div>
                                     <?php 
                                           if(isset($_POST["ModificarProducto"])){
                                            Clientes::ActualizarCliente($_POST['text-nombre'],$_POST['text-direc'],$_POST['text-correo'],$_POST['nro']);
                                        }
                                     ?>  
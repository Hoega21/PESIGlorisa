<!DOCTYPE html>
<html>
<head>
  <!-- Custom styles for this template -->
  <link href="../lib/css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Custom styles for this page -->
  <link href="../lib/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body style="background-color: #e5e5e5">
   <div class="container-fluid">
          <!-- Page Heading -->
          <br><br>
          <h1 class="h3 mb-2 text-gray-800 " align="center"  ><i>Agregar Cliente</i></h1>
          <br>
          
          <div class="card shadow mb-4">
            <div class="card-body">
               <div class="p-5">
                  <form class="user">
                    <div class="form-group row">
                      <label for="NameUser" class="col-sm-2 col-form-label" >Tipo Cliente: </label>
                      <div class="col-sm-10">
                       <select id="Tip-Cliente" name="Tip-Cliente" class="form-control " onchange="TypeClient();">
                         <option value="PN" >Persona Natural</option>
                         <option value="PJ" >Persona Juridica</option>
                      </select>
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="CliDni" class="col-sm-2 col-form-label" name="LCliDni" id="LCliDni" >DNI:  </label>
                      <div class="col-sm-10">
                          <input type="text" name="CliDni" id="CliDni" maxlenght="11" required="" class="form-control "  value="" placeholder="Escribir ...">
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="CliNom" class="col-sm-2 col-form-label" name="LCliNom" id="LCliNom">Nombre Completo:  </label>
                      <div class="col-sm-10">
                          <input type="text" name="CliNom" id="CliNom" maxlenght="40" required="" class="form-control "  value="" placeholder="Escribir Cliente...">
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="CliCor" class="col-sm-2 col-form-label" name="LCliCor" id="LCliCor">Correo:  </label>
                      <div class="col-sm-10">
                          <input type="text" name="CliCor" id="CliCor" maxlenght="40" required="" class="form-control "  value="" placeholder="Escribir Correo...">
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="CliCel" class="col-sm-2 col-form-label" name="LCliCel" id="LCliCel" >Celular:  </label>
                      <div class="col-sm-10">
                          <input type="text" name="CliCel" id="CliCel" maxlenght="40" required="" class="form-control "  value="" placeholder="Escribir Celular...">
                      </div>
                    </div>
                     <div class="form-group row"> 
                        <label for="CliDir" class="col-sm-2 col-form-label" name="LCliDir" id="LCliDir">Direccion:  </label>
                      <div class="col-sm-10">
                          <input type="text" name="CliDir" id="CliDir" maxlenght="40" required="" class="form-control "  value="" placeholder="Escribir Direccion...">
                      </div>
                    </div>
                    <br>
                   <br>
                    <input type="submit" name="Save" id="Save" class="btn btn-outline-danger btn-block" value="Agregar">
                  </form>
                </div>
            </div>
          </div>
        </div>

   <!-- Bootstrap core JavaScript-->
  <script src="../lib/vendor/jquery/jquery.min.js"></script>
  <script src="../lib/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../lib/js/sb-admin-2.min.js"></script>


</body>
</html>
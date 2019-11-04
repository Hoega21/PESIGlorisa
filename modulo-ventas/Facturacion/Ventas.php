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
          <h1 class="h3 mb-2 text-gray-800" align="center">Ventas</h1>
          <br>
          
          <div class="card shadow mb-4">
            <div class="card-body">
               <div class="p-5">
                  <form class="user">
                    <div class="form-group row">
                      <label for="NameUser" class="col-sm-2 col-form-label" >Tipo Cliente: </label>
                      <div class="col-sm-10">
                       <select id="Tip-Cliente" name="Tip-Cliente" class="form-control ">
                         <option value="PN" >Persona Natural</option>
                         <option value="E" >Persona Juridica</option>
                      </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="SubName">Apellidos: </label>
                      <input type="text" name="SubName" id="SubName" maxlenght="40" required="" class="form-control "  value="" placeholder="Escribir Apellido...">
                    </div>
                    <div class="form-group">
                      <label for="Dni">Dni:  </label>
                    </div>
                    <div class="form-group">
                      <label for="Telephone">Telefono: </label>
                      <input type="number" name="Telephone" id="Telephone" maxlenght="15" value="" class="form-control"  placeholder="Escribir Apellido...">
                    </div>
                    <div class="form-group">
                      <label >Sexo: </label>
                     <input type="radio" id="SexH" disabled="true" name="Sexo" value="M" required="" >
                      <label for="SexH">Hombre</label>
                      <input type="radio" id="SexM" disabled="true" name="Sexo" value="F"  required="" >
                      <label for="SexM">Mujer</label>
                    </div>
                    <div class="form-group">
                       <label for="birthday">Fecha Nacimiento: </label>
                    </div>
                    <div class="form-group">
                       <label for="User">Usuario: </label>
                    </div>
                    <div class="form-group">
                      <label for="Pass">Clave </label>
                        <input type="text" name="Pass" id="Pass" required="" maxlength="20" value=" " class="form-control" required="">
                    </div>
                    <div class="form-group">
                     <label for="Empresa">Empresa:</label>
                    </div>
                    <div class="form-group" >
                      <label for="Rol">Rol: </label>
                      </div>

                    <input type="submit" name="Save" id="Save" class="btn btn-primary btn-user btn-block" value="Guardar">
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
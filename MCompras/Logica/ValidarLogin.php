<?php 
	session_start();
	//require('Conexion.php');	
	//require('Conexion.php');
	$usuario = $_POST['Usuario'];
	$clave = $_POST['Clave'];
	//echo $usuario;
	if($usuario == '' or $clave == ''){				
		echo "<script>
				alert('Ingrese los datos completos');
				window.location='../../index.php';
				</script>";
		//header("Location: ../index.php");
	}else{
		//$Consulta ="select Usuario, idUsuario from usuario where Usuario ='".$usuario."' and  Clave='".$clave."'";
		$Consulta ="call proc_buscar_Empleado('".$usuario."', '".$clave."')";
		require('Conexion.php');
		$result = mysqli_query($Conexion,$Consulta);
		if(mysqli_num_rows($result)==0){
			echo "<script>
				alert('Los datos no son correctos');
				window.location='../../index.php';
				</script>";
		}else{			
			@mysqli_free_result($Conexion);
			while($fila = mysqli_fetch_array($result)){
				$_SESSION['MUsuarioid'] = $fila['idUsuario'];
				$_SESSION['MUsuario'] = $fila['username'];
				//$_SESSION['MFechaingreso'] = getdate();
			}
			//echo "<script>
			//window.location='../../principal.php';
			//</script>";
			header('Location: ../../principal.php');
		}
	}
	/*if($_SESSION['MAcceso']==1 or $_SESSION['MAcceso']==2)
	{
		echo "<script>
			window.location='../Presentacion/index.php';
			</script>";
	}
	if($_SESSION['MAcceso']==3){
		echo "<script>
			window.location='../Presentacion/index_Usuario.php';
			</script>";
	}
	*/
 ?>
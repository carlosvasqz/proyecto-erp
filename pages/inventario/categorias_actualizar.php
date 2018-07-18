<?php
	//session_start();
	//if (isset($_SESSION['username'])&&($_SESSION['type'])) { 

        include ('../../inc/conexion.php');
        include ('../../inc/util.php');
		 $id_categoria = $_POST['id_categoria'];
		  $nombre = $_POST['nombre'];
		 $descripcion = $_POST['descripcion'];
		

    //  echo $codigoEmpleado . ' <-> ' . $fechaIngreso . ' <-> ' . $estado . ' <-> ' . $idEmpleado . ' <-> ' . $nombres . ' <-> ' . $apellido1 .  ' <-> ' . $apellido2 . ' <-> ' . $fechaNacimiento . ' <-> ' . $genero . ' <-> ' . $direccion . ' <-> ' . $telefono . ' <-> ' . $correo;

	$queryVerificar = mysqli_query($db, "SELECT COUNT(*) as Existe FROM categorias WHERE Id_Categoria = '$id_categoria'") or die (mysqli_error());
    
	$rowExiste=mysqli_fetch_array($queryVerificar);
	if($rowExiste['Existe']==0){
		#echo 'No existe';
	}
	if ($rowExiste['Existe']==1) {
			$queryActualizar = mysqli_query($db, "UPDATE categorias SET Nombre='$nombre',Descripcion='$descripcion' WHERE Id_Categoria='$id_categoria'") or die(mysqli_error());
			echo 'Guardado';
        }
            
    // } else {
    //     header('location: page_denegado.php');
    // }
?>
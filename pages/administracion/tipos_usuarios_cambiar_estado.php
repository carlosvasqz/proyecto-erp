<?php
	//session_start();
	//if (isset($_SESSION['username'])&&($_SESSION['type'])) { 

        include ('../../inc/conexion.php');
        include ('../../inc/util.php');
		 $tipos = $_POST['id_tipos'];
		 $estado = $_POST['estado'];

    //  echo $codigoEmpleado . ' <-> ' . $fechaIngreso . ' <-> ' . $estado . ' <-> ' . $idEmpleado . ' <-> ' . $nombres . ' <-> ' . $apellido1 .  ' <-> ' . $apellido2 . ' <-> ' . $fechaNacimiento . ' <-> ' . $genero . ' <-> ' . $direccion . ' <-> ' . $telefono . ' <-> ' . $correo;

	$queryVerificar = mysqli_query($db, "SELECT COUNT(*) as Existe FROM tipos_usuarios WHERE Id_Tipo_Usuario = '$tipos'") or die (mysqli_error());
    
	$rowExiste=mysqli_fetch_array($queryVerificar);
	if($rowExiste['Existe']==0){
		#echo 'No existe';
	}
	if ($rowExiste['Existe']==1) {
			$queryActualizar = mysqli_query($db, "UPDATE tipos_usuarios SET Estado=$estado WHERE Id_Tipo_Usuario='$tipos'") or die(mysqli_error());
			echo 'Actualizado';
    }
            
    // } else {
    //     header('location: page_denegado.php');
    // }
?>
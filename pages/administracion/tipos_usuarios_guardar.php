<?php
	//session_start();
	//if (isset($_SESSION['username'])&&($_SESSION['type'])) { 

        include ('../../inc/conexion.php');
        include ('../../inc/util.php');
         
         $tipos = $_POST['id_tipos'];
         $nomb = $_POST['nombre'];
         $desc = $_POST['des'];
         $estado = $_POST['estado'];


    //  echo $codigoEmpleado . ' <-> ' . $fechaIngreso . ' <-> ' . $estado . ' <-> ' . $idEmpleado . ' <-> ' . $nombres . ' <-> ' . $apellido1 .  ' <-> ' . $apellido2 . ' <-> ' . $fechaNacimiento . ' <-> ' . $genero . ' <-> ' . $direccion . ' <-> ' . $telefono . ' <-> ' . $correo;

	$queryVerificar = mysqli_query($db, "SELECT COUNT(*) as Existe FROM tipos_usuarios WHERE Id_Tipo_Usuario = '$tipos'") or die (mysqli_error());
    
	$rowExiste=mysqli_fetch_array($queryVerificar);
	if($rowExiste['Existe']==0){
		$queryGuardar = mysqli_query($db, "INSERT INTO tipos_usuarios (Id_Tipo_Usuario, Nombre, Descripcion, Estado) VALUES ('$tipos', '$nomb', '$desc', '$estado')") or die(mysqli_error());
		echo 'Guardado';
	}
	if ($rowExiste['Existe']==1) {
            #echo 'Ya existe';
        }
            
    // } else {
    //     header('location: page_denegado.php');
    // }
?>
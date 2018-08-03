<?php
	//session_start();
	//if (isset($_SESSION['username'])&&($_SESSION['type'])) { 

        include ('../../inc/conexion.php');
        include ('../../inc/util.php');
		$codigoUsuario = $_POST['codigo_usuario'];
		$estado = $_POST['estado'];
		$idEmpleado = $_POST['id_empleado'];
		$tipoUsuario = $_POST['tipo_usuario'];

	$idEmpleado = explode('|', $idEmpleado);
	$idEmpleado = trim($idEmpleado[0]);
	$tipoUsuario = explode('|', $tipoUsuario);
	$tipoUsuario = trim($tipoUsuario[0]);

    // echo $codigoUsuario . ' <-> ' . $estado . ' <-> ' . $idEmpleado . ' <-> ' . $tipoUsuario;
	// exit();

	$sentencia = "SELECT COUNT(*) as Existe FROM usuarios WHERE Id_Usuario = '$codigoUsuario';";
	// echo $sentencia;
	// exit();
	$queryVerificar = mysqli_query($db, $sentencia) or die (mysqli_error());    
	$rowExiste=mysqli_fetch_array($queryVerificar);
	if($rowExiste['Existe']==0){
		#echo 'No existe';
	}
	if ($rowExiste['Existe']==1) {
		$queryVerificarEmpleado = mysqli_query($db, "SELECT COUNT(*) AS Existe_Empleado FROM usuarios WHERE Codigo_Empleado = '$idEmpleado'") or die (mysqli_error());
		$rowExisteEmpleado=mysqli_fetch_array($queryVerificarEmpleado);
		$queryUsuario = mysqli_query($db, "SELECT * FROM usuarios WHERE Id_Usuario = '$codigoUsuario'") or die (mysqli_error());
		$rowUsuario=mysqli_fetch_array($queryUsuario);
		if ($rowExisteEmpleado['Existe_Empleado']==0||$rowUsuario['Codigo_Empleado']==$idEmpleado) {
			$queryActualizar = mysqli_query($db, "UPDATE usuarios SET Id_Tipo_Usuario='$tipoUsuario', Estado=$estado, Codigo_Empleado='$idEmpleado' WHERE Id_Usuario='$codigoUsuario';") or die(mysqli_error());
			echo 'Guardado';
		} else {
			# "El empleado seleccionado para el usuario, ya existe"
		}
    }
            
    // } else {
    //     header('location: page_denegado.php');
    // }
?>
<?php
	//session_start();
	//if (isset($_SESSION['username'])&&($_SESSION['type'])) { 

        include ('../../inc/conexion.php');
        include ('../../inc/util.php');
		$codigoUsuario = $_POST['codigo_usuario'];
		$pass = $_POST['pass'];
		$estado = $_POST['estado'];
		$idEmpleado = $_POST['id_empleado'];
		$tipoUsuario = $_POST['tipo_usuario'];

	$idEmpleado = explode('|', $idEmpleado);
	$idEmpleado = trim($idEmpleado[0]);
	$tipoUsuario = explode('|', $tipoUsuario);
	$tipoUsuario = trim($tipoUsuario[0]);

    // echo $codigoUsuario . ' <-> ' . $pass . ' <-> ' . $estado . ' <-> ' . $idEmpleado . ' <-> ' . $tipoUsuario;
	// exit();

	$queryVerificar = mysqli_query($db, "SELECT COUNT(*) as Existe FROM usuarios WHERE Id_Usuario = '$codigoUsuario' OR Codigo_Empleado = '$idEmpleado'") or die (mysqli_error());
    
	$rowExiste=mysqli_fetch_array($queryVerificar);
	if($rowExiste['Existe']==0){
		$queryGuardar = mysqli_query($db, "INSERT INTO usuarios(Id_Usuario, Contraseña, Id_Tipo_Usuario, Estado, Codigo_Empleado) VALUES ('$codigoUsuario','$pass','$tipoUsuario',$estado,'$idEmpleado');") or die(mysqli_error());
		echo 'Guardado';
	}
	if ($rowExiste['Existe']==1) {
            #echo 'Ya existe';
        }
            
    // } else {
    //     header('location: page_denegado.php');
    // }
?>
<?php
	//session_start();
	//if (isset($_SESSION['username'])&&($_SESSION['type'])) { 

        include ('../../inc/conexion.php');
        include ('../../inc/util.php');
		 $codigoCliente = $_POST['codigo_cliente'];
		 $idCliente = $_POST['id_cliente'];
		 $nombreCliente = $_POST['nombres_cliente'];
		 $apellido = $_POST['apellido'];
		 $rtnCliente = $_POST['rtn_cliente'];
		 $telefono = $_POST['telefono'];
		 $direccionCliente = $_POST['direccion_cliente'];
         $correoCliente = $_POST['correo_cliente'];

    //  echo $codigoEmpleado . ' <-> ' . $fechaIngreso . ' <-> ' . $estado . ' <-> ' . $idEmpleado . ' <-> ' . $nombres . ' <-> ' . $apellido1 .  ' <-> ' . $apellido2 . ' <-> ' . $fechaNacimiento . ' <-> ' . $genero . ' <-> ' . $direccion . ' <-> ' . $telefono . ' <-> ' . $correo;

	$queryVerificar = mysqli_query($db, "SELECT COUNT(*) as Existe FROM clientes WHERE Numero_Identidad = '$idCliente'") or die (mysqli_error());
    
	$rowExiste=mysqli_fetch_array($queryVerificar);
	if($rowExiste['Existe']==0){
		#echo 'No existe';
	}
	if ($rowExiste['Existe']==1) {
			$queryActualizar = mysqli_query($db, "UPDATE clientes SET Nombres='$nombreCliente',Apellido='$apellido',RTN='$rtnCliente',Telefono='$telefono',Direccion='$direccionCliente',Correo_Electronico='$correoCliente',Numero_Identidad='$idCliente' WHERE Id_Cliente='$codigoCliente' AND Numero_Identidad='$idCliente'") or die(mysqli_error());
			echo 'Guardado';
        }
            
    // } else {
    //     header('location: page_denegado.php');
    // }
?>
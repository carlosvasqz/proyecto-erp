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

	//$queryVerificar = mysqli_query($db, "SELECT COUNT(*) as Existe FROM clientes WHERE Id_cliente = '$codigoCliente'") or die (mysqli_error());

	$queryVerificar = mysqli_query($db, "SELECT COUNT(*) as Existe FROM clientes WHERE Numero_Identidad = '$idCliente'") or die (mysqli_error());
    
	$rowExiste=mysqli_fetch_array($queryVerificar);
	//$rowExiste2=mysqli_fetch_array($queryVerificar2);

	if($rowExiste['Existe']==0){

		$queryGuardar = mysqli_query($db, "INSERT INTO clientes (Id_Cliente, Nombres, Apellido, Telefono, RTN, Correo_Electronico, Direccion, Numero_Identidad) VALUES ('$codigoCliente', '$nombreCliente', '$apellido', '$telefono', '$rtnCliente','$correoCliente', '$direccionCliente', '$idCliente') ") or die(mysqli_error());
		echo 'Guardado';
	}
	if ($rowExiste['Existe']==1) {
            #echo 'Ya existe';
        }
            
    // } else {
    //     header('location: page_denegado.php');
    // }
?>
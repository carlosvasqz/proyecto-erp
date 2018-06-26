<?php
	//session_start();
	//if (isset($_SESSION['username'])&&($_SESSION['type'])) { 

        include ('../../inc/conexion.php');
        include ('../../inc/util.php');
		 $codigoEmpleado = $_POST['codigo_empleado'];
		 $fechaIngreso = fechaIngABD($_POST['fecha_ingreso']);
		 $estado = $_POST['estado'];
		 $idEmpleado = $_POST['id_empleado'];
		 $nombres = $_POST['nombres_empleado'];
		 $apellido1 = $_POST['apellido_1'];
		 $apellido2 = $_POST['apellido_2'];
         $fechaNacimiento = fechaIngABD($_POST['fecha_nacimiento']);
         $genero = $_POST['genero'];
         $direccion = $_POST['direccion_empleado'];
         $telefono = $_POST['telefono'];
         $correo = $_POST['correo'];

    //  echo $codigoEmpleado . ' <-> ' . $fechaIngreso . ' <-> ' . $estado . ' <-> ' . $idEmpleado . ' <-> ' . $nombres . ' <-> ' . $apellido1 .  ' <-> ' . $apellido2 . ' <-> ' . $fechaNacimiento . ' <-> ' . $genero . ' <-> ' . $direccion . ' <-> ' . $telefono . ' <-> ' . $correo;

	$queryVerificar = mysqli_query($db, "SELECT COUNT(*) as Existe FROM empleados WHERE Codigo_Empleado = '$codigoEmpleado' AND ID = '$idEmpleado'") or die (mysqli_error());
    
	$rowExiste=mysqli_fetch_array($queryVerificar);
	if($rowExiste['Existe']==0){
		#echo 'No existe';
	}
	if ($rowExiste['Existe']==1) {
			$queryActualizar = mysqli_query($db, "UPDATE empleados SET Nombres='$nombres',Apellido_1='$apellido1',Apellido_2='$apellido2',Fecha_Nacimiento='$fechaNacimiento',Fecha_Ingreso='$fechaIngreso',Genero='$genero',Direccion='$direccion',Telefono='$telefono',Correo_Electronico='$correo',Estado=$estado WHERE Codigo_Empleado='$codigoEmpleado' AND ID='$idEmpleado'") or die(mysqli_error());
			echo 'Guardado';
        }
            
    // } else {
    //     header('location: page_denegado.php');
    // }
?>
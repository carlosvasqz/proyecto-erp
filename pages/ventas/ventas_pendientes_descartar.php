<?php
	//session_start();
	//if (isset($_SESSION['username'])&&($_SESSION['type'])) { 

        include ('../../inc/conexion.php');
        include ('../../inc/util.php');
		 $idVenta = $_POST['Id_Venta_Tmp'];

    //  echo $codigoEmpleado . ' <-> ' . $fechaIngreso . ' <-> ' . $estado . ' <-> ' . $idEmpleado . ' <-> ' . $nombres . ' <-> ' . $apellido1 .  ' <-> ' . $apellido2 . ' <-> ' . $fechaNacimiento . ' <-> ' . $genero . ' <-> ' . $direccion . ' <-> ' . $telefono . ' <-> ' . $correo;

	$queryVerificar = mysqli_query($db, "SELECT COUNT(*) as Existe FROM ventas_tmp WHERE Id_Venta_Tmp = '$idVenta'") or die (mysqli_error());
    
	$rowExiste=mysqli_fetch_array($queryVerificar);
	if($rowExiste['Existe']==0){
		#echo 'No existe';
	}
	if ($rowExiste['Existe']==1) {
			$queryDescartar = mysqli_query($db, "DELETE FROM ventas_tmp WHERE Id_Venta_Tmp='$idVenta'") or die(mysqli_error());
			$queryDescartar = mysqli_query($db, "DELETE FROM detalles_ventas_tmp WHERE Id_Venta_Tmp='$idVenta'") or die(mysqli_error());
			echo 'Descartado';
    }
            
    // } else {
    //     header('location: page_denegado.php');
    // }
?>
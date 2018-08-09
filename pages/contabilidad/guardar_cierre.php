<?php
	//session_start();
	//if (isset($_SESSION['username'])&&($_SESSION['type'])) { 

        include ('../../inc/conexion.php');
        include ('../../inc/util.php');
      

		 $codigo = $_POST['codigo'];
		 $usuario = $_POST['usuario'];
		 $fecha = $_POST['fecha'];
		 $hora = $_POST['hora'];
		 $caja = $_POST['caja'];
		 $ventas_hoy = $_POST['ventas_hoy'];
		 $total = $_POST['total'];
     $justificacion = $_POST['justificacion'];
    
         

    //  echo $codigoEmpleado . ' <-> ' . $fechaIngreso . ' <-> ' . $estado . ' <-> ' . $idEmpleado . ' <-> ' . $nombres . ' <-> ' . $apellido1 .  ' <-> ' . $apellido2 . ' <-> ' . $fechaNacimiento . ' <-> ' . $genero . ' <-> ' . $direccion . ' <-> ' . $telefono . ' <-> ' . $correo;

	$queryVerificar = mysqli_query($db, "SELECT COUNT(*) as Existe FROM cierres_diarios WHERE Fecha = '$fecha'") or die (mysqli_error());
    
	$rowExiste=mysqli_fetch_array($queryVerificar);
	if($rowExiste['Existe']==0){
		$queryGuardar = mysqli_query($db, "INSERT INTO cierres_diarios (Id_Cierre_Diario, Fecha, Hora, Id_Usuario, Ventas_Dia, Dinero_Caja, Diferencia, Justificacion_Diferencia) VALUES ('$codigo', '$fecha', '$hora', '$usuario', '$ventas_hoy', '$caja', '$total', '$justificacion') ") or die(mysqli_error());
		echo 'Guardado';
	}
	if ($rowExiste['Existe']==1) {
            #echo 'Ya existe';
        }
            
    // } else {
    //     header('location: page_denegado.php');
    // }
?>
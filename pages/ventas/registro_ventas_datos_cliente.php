<?php
	//session_start();
	//if (isset($_SESSION['username'])&&($_SESSION['type'])) { 

        include ('../../inc/conexion.php');
        include ('../../inc/util.php');
		 $codigoCliente = $_POST['id_cliente'];

    //  echo $codigoEmpleado . ' <-> ' . $fechaIngreso . ' <-> ' . $estado . ' <-> ' . $idEmpleado . ' <-> ' . $nombres . ' <-> ' . $apellido1 .  ' <-> ' . $apellido2 . ' <-> ' . $fechaNacimiento . ' <-> ' . $genero . ' <-> ' . $direccion . ' <-> ' . $telefono . ' <-> ' . $correo;

	// $queryVerificar = mysqli_query($db, "SELECT COUNT(*) as Existe FROM clientes WHERE Id_Cliente = '$codigoCliente'") or die (mysqli_error());
    
	// $rowExiste=mysqli_fetch_array($queryVerificar);
	// if($rowExiste['Existe']==0){
	// 	#echo 'No existe';
	// }
	// if ($rowExiste['Existe']==1) {
            $queryDatos = mysqli_query($db, "SELECT * FROM clientes WHERE Id_Cliente='$codigoCliente'") or die(mysqli_error());
            $rowDatos = mysqli_fetch_array($queryDatos);
            // echo 'Actualizado';
            $return = array();
            $return['Codigo_Cliente'] = $rowDatos['Id_Cliente'];
            $return['Nombres'] = $rowDatos['Nombres'];
            $return['Apellido'] = $rowDatos['Apellido'];
            $return['Telefono'] = $rowDatos['Telefono'];
            $return['RTN'] = $rowDatos['RTN'];
            $return['Correo'] = $rowDatos['Correo_Electronico'];            
            $return['Direccion'] = $rowDatos['Direccion'];            
            $return['ID'] = $rowDatos['Numero_Identidad'];            

            header('Content-type: application/json; charset=utf-8');
        
            echo json_encode($return);
            
            exit();
    // }
            
    // } else {
    //     header('location: page_denegado.php');
    // }
?>
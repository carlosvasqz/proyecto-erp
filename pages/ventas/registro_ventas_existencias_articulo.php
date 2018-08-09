<?php
	//session_start();
	//if (isset($_SESSION['username'])&&($_SESSION['type'])) { 

        include ('../../inc/conexion.php');
        include ('../../inc/util.php');
		 $idArticulo = $_POST['id_articulo'];

    //  echo $codigoEmpleado . ' <-> ' . $fechaIngreso . ' <-> ' . $estado . ' <-> ' . $idEmpleado . ' <-> ' . $nombres . ' <-> ' . $apellido1 .  ' <-> ' . $apellido2 . ' <-> ' . $fechaNacimiento . ' <-> ' . $genero . ' <-> ' . $direccion . ' <-> ' . $telefono . ' <-> ' . $correo;

	// $queryVerificar = mysqli_query($db, "SELECT COUNT(*) as Existe FROM clientes WHERE Id_Cliente = '$idArticulo'") or die (mysqli_error());
    
	// $rowExiste=mysqli_fetch_array($queryVerificar);
	// if($rowExiste['Existe']==0){
	// 	#echo 'No existe';
	// }
	// if ($rowExiste['Existe']==1) {
            $queryDatos = mysqli_query($db, "SELECT * FROM articulos WHERE Id_Articulo='$idArticulo'") or die(mysqli_error());
            $rowDatos = mysqli_fetch_array($queryDatos);
            // echo 'Actualizado';
            $return = array();
            $return['Id_Articulo'] = $rowDatos['Id_Articulo'];          
            $return['Existencias'] = $rowDatos['Existencias'];          
            $return['Precio'] = $rowDatos['Precio_Final'];          

            header('Content-type: application/json; charset=utf-8');
        
            echo json_encode($return);
            
            exit();
    // }
            
    // } else {
    //     header('location: page_denegado.php');
    // }
?>
<?php
	//session_start();
	//if (isset($_SESSION['username'])&&($_SESSION['type'])) { 

        include ('../../inc/conexion.php');
        include ('../../inc/util.php');
		 $codigoArticulo = $_POST['Id_Articulo'];

    //  echo $codigoEmpleado . ' <-> ' . $fechaIngreso . ' <-> ' . $estado . ' <-> ' . $idEmpleado . ' <-> ' . $nombres . ' <-> ' . $apellido1 .  ' <-> ' . $apellido2 . ' <-> ' . $fechaNacimiento . ' <-> ' . $genero . ' <-> ' . $direccion . ' <-> ' . $telefono . ' <-> ' . $Pocentaje;

	// $queryVerificar = mysqli_query($db, "SELECT COUNT(*) as Existe FROM clientes WHERE Id_Articulo = '$codigoCliente'") or die (mysqli_error());
    
	// $rowExiste=mysqli_fetch_array($queryVerificar);
	// if($rowExiste['Existe']==0){
	// 	#echo 'No existe';
	// }
	// if ($rowExiste['Existe']==1) {
            $queryDatos = mysqli_query($db, "SELECT * FROM articulos WHERE Id_Articulo='$codigoArticulo'") or die(mysqli_error());
            $rowDatos = mysqli_fetch_array($queryDatos);
            // echo 'Actualizado';
            $return = array();
            $return['Id_Articulo'] = $rowDatos['Id_Articulo'];
            $return['Descripcion'] = $rowDatos['Descripcion'];
            $return['Existencias'] = $rowDatos['Existencias'];
            $return['Existencias_Minimas'] = $rowDatos['Existencias_Minimas'];
            $return['Precio_Final'] = $rowDatos['Precio_Final'];
            $return['Porcentaje_Ganancia'] = $rowDatos['Porcentaje_Ganancia'];            
            $return['Estado'] = $rowDatos['Estado'];
            $return['Id_Proveedor'] = $rowDatos['Id_Proveedor'];
            $return['Fecha_Ultima_Compra'] = $rowDatos['Fecha_Ultima_Compra'];
            $return['Fecha_Ultima_Venta'] = $rowDatos['Fecha_Ultima_Venta'];            
            $return['Id_Categoria'] = $rowDatos['Id_Categoria'];            

            header('Content-type: application/json; charset=utf-8');
        
            echo json_encode($return);
            
            exit();
    // }
            
    // } else {
    //     header('location: page_denegado.php');
    // }
?>
<?php
	//session_start();
	//if (isset($_SESSION['username'])&&($_SESSION['type'])) { 

        include ('../../inc/conexion.php');
        include ('../../inc/util.php');
      

		 $codigoArticulo = $_POST['codigo_articulo'];
		 $descripcionArticulo = $_POST['descripcion_articulo'];
		 $existencias = $_POST['existencias_articulos'];
		 $existenciasMinimas = $_POST['existencias_minimas_articulos'];
		 $precioArticulo = $_POST['precio_articulo'];
		 $ganancia = $_POST['ganancia_articulos'];
		 $estado = $_POST['estado'];
     $proveedor = $_POST['proveedor_articulo'];
     $ultimaCompra = fechaIngABD($_POST['fecha_compra']);
     $ultimaVenta = fechaIngABD($_POST['fecha_venta']);
     $categoria = $_POST['categoria_articulo'];
         

    //  echo $codigoEmpleado . ' <-> ' . $fechaIngreso . ' <-> ' . $estado . ' <-> ' . $idEmpleado . ' <-> ' . $nombres . ' <-> ' . $apellido1 .  ' <-> ' . $apellido2 . ' <-> ' . $fechaNacimiento . ' <-> ' . $genero . ' <-> ' . $direccion . ' <-> ' . $telefono . ' <-> ' . $correo;

	$queryVerificar = mysqli_query($db, "SELECT COUNT(*) as Existe FROM articulos WHERE Id_Articulo = '$codigoArticulo'") or die (mysqli_error());
    
	$rowExiste=mysqli_fetch_array($queryVerificar);
	if($rowExiste['Existe']==0){
		$queryGuardar = mysqli_query($db, "INSERT INTO articulos (Id_Articulo, Descripcion, Existencias, Existencias_Minimas, Precio_Final, Porcentaje_Ganancia, Estado, Id_Proveedor, Fecha_Ultima_Compra, Fecha_Ultima_Venta, Id_Categoria) VALUES ('$codigoArticulo', '$descripcionArticulo', '$existencias', '$existenciasMinimas', '$precioArticulo', '$ganancia', '$estado', '$proveedor', '$ultimaCompra', '$ultimaVenta', '$categoria') ") or die(mysqli_error());
		echo 'Guardado';
	}
	if ($rowExiste['Existe']==1) {
            #echo 'Ya existe';
        }
            
    // } else {
    //     header('location: page_denegado.php');
    // }
?>
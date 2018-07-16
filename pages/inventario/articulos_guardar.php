<?php
	//session_start();
	//if (isset($_SESSION['username'])&&($_SESSION['type'])) { 

        include ('../../inc/conexion.php');
        include ('../../inc/util.php');
      var codigoArticulo = $("#codigo_articulo").val();
      var descripcionArticulo= $("#descripcion_articulo").val();
      var existencias= $("#existencias_articulos").val();
      var existenciasMinimas= $("#existencias_minimas_articulos").val();
      var precioArticulo= $("#precio_articulo").val();
      var ganancia= $("#ganancia_articulos").val();
      var estado = $('input[name="optionsRadios"]:checked').val();
      var proveedor= $("#proveedor_articulor").val();
      var ultimaCompra= $("#fecha_compra").val();
      var ultimaVenta= $("#fecha_venta").val();
      var categoria= $("#categoria_articulo").val();

		 $codigoArticulo = $_POST['codigo_articulo'];
		 $descripcionArticulo = $_POST['descripcion_articulo'];
		 $existencias = $_POST['estado'];
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

	$queryVerificar = mysqli_query($db, "SELECT COUNT(*) as Existe FROM empleados WHERE ID = '$idEmpleado'") or die (mysqli_error());
    
	$rowExiste=mysqli_fetch_array($queryVerificar);
	if($rowExiste['Existe']==0){
		$queryGuardar = mysqli_query($db, "INSERT INTO empleados (Codigo_Empleado, ID, Nombres, Apellido_1, Apellido_2, Fecha_Nacimiento, Fecha_Ingreso, Genero, Direccion, Telefono, Correo_Electronico, Estado) VALUES ('$codigoEmpleado', '$idEmpleado', '$nombres', '$apellido1', '$apellido2', '$fechaNacimiento', '$fechaIngreso', '$genero', '$direccion', '$telefono', '$correo', $estado) ") or die(mysqli_error());
		echo 'Guardado';
	}
	if ($rowExiste['Existe']==1) {
            #echo 'Ya existe';
        }
            
    // } else {
    //     header('location: page_denegado.php');
    // }
?>
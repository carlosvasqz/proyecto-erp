<?php 
	if (isset($_POST['id_venta_tmp'])) {
		eliminarVentaTmp($_POST['id_venta_tmp']);
	} else {
		echo "Parametro sin definir";
	}

	function eliminarVentaTmp($id_venta_tmp){
    	include('../../inc/conexion.php');
    	
		$sqlEliminarVenta = "DELETE FROM ventas_tmp WHERE Id_Venta_Tmp = $id_venta_tmp;";
		// echo $sqlEliminarVenta;
		// exit();
		$queryEliminarVenta=mysqli_query($db, $sqlEliminarVenta) or die(mysqli_error());

		$sqlEliminarDetalles = "DELETE FROM detalles_venta_tmp WHERE Id_Venta_Tmp = $id_venta_tmp;";
		// echo $sqlEliminarDetalles;
		// exit();
		$queryEliminarDetalles=mysqli_query($db, $sqlEliminarDetalles) or die(mysqli_error());

		echo "Eliminado";
	}
?>
<?php 

	if ( isset($_POST['tmp_num_venta']) && isset($_POST['tmp_num_detalle']) && isset($_POST['index']) ) {
		actualizarNumDetalle($_POST['index'], $_POST['tmp_num_venta'], $_POST['tmp_num_detalle']);
	}else{
		echo "Datos no recibidos \n";
	}

	function actualizarNumDetalle($index, $tmp_num_factura, $tmp_num_detalle){
		include('../../inc/conexion.php');

		$sqlActualizarNumDetalle = "UPDATE detalles_venta_tmp SET Num_Detalle_Tmp = '$index' WHERE Id_Venta_Tmp='$tmp_num_factura' AND Num_Detalle_Tmp = '$tmp_num_detalle';";
		$sqlActualizarNumDetalle = mysqli_query($db, $sqlActualizarNumDetalle) or die(mysqli_error());

		echo "Detalles contados";
	}

?>
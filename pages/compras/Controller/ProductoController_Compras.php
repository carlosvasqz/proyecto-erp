<?php
session_start();
if(isset($_GET["page"])){
	$page=$_GET["page"];
}else{
	$page=0;
}
require_once '../Config/conexion.php';
require_once '../Model/Producto.php';

switch($page){

	case 1:
		$json = array();
		$json['msj'] = 'Producto Agregado';
		$json['success'] = true;
	
		if (isset($_POST['proveedor']) && $_POST['proveedor']!='' && isset($_POST['descripcion']) && $_POST['descripcion']!='' && isset($_POST['cantidad']) && $_POST['cantidad']!='' && isset($_POST['existencia']) && $_POST['existencia']!='' && isset($_POST['costo']) && $_POST['costo']!='' && isset($_POST['porcentaje']) && $_POST['porcentaje']!='' && isset($_POST['precio']) && $_POST['precio']!='' ) {
			try {
				$proveedor = $_POST['proveedor'];
				$descripcion = $_POST['descripcion'];
				$cantidad = $_POST['cantidad'];
				$existencia = $_POST['existencia'];
				$costo = $_POST['costo'];
				$porcentaje = $_POST['porcentaje'];
				$precio = $_POST['precio'];
				
				
				if(count($_SESSION['detalle'])>0){
					$ultimo = end($_SESSION['detalle']);
					$count = $ultimo['id']+1;
				}else{
					$count = count($_SESSION['detalle'])+1;
				}
				$_SESSION['detalle'][$count] = array('id'=>$count, 'proveedor'=>$proveedor, 'descripcion'=>$descripcion, 'cantidad'=>$cantidad, 'existencia'=>$existencia, 'costo'=> $costo, 'porcentaje'=>$porcentaje, 'precio'=>$precio);

				$json['success'] = true;

				echo json_encode($json);
	
			} catch (PDOException $e) {
				$json['msj'] = $e->getMessage();
				$json['success'] = false;
				echo json_encode($json);
			}
		}else{
			$json['msj'] = 'Ingrese un producto y/o ingrese cantidad';
			$json['success'] = false;
			echo json_encode($json);
		}
		break;

	case 2:
		$json = array();
		$json['msj'] = 'Producto Eliminado';
		$json['success'] = true;
	
		if (isset($_POST['id'])) {
			try {
				unset($_SESSION['detalle'][$_POST['id']]);
				$json['success'] = true;
	
				echo json_encode($json);
	
			} catch (PDOException $e) {
				$json['msj'] = $e->getMessage();
				$json['success'] = false;
				echo json_encode($json);
			}
		}
		break;

case 3:
		$objProducto = new Producto();
		$json = array();
		$json['msj'] = 'Guardado correctamente';
		$json['success'] = true;
	
		if (count($_SESSION['detalle'])>0) {
			try {

				foreach ($_SESSION['detalle'] as $detalle):
				$proveedor = $detalle['proveedor'];
				$descripcion = $detalle['descripcion'];
				$cantidad = $detalle['cantidad'];
				$costo = $detalle['costo'];
				$objProducto->guardarDetalleVenta($proveedor,$descripcion,$cantidad,$costo);
				
			    endforeach;
			    $_SESSION['detalle']= array();
				$json['success'] = true;
				echo json_encode($json);
	
			} catch (PDOException $e) {
				$json['msj'] = $e->getMessage();
				$json['success'] = false;
				echo json_encode($json);
			}
		}else{
			$json['msj'] = 'No hay productos agregados';
			$json['success'] = false;
			echo json_encode($json);
		}
		break;

}
?>
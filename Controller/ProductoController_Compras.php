<?php
session_start();
if(isset($_GET["page"])){
	$page=$_GET["page"];
}else{
	$page=0;
}

require_once '../Config/conexion.php';
require_once '../Model/Producto_factura.php';

switch($page){

	case 1:
		$objProducto = new Producto();
		$json = array();
		$json['msj'] = 'Producto Agregado';
		$json['success'] = true;
	
		if (isset($_POST['producto_id']) && $_POST['producto_id']!='' && isset($_POST['cantidad']) && $_POST['cantidad']!='') {
			try {
				$cantidad = $_POST['cantidad'];
				$producto_id = $_POST['producto_id'];
				
				$resultado_producto = $objProducto->getById($producto_id);
				$producto = $resultado_producto->fetchObject();
				$descripcion = $producto->descripcion;
				$precio = $producto->precio;
				
				$subtotal = $cantidad * $precio;
				
				$_SESSION['detalle_factura'][$producto_id] = array('id'=>$producto_id, 'producto'=>$descripcion, 'cantidad'=>$cantidad, 'precio'=>$precio, 'subtotal'=>$subtotal);

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
				unset($_SESSION['detalle_factura'][$_POST['id']]);
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
		$json = array();
		$json['msj'] = 'Precio actualizado';
		$json['success'] = true;
	
		if (isset($_POST['id'])) {
			try {
				//unset($_SESSION['detalle'][$_POST['id']]);
				$producto_id = $_POST['id'];
				$cantidad = $_SESSION['detalle_factura'][$producto_id]['cantidad'];
				$descripcion = $_SESSION['detalle_factura'][$producto_id]['producto'];
				$precio = $_POST['precio'];
				
				$subtotal = $cantidad * $precio;
				
				$_SESSION['detalle_factura'][$producto_id] = array('id'=>$producto_id, 'producto'=>$descripcion, 'cantidad'=>$cantidad, 'precio'=>$precio, 'subtotal'=>$subtotal);
				
				$json['success'] = true;
	
				echo json_encode($json);
	
			} catch (PDOException $e) {
				$json['msj'] = $e->getMessage();
				$json['success'] = false;
				echo json_encode($json);
			}
		}
		break;
		
	case 4:
		$objProducto = new Producto();
		$json = array();
		$json['msj'] = 'Guardado correctamente';
		$json['success'] = true;
		$json['idventa'] = '';
	
		if (count($_SESSION['detalle_factura'])>0) {
			try {
				$objProducto->guardarVenta();
				$registro_ultima_venta = $objProducto->getUltimaVenta();
				$result_ultima_venta = $registro_ultima_venta->fetchObject();
				$idventa = $result_ultima_venta->ultimo;
				foreach($_SESSION['detalle_factura'] as $detalle_factura):
					$idproducto = $detalle_factura['id'];
					$cantidad = $detalle_factura['cantidad'];
					$precio = $detalle_factura['precio'];
					$subtotal = $detalle_factura['subtotal'];
					$objProducto->guardarDetalleVenta($idventa, $idproducto, $cantidad, $precio, $subtotal);
				endforeach;
				
				$_SESSION['detalle_factura'] = array();
						
				$json['success'] = true;
				$json['idventa'] = $idventa;
	
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
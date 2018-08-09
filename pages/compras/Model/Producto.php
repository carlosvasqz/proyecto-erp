<?php
class Producto
{
	function get(){
		$sql = "SELECT * FROM producto";
		global $cnx;
		return $cnx->query($sql);
	}
	
	function getById($id){
		$sql = "SELECT * FROM producto WHERE id=$id";
		global $cnx;
		return $cnx->query($sql);
	}

	function guardarVenta($id){
		$sql = "INSERT INTO venta (fecha) values (NOW())";
		global $cnx;
		return $cnx->query($sql);
	}
	function getUltimaVenta($id){
		$sql = "SELECT LAST_INSERT_ID() as ultimo ";
		global $cnx;
		return $cnx->query($sql);
	}
	function guardarDetalleVenta($proveedor,$descripcion,$cantidad,$costo){
		$sql = "INSERT INTO detalles_factura_compra (`Id_Compra`, `Id_Articulo`, `Cantidad`, `Costo`) values ('$proveedor','$descripcion', $cantidad , $costo) ";
		global $cnx;
		return $cnx->query($sql);

	}
	
	function actualizarDetalleVenta($descripcion,$cantidad,$existencia, $precio,$porcentaje,$Fecha){
		$sql = " UPDATE articulos SET Existencias= Existencias + '$cantidad', Existencias_Minimas ='$existencia', Precio_Final='$precio', Porcentaje_Ganancia='$porcentaje', Fecha_Ultima_Compra='$Fecha' WHERE Id_Articulo='$descripcion'" ;
		global $cnx;
		return $cnx->query($sql);

	}
}
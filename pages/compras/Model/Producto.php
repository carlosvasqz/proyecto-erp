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
		$sql = "INSERT INTO detalles_factura_compra (`Id_Compra`, `Id_Articulo`, `Cantidad`, `Costo`) values ('$proveedor','$descripcion','$cantidad','$costo') ";
		global $cnx;
		return $cnx->query($sql);

	}
	
	function actualizarDetalleVenta($descripcion,$cantidad){
		$sql=mysqli_query($db,"UPDATE articulos SET Existencias= Existencias + '$cantidad' WHERE Id_Articulo='$descripcion'") or die(mysqli_error());
		global $cnx;
		return $cnx->query($sql);

	}
}
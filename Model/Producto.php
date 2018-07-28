<?php
class Producto
{
	function get(){
		$sql = "SELECT * FROM articulos";
		global $cnx;
		return $cnx->query($sql);
	}
	
	function getById($id){
		$sql = "SELECT * FROM  articulos WHERE Id_Articulo=$Id_Articulo";
		global $cnx;
		return $cnx->query($sql);
	}

	function guardarVenta($id){
		$sql = "INSERT INTO fecha_compra (fecha) values (NOW())";
		global $cnx;
		return $cnx->query($sql);
	}
	function getUltimaVenta($id){
		$sql = "SELECT LAST_INSERT_ID() as ultimo ";
		global $cnx;
		return $cnx->query($sql);
	}
	function guardarDetalleVenta($idcompra,$idproducto,$cantidad,$costo,$porcentaje,$precio){
		$sql = "INSERT INTO compras (idcompra,idproducto,cantidad,costo,porcentaje,precio) values ($idcompra,$idproducto,$cantidad,'$costo',$porcentaje,'$precio') ";
		global $cnx;
		return $cnx->query($sql);
	}
}
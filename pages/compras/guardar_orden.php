<?php
include ('../../inc/conexion.php');
 include ('../../inc/util.php');
//$empleado=$_GET['empleado'];
$codigo=$_POST['codigo'];
$idArticuloListar=$_POST['idArticuloListar'];
$existenciasListar=$_POST['existenciasListar'];
$preciUListar=$_POST['preciUListar'];
$precioTListar=$_POST['precioTListar'];
$idProveedor=$_POST['idProveedor'];
$fecha=$_POST['fecha'];
$estado=$_POST['estado'];



//echo "SELECT COUNT(*) as Existe FROM detalles_orden_compra WHERE Num_Detalle = '$codigo'";
//exit();



//echo "INSERT INTO  ordenes_compra (Id_Proveedor, Fecha_Emision, Estado, Sub_Total, Impuesto, Total) VALUES ('$idProveedor','$fecha','$estado', '0', '0', '0');";
//exit();

	
//echo "INSERT INTO  detalles_orden_compra (Id_Orden_Compra, Id_Articulo, Cantidad, Precio_Unitario, Precio_Total) VALUES ('$codigo','$idArticuloListar','$existenciasListar','$preciUListar','$precioTListar');";
//exit();

	$queryGuardar = mysqli_query($db, "INSERT INTO  detalles_orden_compra (Id_Orden_Compra, Id_Articulo, Cantidad, Precio_Unitario, Precio_Total) VALUES ('$codigo','$idArticuloListar','$existenciasListar','$preciUListar','$precioTListar');") or die(mysqli_error());




echo 'Guardado';

            
    // } else {
    //     header('location: page_denegado.php');
    // }
?>
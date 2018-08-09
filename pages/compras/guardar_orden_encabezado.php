<?php
include ('../../inc/conexion.php');
 include ('../../inc/util.php');
//$empleado=$_GET['empleado'];
$codigo=$_POST['codigo'];
$proveedor=$_POST['proveedor'];
$fecha=$_POST['fecha'];




//echo "SELECT COUNT(*) as Existe FROM detalles_orden_compra WHERE Num_Detalle = '$codigo'";
//exit();

$queryVerificar = mysqli_query($db,"SELECT COUNT(*) as Existe FROM ordenes_compra WHERE Id_Orden_Compra = '$codigo'") or die(mysqli_error());

$rowExiste=mysqli_fetch_array($queryVerificar);
if($rowExiste['Existe']==0){

//echo "INSERT INTO  ordenes_compra (Id_Proveedor, Fecha_Emision, Estado, Sub_Total, Impuesto, Total) VALUES ('$idProveedor','$fecha','$estado', '0', '0', '0');";
//exit();

	$queryGuardarP = mysqli_query($db, "INSERT INTO  ordenes_compra (Id_Orden_Compra, Id_Proveedor, Fecha_Emision, Estado, Sub_Total, Impuesto, Total) VALUES ('$codigo', '$proveedor','$fecha','0', '0', '0', '0');") or die(mysqli_error());
	
//echo "INSERT INTO  detalles_orden_compra (Id_Orden_Compra, Id_Articulo, Cantidad, Precio_Unitario, Precio_Total) VALUES ('$codigo','$idArticuloListar','$existenciasListar','$preciUListar','$precioTListar');";
//exit();

echo 'Guardado';
}
	if ($rowExiste['Existe']==1) {
            #echo 'Ya existe';
        }
            
    // } else {
    //     header('location: page_denegado.php');
    // }
?>
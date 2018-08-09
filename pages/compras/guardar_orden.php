<?php
include ('../../inc/conexion.php');
 include ('../../inc/util.php');
//$empleado=$_GET['empleado'];
$codigo=$_POST['codigo'];
$idArticuloListar=$_POST['idArticuloListar'];
$existenciasListar=$_POST['existenciasListar'];
$preciUListar=$_POST['preciUListar'];
$precioTListar=$_POST['precioTListar'];




$queryVerificar = mysqli_query($db,"SELECT COUNT(*) as Existe FROM detalles_orden_compra WHERE Num_Detalle = '$codigo'") or die(mysqli_error());

$rowExiste=mysqli_fetch_array($queryVerificar);
if($rowExiste['Existe']==0){
$queryGuardar = mysqli_query($db, "INSERT INTO  detalles_orden_compra (Id_Orden_Compra, Id_Articulo, Cantidad, Precio_Unitario, Precio_Total) VALUES ('$codigo','$idArticuloListar','$existenciasListar','$preciUListar','$precioTListar');") or die(mysqli_error());

$queryGuardar = mysqli_query($db, "INSERT INTO  detalles_orden_compra (Id_Orden_Compra, Id_Articulo, Cantidad, Precio_Unitario, Precio_Total) VALUES ('$codigo','$idArticuloListar','$existenciasListar','$preciUListar','$precioTListar');") or die(mysqli_error());
echo 'Guardado';
}
	if ($rowExiste['Existe']==1) {
            #echo 'Ya existe';
        }
            
    // } else {
    //     header('location: page_denegado.php');
    // }
?>
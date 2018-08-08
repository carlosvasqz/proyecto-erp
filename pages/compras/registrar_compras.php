<?php
include ('../../inc/conexion.php');
 include ('../../inc/util.php');
//$empleado=$_GET['empleado'];
$codigo=$_POST['codigo'];
$proveedor_articulo=$_POST['proveedor_articulo'];
$codigo_factura=$_POST['codigo_factura'];
$orden_compra=$_POST['orden_compra'];
$usuario=$_POST['usuario'];
$Fecha = date('Y/m/d H:i'); 



$queryVerificar = mysqli_query($db,"SELECT COUNT(*) as Existe FROM compras WHERE Id_Factura = '$codigo_factura'") or die(mysqli_error());

$rowExiste=mysqli_fetch_array($queryVerificar);
if($rowExiste['Existe']==0){
$queryGuardar = mysqli_query($db, "INSERT INTO compras (`Id_Compra`, `Id_Proveedor`, `Id_Factura`, `Fecha_Compra`, `Id_Usuario`, `Id_Orden`) VALUES ('$codigo','$proveedor_articulo','$codigo_factura', '$Fecha', '$usuario', '$orden_compra');") or die(mysqli_error());
echo 'Guardado';
}
	if ($rowExiste['Existe']==1) {
            #echo 'Ya existe';
        }
            
    // } else {
    //     header('location: page_denegado.php');
    // }
?>
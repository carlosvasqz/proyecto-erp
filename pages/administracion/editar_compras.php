<?php
	//session_start();
	//if (isset($_SESSION['username'])&&($_SESSION['type'])) { 

        include ('../../inc/conexion.php');
        include ('../../inc/util.php');
$codigo=$_POST['codigo'];
$proveedor_articulo=$_POST['proveedor_articulo'];
$codigo_factura=$_POST['codigo_factura'];
$orden_compra=$_POST['orden_compra'];
$Fecha = date('Y/m/d H:i'); 
$sql=mysqli_query($db,"UPDATE compras SET  Id_Compra='$codigo',Id_Proveedor='$proveedor_articulo', Id_Factura='$codigo_factura', Id_Orden='$orden_compra', Fecha_Compra='$Fecha' WHERE Id_Compra='$codigo' AND Id_Proveedor='$proveedor_articulo'") or die(mysqli_error());	echo 'Guardado';
        
            
    // } else {
    //     header('location: page_denegado.php');
    // }
?>
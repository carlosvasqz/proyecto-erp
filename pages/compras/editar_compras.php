<?php
	//session_start();
	//if (isset($_SESSION['username'])&&($_SESSION['type'])) { 

        include ('../../inc/conexion.php');
        include ('../../inc/util.php');
$codigo= $_POST['codigo'];
$proveedor_articulo= $_POST['proveedor_articulo'];
$codigo_factura= $_POST['codigo_factura'];
$orden_compra= $_POST['orden_compra'];
$Fecha = date('Y/m/d H:i'); 


$queryVerificar = mysqli_query($db, "SELECT COUNT(*) as Existe FROM compras WHERE Id_Compra = '$codigo' ") or die (mysqli_error());
    
	$rowExiste=mysqli_fetch_array($queryVerificar);
	if($rowExiste['Existe']==0){
		#echo 'No existe';
	}
	if ($rowExiste['Existe']==1) {
$sql=mysqli_query($db,"UPDATE compras SET  Id_Proveedor='$proveedor_articulo', Id_Factura='$codigo_factura', Fecha_Compra='$Fecha', Id_Orden='$orden_compra' WHERE Id_Compra='$codigo' ") or die(mysqli_error());	echo 'Guardado';
        }
            
    // } else {
    //     header('location: page_denegado.php');
    // }
?>
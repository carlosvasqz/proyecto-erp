<?php
	//session_start();
	//if (isset($_SESSION['username'])&&($_SESSION['type'])) { 

        include ('../../inc/conexion.php');
        include ('../../inc/util.php');
$codigo= $_POST['codigo'];
$nombre= $_POST['nombre'];
$rtn= $_POST['rtn'];
$direccion= $_POST['direccion'];
$telefono=$_POST['telefono'];
$correo= $_POST['correo'];
$estado= $_POST['estado'];

$queryVerificar = mysqli_query($db, "SELECT COUNT(*) as Existe FROM proveedores WHERE Id_Proveedor = '$codigo' AND RTN_Proveedor = '$rtn'") or die (mysqli_error());
    
	$rowExiste=mysqli_fetch_array($queryVerificar);
	if($rowExiste['Existe']==0){
		#echo 'No existe';
	}
	if ($rowExiste['Existe']==1) {
$sql=mysqli_query($db,"UPDATE proveedores SET  Nombre_Proveedor='$nombre',RTN_Proveedor='$rtn', Direccion='$direccion', Telefono='$telefono', Correo_Electronico='$correo', Estado= $estado  WHERE Id_Proveedor='$codigo' AND RTN_Proveedor='$rtn'") or die(mysqli_error());	echo 'Guardado';
        }
            
    // } else {
    //     header('location: page_denegado.php');
    // }
?>
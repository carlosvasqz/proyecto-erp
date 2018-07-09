<?php
include ('../../inc/conexion.php');
 include ('../../inc/util.php');
//$empleado=$_GET['empleado'];
$codigo_conversiones=$_POST['codigo_conversiones'];
$tipo=$_POST['tipo'];
$Id_Articulo=$_POST['Id_Articulo'];
$cantidad_inicial=$_POST['cantidad_inicial'];
$cantidad_final=$_POST['cantidad_final'];
$justificacion=$_POST['justificacion'];
$Fecha = date('Y/m/d H:i'); 

//echo $identidad.' - '.$nombre.' - '.$direccion.' - '.$telefono;
//echo "// INSERT INTO proveedores (Id_Proveedor, Nombre_Proveedor, RTN_Proveedor, Direccion, Telefono, Correo_Electronico, Estado) VALUES ('$codigo','$nombre','$rtn','$direccion','$telefono','$correo', $estado); //";
$sql=mysqli_query($db,"INSERT INTO `conversiones`(`Id_Conversion`, `Id_Articulo`, `Cantidad_Inicial`, `Cantidad_Final`, `Tipo`, `Justificacion`, `Fecha`)VALUES ('$codigo_conversiones','$Id_Articulo',$cantidad_inicial, $cantidad_final, $tipo,'$justificacion','$Fecha')") or die(mysqli_error());


$queryVerificar = mysqli_query($db, "SELECT Tipo FROM conversiones WHERE Id_Conversion = '$codigo_conversiones'") or die (mysqli_error());
    
	$rowTipo=mysqli_fetch_array($queryVerificar);
	if($rowTipo['Tipo']==1){
$sql=mysqli_query($db,"UPDATE articulos SET Existencias= Existencias + '$cantidad_final' WHERE Id_Articulo='$Id_Articulo'") or die(mysqli_error());
}
	if ($rowTipo['Tipo']==0) {
           $sql=mysqli_query($db,"UPDATE articulos SET Existencias= Existencias - '$cantidad_final' WHERE Id_Articulo='$Id_Articulo'") or die(mysqli_error());
}
        
            
    // } else {
    //     header('location: page_denegado.php');
    // }
?>
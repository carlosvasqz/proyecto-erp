
<?php
include ('../../inc/conexion.php');
 include ('../../inc/util.php');
//$empleado=$_GET['empleado'];
$codigo=$_POST['codigo'];
$nombre=$_POST['nombre'];
$rtn=$_POST['rtn'];
$direccion=$_POST['direccion'];
$telefono=$_POST['telefono'];
$correo=$_POST['correo'];
$estado=$_POST['estado'];

//echo $identidad.' - '.$nombre.' - '.$direccion.' - '.$telefono;
//echo "// INSERT INTO proveedores (Id_Proveedor, Nombre_Proveedor, RTN_Proveedor, Direccion, Telefono, Correo_Electronico, Estado) VALUES ('$codigo','$nombre','$rtn','$direccion','$telefono','$correo', $estado); //";
$queryVerificar = mysqli_query($db,"SELECT COUNT(*) as Existe FROM proveedores WHERE RTN_Proveedor = '$rtn'") or die(mysqli_error());

$rowExiste=mysqli_fetch_array($queryVerificar);
if($rowExiste['Existe']==0){
$queryGuardar = mysqli_query($db, "INSERT INTO proveedores (Id_Proveedor, Nombre_Proveedor, RTN_Proveedor, Direccion, Telefono, Correo_Electronico, Estado) VALUES ('$codigo','$nombre','$rtn','$direccion','$telefono','$correo', $estado);") or die(mysqli_error());
echo 'Guardado';
}
	if ($rowExiste['Existe']==1) {
            #echo 'Ya existe';
        }
            
    // } else {
    //     header('location: page_denegado.php');
    // }
?>
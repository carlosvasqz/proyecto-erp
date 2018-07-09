<style type= "text/css">
#incorrecto{
	color:red;
	font-weight: bold;
}
#correcto{
	color:green;
	font-weight: bold;
}
</style>
<?php
include ('../../inc/conexion.php');
//$empleado=$_GET['empleado'];
$codigo=$_POST['codigo'];
$nombre=$_POST['nombre'];
$rtn=$_POST['rtn'];
$direccion=$_POST['direccion'];
$telefono=$_POST['telefono'];
$correo=$_POST['correo'];
$estado=$_POST['estado'];

//echo $identidad.' - '.$nombre.' - '.$direccion.' - '.$telefono;
//echo "INSERT INTO empleados (Identidad,Nombre,Direccion,Telefono) VALUES ('$identidad','$nombre','$direccion','$telefono')";
$sql1=mysqli_query($db,"SELECT COUNT(*) as existe FROM proveedores WHERE Id_Proveedor='$codigo'") or die(mysqli_error());
$row1=mysqli_fetch_array($sql1);
if ($row1['existe']==1){
	//header("location:proveedores_registrar.php");
echo '<span id="incorrecto">ERROR: El Numero de Proveedor ' .$codigo. ', Ya existe, Ingrese otra por favor </span>';
?>
<script type="text/javascript">
	$('input[name=codigo]').focus();
	$('input[name=nombre]').val("");
	$('input[name=rtn]').val("");
	$('input[name=direccion]').val("");
	$('input[name=telefono]').val("");
	$('input[name=correo]').val("");
	$('input[name=estado]').val("");
</script>
<?php
}
if ($row1['existe']==0){
$sql=mysqli_query($db,"INSERT INTO proveedores(Id_Proveedor, Nombre_Proveedor, RTN_Proveedor, Direccion, Telefono, Correo_Electronico, Estado) VALUES ('$codigo','$nombre',$rtn,'$direccion',$telefono,'$correo', $estado)") or die(mysqli_error());
//header("location:proveedores_registrar.php");
echo '<span id="correcto">Agregado Con Exito.</span>';
?>
<script type="text/javascript">
$('input[name=codigo]').val("");
	$('input[name=nombre]').val("");
	$('input[name=rtn]').val("");
	$('input[name=direccion]').val("");
	$('input[name=telefono]').val("");
	$('input[name=correo]').val("");
	$('input[name=estado]').val("");
  
	$("#correcto").fadeOut(3000);
	</script>
	<?php
}
	?>
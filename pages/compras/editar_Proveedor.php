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
$Id=$_GET['Id'];
$nombre=$_GET['nombre'];
$rtn=$_GET['rtn'];
$direccion=$_GET['direccion'];
$telefono=$_GET['telefono'];
$correo=$_GET['correo'];
$estado=$_GET['estado'];
$sql=mysqli_query($db,"UPDATE proveedores SET  Nombre_Proveedor='$nombre',RTN_Proveedor='$rtn', Direccion='$direccion', Telefono='$telefono', Correo_Electronico='$correo', Estado='$estado' WHERE Id_Proveedor='$Id'") or die(mysqli_error());

header("location:proveedores_editar.php?Id=$Id");
echo '<span id="correcto">Modificado Con Exito.</span>';
?>
<script type="text/javascript">
	$('input[name=nombre]').val("");
	$('input[name=rtn]').val("");
	$('input[name=direccion]').val("");
	$('input[name=telefono]').val("");
	$('input[name=correo]').val("");
	$('input[name=estado]').val("");
  
	$("#correcto").fadeOut(3000);
	</script>
	<?php

	?>
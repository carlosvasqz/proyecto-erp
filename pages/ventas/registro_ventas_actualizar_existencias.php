<?php 
    include('../../inc/conexion.php');

    $id_articulo=$_POST['id_articulo'];
    $cantidad=$_POST['cantidad'];
    $fecha=$_POST['fecha'];

    $queryExistenciaActual=mysqli_query($db, "SELECT Existencias FROM articulos WHERE Id_Articulo = '$id_articulo';") or die(mysqli_error());
    $rowExistenciaActual=mysqli_fetch_array($queryExistenciaActual);

    $rowExistenciaActual['Existencias'] -= $cantidad;

    $sqlActualizarExistencia = "UPDATE articulos SET Existencias=".$rowExistenciaActual['Existencias'].", Fecha_Ultima_Venta='".$fecha."' WHERE Id_Articulo = '$id_articulo'";
    // echo $sqlActualizarExistencia;
    // exit();
    $queryActualizarExistencia=mysqli_query($db, $sqlActualizarExistencia)or die(mysqli_error());

    // echo $sqlActualizarExistencia . "\n";
    echo "Existencias actualizadas";

    exit()
?>
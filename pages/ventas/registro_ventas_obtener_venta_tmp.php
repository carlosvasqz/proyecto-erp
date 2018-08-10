<?php 
    include('../../inc/conexion.php');

    $tmp_num_venta=$_POST['tmp_num_venta'];

    $sqlDatosVenta = "SELECT * FROM ventas_tmp WHERE Id_Venta_Tmp = '$tmp_num_venta'";
    $queryVentaDetalles=mysqli_query($db, $sqlDatosVenta) or die(mysqli_error());

    $rowVentaDetalles=mysqli_fetch_array($queryVentaDetalles);

    $datosVenta = array("Id_Venta_Tmp" => $rowVentaDetalles['Id_Venta_Tmp'], "Id_Cliente" => $rowVentaDetalles['Id_Cliente'], "Id_Usuario" => $rowVentaDetalles['Id_Usuario'], "Fecha" => $rowVentaDetalles['Fecha'], "Sub_Total" => $rowVentaDetalles['Sub_Total'], "Impuesto" => $rowVentaDetalles['Impuesto'], "Total" => $rowVentaDetalles['Total']);

    header('Content-type: application/json; charset=utf-8');
        
    echo json_encode($datosVenta);

    exit();
?>
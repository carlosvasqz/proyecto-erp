<?php 
    include('../../inc/conexion.php');

    $tmp_num_venta=$_POST['tmp_num_venta'];

    $detallesVenta = array();

    $sqlVentaDetalles = "SELECT * FROM detalles_venta_tmp WHERE Id_Venta_Tmp='$tmp_num_venta'";
    // echo $sqlVentaDetalles;
    // exit();
    $queryVentaDetalles=mysqli_query($db, $sqlVentaDetalles) or die(mysqli_error());
    // echo $sqlVentaDetalles."\n";
    // $index = 0;
    // while($rowVentaDetalles=mysqli_fetch_object($queryVentaDetalles)){
    while($rowVentaDetalles=mysqli_fetch_array($queryVentaDetalles)){

    	$sqlDescripcionProducto = "SELECT Descripcion FROM articulos WHERE Id_Articulo = '".$rowVentaDetalles['Id_Articulo']."';";
    	$queryDescripcionProducto = mysqli_query($db, $sqlDescripcionProducto) or die(mysqli_error());
    	$rowDescripcionProducto = mysqli_fetch_array($queryDescripcionProducto);
        // echo $sqlDescripcionProducto."\n";
        $detallesVenta[] = array("Num_Detalle" => $rowVentaDetalles['Num_Detalle_Tmp'], "Id_Venta" => $rowVentaDetalles['Id_Venta_Tmp'], "Id_Articulo" => $rowVentaDetalles['Id_Articulo'], "Descripcion" => $rowDescripcionProducto['Descripcion'], "Cantidad" => $rowVentaDetalles['Cantidad'], "Precio" => $rowVentaDetalles['Precio'], "Total_Detalle" => $rowVentaDetalles['Total_Detalle']);

        // $detallesVenta[$index] = $rowVentaDetalles['Num_Detalle'];
        // $detallesVenta[$index] = $rowVentaDetalles['Id_Producto'];
        // $detallesVenta[$index] = $rowDescripcionProducto['Descripcion_Producto'];
        // $detallesVenta[$index] = $rowVentaDetalles['Cantidad'];
        // $detallesVenta[$index] = $rowVentaDetalles['Precio_Unitario'];
        // $detallesVenta[$index] = $rowVentaDetalles['Total_Producto'];

        // $index++;
    }

    header('Content-type: application/json; charset=utf-8');
        
    echo json_encode($detallesVenta);
    // echo json_encode($detallesVenta, JSON_FORCE_OBJECT);

    exit();
?>
<?php 
    include('../../inc/conexion.php');

    $codVentaTmp=$_POST['tmp_codigo'];
    $subtotal=$_POST['tmp_subtotal'];
    //$descuento=$_POST['tmp_descuento'];
    $isv=$_POST['tmp_isv'];
    $total=$_POST['tmp_total'];

    $numDetalle=$_POST['tmp_num_detalle'];
    $codArticulo=$_POST['tmp_id_articulo'];
    $cantidad=$_POST['tmp_cantidad_nueva'];
    $precio=$_POST['tmp_precio'];
    $totalArticulo=$_POST['tmp_total_articulo'];

    // echo "SELECT COUNT(*) AS Existe FROM detalles_venta_tmp WHERE Id_Venta_Tmp='$codVentaTmp' AND Id_Articulo='$codArticulo';";
    // exit();

    // Consulta para verificar existencia de la factura en proceso
    $queryVentaTmpExiste=mysqli_query($db,"SELECT COUNT(*) AS Existe FROM ventas_tmp WHERE Id_Venta_Tmp='$codVentaTmp';")or die(mysqli_error());
    $rowVentaTmpExiste=mysqli_fetch_array($queryVentaTmpExiste);

    if($rowVentaTmpExiste['Existe']>0){

        $sqlDetalleTmpExiste = "SELECT COUNT(*) AS Existe FROM detalles_venta_tmp WHERE Num_Detalle_Tmp = '$numDetalle' AND Id_Venta_Tmp = '$codVentaTmp';";
        $queryDetalleTmpExiste=mysqli_query($db, $sqlDetalleTmpExiste)or die(mysqli_error());
        $rowDetalleTmpExiste=mysqli_fetch_array($queryDetalleTmpExiste);        

        if ($rowDetalleTmpExiste['Existe']>0) {

            $queryEliminarDetalle = mysqli_query($db, "DELETE FROM detalles_venta_tmp WHERE Num_Detalle_Tmp = '$numDetalle' AND Id_Venta_Tmp = '$codVentaTmp';")or die(mysqli_error());

            $queryActualizarVentaTmp = mysqli_query($db, "UPDATE ventas_tmp SET Sub_Total = $subtotal, Descuento = 0, Impuesto = $isv, Total = $total")or die(mysqli_error());

            echo 'Actualizada';
        } else {
            echo 'Detalle No Existe';
        }
    } else {
        echo "Venta No Existe";
    }                                                                                                   
?> 

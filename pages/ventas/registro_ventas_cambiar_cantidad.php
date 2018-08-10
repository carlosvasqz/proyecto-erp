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
    
    // echo $codigo_venta_tmp . " | " . $codigo_usuario . " | " . $fecha . " | " . $codigo_cliente;
    // exit();

        // echo "SELECT COUNT(*) AS Existe FROM detalles_venta_tmp WHERE Id_Venta_Tmp='$codVentaTmp' AND Id_Articulo='$codArticulo';";
        // exit();

    // Consulta para verificar existencia de la factura en proceso
    $queryArticuloTmpExiste=mysqli_query($db,"SELECT COUNT(*) AS Existe FROM detalles_venta_tmp WHERE Id_Venta_Tmp='$codVentaTmp' AND Id_Articulo='$codArticulo';")or die(mysqli_error());
    $rowArticuloTmpExiste=mysqli_fetch_array($queryArticuloTmpExiste);
    // echo "Verificando existencia de factura temporal...\n";
    if($rowArticuloTmpExiste['Existe']>0){
        // echo "La factura no existe\n";

        // echo "SELECT Existencias FROM articulos WHERE Id_Articulo = '$codArticulo';";
        // exit();

        $sqlExistencia = "SELECT Existencias FROM articulos WHERE Id_Articulo = '$codArticulo';";
        $queryExistencia=mysqli_query($db, $sqlExistencia)or die(mysqli_error());
        $rowExistencia=mysqli_fetch_array($queryExistencia);        
        $existencia = $rowExistencia['Existencias'];
        // echo 'Con existencia = ' . $rowExistencia['Existencia'] . "\n";
        if ($cantidad <= $existencia) {

            // Consulta para obtener el siguiente numero del detalle -- Forma manual de AUTO INCREMENT
            // $queryNuevoNumeroDetalle=mysqli_query($db,"SELECT MAX(Num_Detalle_Tmp)+1 AS Nuevo_Numero FROM detalles_venta_tmp WHERE Id_Venta_Tmp='$codVentaTmp';")or die(mysqli_error());
            // $rowNuevoNumeroDetalle=mysqli_fetch_array($queryNuevoNumeroDetalle);
            // // echo "Obteniendo nuevo numero de detalle\n";
            // $tmp_num_detalle = $rowNuevoNumeroDetalle['Nuevo_Numero'];
            // // echo "Numero obtenido=".$tmp_num_detalle."\n";
            // if ($tmp_num_detalle==0||$tmp_num_detalle==null) {
            //     $tmp_num_detalle = 1;
            // }

            // $codVentaTmp = explode('.', $codVentaTmp);
            // $codVentaTmp = $codVentaTmp[1];

            // echo '"INSERT INTO detalles_venta_tmp(Num_Detalle_Tmp, Id_Venta_Tmp, Id_Articulo, Precio, Cantidad, Total_Detalle) VALUES('.$tmp_num_detalle.', "'.$codVentaTmp.'", "'.$codArticulo.'", '.$precio.', '.$cantidad.', '.$totalArticulo.');';
            // exit();

            // Insercion de una nueva factura en la tabla de facturas temporales

            // echo "UPDATE ventas_tmp SET Sub_Total=$subtotal,Descuento=0,Impuesto=$isv,Total=$total WHERE Id_Venta_Tmp= '$codVentaTmp'";
            // echo "UPDATE detalles_venta_tmp SET Precio=$precio,Cantidad=$cantidad,Total_Detalle=$totalArticulo WHERE Num_Detalle_Tmp = $numDetalle AND Id_Venta_Tmp = $codVentaTmp AND Id_Articulo = '$codArticulo' ;";
            // exit();

            $actualizarEncabezado = mysqli_query($db,"UPDATE ventas_tmp SET Sub_Total=$subtotal,Descuento=0,Impuesto=$isv,Total=$total WHERE Id_Venta_Tmp= '$codVentaTmp'")or die(mysqli_error());
            $queryInsertarArticuloTmp=mysqli_query($db,"UPDATE detalles_venta_tmp SET Precio=$precio,Cantidad=$cantidad,Total_Detalle=$totalArticulo WHERE Num_Detalle_Tmp = $numDetalle AND Id_Venta_Tmp = $codVentaTmp AND Id_Articulo = '$codArticulo' ;")or die(mysqli_error());
            
            // echo "Ha sido creada\n";
            echo 'Guardada';
        } else {
            echo 'Insuficiente';
        }
    } else {
        echo "No Existe";
        // Actualizacion de una factura en la tabla de facturas temporales
        //$queryModificarArticuloTmp=mysqli_query($db,"UPDATE detalles_venta_tmp SET Id_Articulo = $codArticulo, Precio = $precio, Cantidad = $cantidad, Total_Detalle = $totalArticulo WHERE Id_Venta_Tmp=$codVentaTmp;")or die(mysqli_error());
        //$actualizarEncabezado = mysqli_query($db,"UPDATE ventas_tmp SET Sub_Total=$subtotal,Descuento=0,Impuesto=$isv,Total=$total WHERE Id_Venta_Tmp= '$codVentaTmp'")or die(mysqli_error());
        // echo "Ha sido actualizada\n";
    }                                                                                                   
?> 

<?php 
    include('../../inc/conexion.php');

    $codigo_venta_tmp=$_POST['codigo_venta_tmp'];
    $codigo_usuario=$_POST['codigo_usuario'];
    $fecha=$_POST['fecha'];
    $codigo_cliente=$_POST['codigo_cliente'];

    // echo $codigo_venta_tmp . " | " . $codigo_usuario . " | " . $fecha . " | " . $codigo_cliente;
    // exit();

    // Consulta para verificar existencia de la factura en proceso
    $queryVentaTmpExiste=mysqli_query($db,"SELECT COUNT(*) AS Existe_Venta FROM ventas_tmp WHERE Id_Venta_Tmp='$codigo_venta_tmp';")or die(mysqli_error());
    $rowVentaTmpExiste=mysqli_fetch_array($queryVentaTmpExiste);
    // echo "Verificando existencia de factura temporal...\n";
    if($rowVentaTmpExiste['Existe_Venta']>0){
        // echo "La factura ya existe\n";
        // Actualizacion de una factura en la tabla de facturas temporales
        $queryModificarVentaTmp=mysqli_query($db,"UPDATE ventas_tmp SET Id_Cliente = '$codigo_cliente', Id_Usuario = '$codigo_usuario', fecha = '$fecha' WHERE Id_Venta_Tmp=$codigo_venta_tmp;")or die(mysqli_error());
        // echo "Ha sido actualizada\n";
    } else { 
        // echo "La factura no existe\n";
        // Insercion de una nueva factura en la tabla de facturas temporales
        $queryInsertarVentaTmp=mysqli_query($db,"INSERT INTO ventas_tmp(Id_Venta_Tmp, Id_Cliente, Id_Usuario, Fecha) VALUES('$codigo_venta_tmp', '$codigo_cliente', '$codigo_usuario', '$fecha');")or die(mysqli_error());
        // echo "Ha sido creada\n";
    }                                                                                                   

    echo "Venta temporal guardada";
?> 
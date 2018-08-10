<?php 
    include('../../inc/conexion.php');

    $Num_Detalle=$_POST['Num_Detalle'];
    $Id_Venta = $_POST['Id_Venta'];
    $Id_Articulo=$_POST['Id_Articulo'];
    $Cantidad=$_POST['Cantidad'];
    $Precio=$_POST['Precio'];
    $Total_Detalle=$_POST['Total_Detalle'];

    $sqlAgregarDetalleFactura= "INSERT INTO detalles_venta(Num_Detalle, Id_Venta, Id_Articulo, Precio, Cantidad, Total_Detalle) VALUES($Num_Detalle, $Id_Venta, '$Id_Articulo', $Precio, $Cantidad, $Total_Detalle);";
    // echo $sqlAgregarDetalleFactura;
    // exit();
    $queryAgregarDetalleFactura=mysqli_query($db, $sqlAgregarDetalleFactura) or die(mysqli_error());

    echo "Detalles registrados";

    exit()
?>
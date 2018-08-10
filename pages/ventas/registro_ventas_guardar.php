<?php 
    include('../../inc/conexion.php');

    $Id_Venta = $_POST['Id_Venta'];
    $Id_Venta_Tmp = $_POST['Id_Venta_Tmp'];
    $Id_Cliente = $_POST['Id_Cliente'];
    $Id_Usuario = $_POST['Id_Usuario'];
    $Fecha = $_POST['Fecha'];
    $Sub_Total = $_POST['Sub_Total'];
    $Impuesto = $_POST['Impuesto'];
    $Total = $_POST['Total'];

    // echo "Antes del query\n";
    $sqlEstaAgregado = "SELECT COUNT(*) AS Existe FROM ventas WHERE Id_Venta = '$Id_Venta';";
    $queryEstaAgregado=mysqli_query($db, $sqlEstaAgregado)or die(mysqli_error());
    $rowEstaAgregado=mysqli_fetch_array($queryEstaAgregado);
    // echo "\n". $sqlEstaAgregado . "\n";
    if($rowEstaAgregado['Existe']>0){
        echo "Venta ya existe";
    } else {

        $sqlAgregarVenta= "INSERT INTO ventas(Id_Venta, Id_Cliente, Id_Usuario, Fecha, Sub_Total, Impuesto, Total) VALUES ($Id_Venta,'$Id_Cliente','$Id_Usuario','$Fecha',$Sub_Total,$Impuesto,$Total);";
        // echo $sqlAgregarVenta;
        // exit();
        $queryAgregarVenta=mysqli_query($db, $sqlAgregarVenta) or die(mysqli_error());

        echo "Venta registrada";

    }

?>
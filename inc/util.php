<?php
    date_default_timezone_set('America/Tegucigalpa');

    function dayToDia($day){
        switch ($day) {
            case 'Sunday':
                return 'Domingo';
                break;
            case 'Monday':
                return 'Lunes';
                break;
            case 'Tuesday':
                return 'Martes';
                break;
            case 'Wednesday':
                return 'Miercoles';
                break;
            case 'Thursday':
                return 'Jueves';
                break;
            case 'Friday':
                return 'Viernes';
                break;
            case 'Saturday':
                return 'Sabado';
                break;
        }
    }

    function monthToMes($mes){
        switch ($mes) {
            case 'January':
                return 'Enero';
                break;
            case 'February':
                return 'Febrero';
                break;
            case 'March':
                return 'Marzo';
                break;
            case 'April':
                return 'Abril';
                break;
            case 'May':
                return 'Mayo';
                break;
            case 'June':
                return 'Junio';
                break;
            case 'July':
                return 'Julio';
                break;
            case 'August':
                return 'Agosto';
                break;
            case 'September':
                return 'Septiembre';
                break;
            case 'October':
                return 'Octubre';
                break;
            case 'November':
                return 'Noviembre';
                break;
            case 'December':
                return 'Diciembre';
                break;
        }
    }

    function fechaIngAEsp($fecha){
        $fecha = explode('-', $fecha);
        return $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0];
    }

    function fechaIngABD($fecha){
        $fecha = explode('/', $fecha);
        return $fecha[2] . "-" . $fecha[0] . "-" . $fecha[1];
    }

    function fechaBDAIng($fecha){
        $fecha = explode('-', $fecha);
        return $fecha[1] . "/" . $fecha[2] . "/" . $fecha[0];
    }

    function fechaBDAEsp($fecha){
        $fecha = explode('-', $fecha);
        return $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0];
    }

    function fechaFormato($fecha){
        $fecha = explode('/', $fecha);
        $diaMes = mktime(0,0,0,rtrim($fecha[1]),trim($fecha[0]),ltrim($fecha[2]));
        $diaFormat = date("j", $diaMes) . " / " . monthToMes(date("F", $diaMes)) . " / " . date("Y", $diaMes) ;
        return $diaFormat;
    }

    function fechaFullFormato($fecha){
        $fecha = explode('/', $fecha);
        $diaMes = mktime(0,0,0,rtrim($fecha[1]),trim($fecha[0]),ltrim($fecha[2]));
        $diaFullFormat = dayToDia(date("l", $diaMes)) . " " . date("j", $diaMes) . ", " . monthToMes(date("F", $diaMes)) . " de " . date("Y", $diaMes) ;
        return $diaFullFormat;
    }

    function anioDeFecha($fecha){
        $fecha = explode('-', $fecha);
        return $fecha[0];
    }

    function obtenerUltimoCodigoEmpleado(){
        include ("conexion.php");
        $query = "SELECT MAX(Codigo_Empleado) AS Ultimo_Codigo FROM empleados;";
        $sqlcon = mysqli_query($db, $query) or die(mysqli_error());
        $rowCodigo=mysqli_fetch_array($sqlcon);
        if(is_null($rowCodigo['Ultimo_Codigo'])){
            return "EMP.0";
        }else{
            return $rowCodigo['Ultimo_Codigo'];
        }
    }

    function obtenerUltimoCodigoVenta(){
        include ("conexion.php");
        $query = "SELECT MAX(Id_Venta) AS Ultima_Venta FROM ventas;";
        $sqlcon = mysqli_query($db, $query) or die(mysqli_error());
        $rowCodigo=mysqli_fetch_array($sqlcon);
        if(is_null($rowCodigo['Ultima_Venta'])){
            return "VNT.0";
        }else{
            return $rowCodigo['Ultima_Venta'];
        }
    }

    function obtenerUltimoCodigoUsuario(){
        include ("conexion.php");
        $query = "SELECT MAX(Id_Usuario) AS Ultimo_Codigo FROM usuarios;";
        $sqlcon = mysqli_query($db, $query) or die(mysqli_error());
        $rowCodigo=mysqli_fetch_array($sqlcon);
        if(is_null($rowCodigo['Ultimo_Codigo'])){
            return "USU.0";
        }else{
            return $rowCodigo['Ultimo_Codigo'];
        }
    }

    function obtenerUltimoCodigoCliente(){
        include ("conexion.php");
        $query = "SELECT MAX(Id_Cliente) AS Ultimo_Codigo FROM clientes;";
        $sqlcon = mysqli_query($db, $query) or die(mysqli_error());
        $rowCodigo=mysqli_fetch_array($sqlcon);
        if(is_null($rowCodigo['Ultimo_Codigo'])){
            return "CLI.0";
        }else{
            return $rowCodigo['Ultimo_Codigo'];
        }
    }

     function obtenerUltimoCodigoCategoria(){
        include ("conexion.php");
        $query = "SELECT MAX(Id_Categoria) AS Ultimo_Codigo FROM categorias;";
        $sqlcon = mysqli_query($db, $query) or die(mysqli_error());
        $rowCodigo=mysqli_fetch_array($sqlcon);
        if(is_null($rowCodigo['Ultimo_Codigo'])){
            return "CAT.0";
        }else{
            return $rowCodigo['Ultimo_Codigo'];
        }
    }

      function obtenerUltimoCodigoArticulo(){
        include ("conexion.php");
        $query = "SELECT MAX(Id_Articulo) AS Ultimo_Codigo FROM articulos;";
        $sqlcon = mysqli_query($db, $query) or die(mysqli_error());
        $rowCodigo=mysqli_fetch_array($sqlcon);
        if(is_null($rowCodigo['Ultimo_Codigo'])){
            return "ART.0";
        }else{
            return $rowCodigo['Ultimo_Codigo'];
        }
    }

    function nuevoCodigo($codigo){
        $codigo = explode('.', $codigo);
        $nuevo = $codigo[1]+1;
        if ($nuevo<10) {           
            return $codigo[0] . ".0000" . $nuevo;
        }
        else if ($nuevo<100) {           
            return $codigo[0] . ".000" . $nuevo;
        }
        else if ($nuevo<1000) {
            return $codigo[0] . ".00" . $nuevo;  
        }
        else if ($nuevo<10000) {
            return $codigo[0] . ".0" . $nuevo; 
        }
        else{
            return $codigo[0] . "." . $nuevo;
        }
    }


    function totalClientes($codigo){

        $queryTotalClientes=mysqli_query($db, "SELECT COUNT(*) AS Total_Clientes FROM clientes") or die(mysqli_error());
        $rowClientes=mysqli_fetch_array($queryTotalClientes);
        $rowClientes['Total_Clientes'];
        
        return $rowClientes;
        // mysqli_close($queryTotalEmpleados);           
    }

    function nuevoCodigoCliente($codigo){
        $codigo = explode('.', $codigo);
        $nuevo = $codigo[1]+1;
        return $codigo[0] . "." . $nuevo;
    }
    function obtenerUltimoCodigoConversiones(){
        include ("conexion.php");
        $query = "SELECT MAX(Id_Conversion) AS Ultimo_Codigo FROM conversiones;";
        $sqlcon = mysqli_query($db, $query) or die(mysqli_error());
        $rowCodigo=mysqli_fetch_array($sqlcon);
        if(is_null($rowCodigo['Ultimo_Codigo'])){
            return "CON.0";
        }else{
            return $rowCodigo['Ultimo_Codigo'];
        }
    }
    function nuevoCodigoConversiones($codigo){
        $codigo = explode('.', $codigo);
        $nuevo = $codigo[1]+1;
        return $codigo[0] . "." . $nuevo;
    }
    function obtenerUltimoCodigoProveedor(){
        include ("conexion.php");
        $query = "SELECT MAX(Id_Proveedor) AS Ultimo_Codigo FROM proveedores;";
        $sqlcon = mysqli_query($db, $query) or die(mysqli_error());
        $rowCodigo=mysqli_fetch_array($sqlcon);
        if(is_null($rowCodigo['Ultimo_Codigo'])){
            return "PRO.0";
        }else{
            return $rowCodigo['Ultimo_Codigo'];
        }
    }

     function nuevoCodigoProveedor($codigo){
        $codigo = explode('.', $codigo);
        $nuevo = $codigo[1]+1;
        return $codigo[0] . "." . $nuevo;
    }

 function obtenerUltimoCodigoRegistro_Compra(){
        include ("conexion.php");
        $query = "SELECT MAX(Id_Compra) AS Ultimo_Codigo FROM compras;";
        $sqlcon = mysqli_query($db, $query) or die(mysqli_error());
        $rowCodigo=mysqli_fetch_array($sqlcon);
        if(is_null($rowCodigo['Ultimo_Codigo'])){
            return "REGC.0";
        }else{
            return $rowCodigo['Ultimo_Codigo'];
        }
    }

     function nuevoCodigoRegistro_Compra($codigo){
        $codigo = explode('.', $codigo);
        $nuevo = $codigo[1]+1;
        return $codigo[0] . "." . $nuevo;
    }




function obtenerUltimoCodigofacturacompra(){
        include ("conexion.php");
        $query = "SELECT MAX(Id_Factura) AS Ultimo_Codigo FROM facturas_compra;";
        $sqlcon = mysqli_query($db, $query) or die(mysqli_error());
        $rowCodigo=mysqli_fetch_array($sqlcon);
        if(is_null($rowCodigo['Ultimo_Codigo'])){
            return "FACO.0";
        }else{
            return $rowCodigo['Ultimo_Codigo'];
        }
    }

     function nuevoCodigofacturacompras($codigo){
        $codigo = explode('.', $codigo);
        $nuevo = $codigo[1]+1;
        return $codigo[0] . "." . $nuevo;
    }

















    function obtenerUltimoCodigoCotizacion_Compra(){
        include ("conexion.php");
        $query = "SELECT MAX(Id_Cotizacion_compra) AS Ultimo_Codigo FROM cotizaciones_compra;";
        $sqlcon = mysqli_query($db, $query) or die(mysqli_error());
        $rowCodigo=mysqli_fetch_array($sqlcon);
        if(is_null($rowCodigo['Ultimo_Codigo'])){
            return "0";
        }else{
            return $rowCodigo['Ultimo_Codigo']+1;
        }
    }

     function nuevoCodigoCotizacion_Compra($codigo){
        $codigo = explode('.', $codigo);
        $nuevo = $codigo[1]+1;
        return $codigo[0] . "." . $nuevo;
    }


?>

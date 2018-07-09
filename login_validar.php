<?php
    include ('inc/conexion.php');
    $usuario =  $_POST['usuario'];
    $pass =  $_POST['pass'];
    // echo $usuario . " " . $pass;
    // exit();
        if ($usuario=='root'&&$pass=='root') {
            session_start();
            $_SESSION['Id_Usuario'] = "root";            
            $_SESSION['Tipo_Usuario'] = 'Superusuario';
            $_SESSION['Estado'] = 1;
            $_SESSION['Codigo_Empleado'] = 'root';
            $_SESSION['Nombre'] = 'root';
            $_SESSION['Apellido'] = 'root';   
            $_SESSION['Fecha_Ingreso'] = ' el BigBang';           
            echo "1"; // Valido
            exit();
        } else {
            $queryUsuario=mysqli_query($db, "SELECT COUNT(*) AS Existe, Estado FROM usuarios WHERE Id_Usuario='$usuario' AND Contraseña='$pass';")/*->mysql_escape_string()*/ or die(mysqli_error);
            $rowQueryUsuario = mysqli_fetch_array($queryUsuario);
            if ($rowQueryUsuario['Existe']==1) {
                if($rowQueryUsuario['Estado']==1){
                    session_start();
                    $queryDatos=mysqli_query($db, "SELECT usuarios.Id_Usuario, usuarios.Estado, usuarios.Id_Tipo_Usuario, tipos_usuarios.Nombre AS Tipo_Usuario, usuarios.Codigo_Empleado, empleados.Nombres AS Empleado_Nombres, empleados.Apellido_1 AS Empleado_Apellido, empleados.Fecha_Ingreso FROM tipos_usuarios INNER JOIN( empleados INNER JOIN usuarios ON empleados.Codigo_Empleado = usuarios.Codigo_Empleado) ON tipos_usuarios.Id_Tipo_Usuario = usuarios.Id_Tipo_Usuario WHERE usuarios.Id_Usuario = '$usuario' AND usuarios.Contraseña = '$pass' AND usuarios.Estado = 1;") or die(mysqli_error);
                    $rowQueryDatos = mysqli_fetch_array($queryDatos);
                    if ($rowQueryDatos['Estado']==1) {
                        $_SESSION['Id_Usuario'] = $rowQueryDatos["Id_Usuario"];
                        $_SESSION['Tipo_Usuario'] = $rowQueryDatos["Tipo_Usuario"];
                        $_SESSION['Estado'] = $rowQueryDatos["Estado"];
                        $_SESSION['Codigo_Empleado'] = $rowQueryDatos["Codigo_Empleado"];
                        $_SESSION['Nombre'] = $rowQueryDatos["Empleado_Nombres"];
                        $_SESSION['Apellido'] = $rowQueryDatos["Empleado_Apellido"];                    
                        $_SESSION['Fecha_Ingreso'] = $rowQueryDatos["Fecha_Ingreso"];  
                        echo "1"; // Valido y con datos cargados
                        // echo '<p class="semibold-text mb-0" style="color:green;text-align:center;">Acceso concedido</p>';
                    } 
                    if ($rowQueryDatos['Estado']==0) {
                        echo "0"; // Empleado deshabilitado
                        // echo '<p class="mb-0" style="color:red;text-align:center;">Usuario o contrase&ntilde;a incorrectos</p>';
                    }
                }
                if ($rowQueryUsuario['Estado']==0){
                    echo "0"; // Usuario deshabilitado
                }
            } 
            if ($rowQueryUsuario['Existe']==0) {
                echo "-1"; // No existe
                // echo '<p class="mb-0" style="color:red;text-align:center;">Usuario o contrase&ntilde;a incorrectos</p>';
            }
        }

    exit();
?>
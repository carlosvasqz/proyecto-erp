<?php
    session_start();
    // if (isset($_SESSION['Id_Usuario'])&&isset($_SESSION['Tipo_Usuario'])&&isset($_SESSION['Codigo_Empleado'])) {  
        session_destroy();
        header('Location: login.php');
    // } else {
    //     echo 'ERROR';
    // }
?>
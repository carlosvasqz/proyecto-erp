<?php
    session_start();    
    echo '<h2>$_SESSION</h2>';
    foreach ($_SESSION as $key => $value) {
        echo $key . ' => ' . $value . '<br>';
    }

    // echo "<h2>Sin session_start()</h2>";
    // echo 'Id_Usuario = ' . $_SESSION['Id_Usuario'] . '<br>';
    // echo 'Tipo_Usuario = ' . $_SESSION['Tipo_Usuario'] . '<br>';
    // echo 'Estado = ' . $_SESSION['Estado'] . '<br>';
    // echo 'Codigo_Empleado = ' . $_SESSION['Codigo_Empleado'] . '<br>';
    // echo 'Nombre = ' . $_SESSION['Nombre'] . '<br>';
    // echo 'Apellido = ' . $_SESSION['Apellido'] . '<br>';

    // echo "<h2>Con session_start()</h2>";
    // echo 'Id_Usuario = ' . $_SESSION['Id_Usuario'] . '<br>';
    // echo 'Tipo_Usuario = ' . $_SESSION['Tipo_Usuario'] . '<br>';
    // echo 'Estado = ' . $_SESSION['Estado'] . '<br>';
    // echo 'Codigo_Empleado = ' . $_SESSION['Codigo_Empleado'] . '<br>';
    // echo 'Nombre = ' . $_SESSION['Nombre'] . '<br>';
    // echo 'Apellido = ' . $_SESSION['Apellido'] . '<br>';

    echo '<h2>URL</h2>';
    echo 'HTTP_HOST = ' . $_SERVER['HTTP_HOST'] . '<br>';
    echo 'REQUEST_URI = ' . $_SERVER['REQUEST_URI'] . '<br>';
    echo 'PHP_SELF = ' . $_SERVER['PHP_SELF'];
    
    echo '<h2>$_SERVER</h2>';
    foreach ($_SERVER as $key => $value) {
        echo $key . ' => ' . $value . '<br>';
    }

    echo '<h2>$_POST</h2>';
    foreach ($_POST as $key => $value) {
        echo $key . ' => ' . $value . '<br>';
    }

    echo '<h2>$_GET</h2>';
    foreach ($_GET as $key => $value) {
        echo $key . ' => ' . $value . '<br>';
    }
?>
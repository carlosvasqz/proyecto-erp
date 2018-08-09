<?php
$manejador="mysql";
$servidor="localhost";
$usuario="root";
$pass="";
$base="proyecto_erp";
$cadena="$manejador:host=$servidor;dbname=$base";
$cnx = new PDO($cadena,$usuario,$pass);
?>
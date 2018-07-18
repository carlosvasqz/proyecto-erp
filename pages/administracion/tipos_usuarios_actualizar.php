<?php
	//session_start();
	//if (isset($_SESSION['username'])&&($_SESSION['type'])) { 

        include ('../../inc/conexion.php');
        include ('../../inc/util.php');
         
         $tipos = $_POST['id_tipos'];
         $nomb = $_POST['nombre'];
         $desc = $_POST['des'];
         $estado = $_POST['estado'];


    
  $queryVerificar = mysqli_query($db, "SELECT COUNT(*) as Existe FROM tipos_usuarios WHERE Id_Tipo_Usuario = '$tipos'") or die (mysqli_error());
    
    $rowExiste=mysqli_fetch_array($queryVerificar);
    if($rowExiste['Existe']==0){

    }
    if ($rowExiste['Existe']==1) {
            $queryActualizar = mysqli_query($db, "UPDATE tipos_usuarios SET Nombre='$nomb',Descripcion='$desc', Estado=$estado WHERE Id_Tipo_Usuario='$tipos'") or die(mysqli_error());
            echo 'Guardado';
        }
            
?>
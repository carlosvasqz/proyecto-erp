<?php
  $cd = "http://" . $_SERVER['HTTP_HOST'];
  $uri = explode("/", $_SERVER['REQUEST_URI']);
  if (in_array('proyecto-erp', $uri)) {
    foreach ($uri as $key => $value) {
      if ($value == 'proyecto-erp') {
        $cd .= "/" . $value . '/';
        break;
      } else {
        if(!empty($value) ){
          $cd .= '/' . $value;
        }
      }
    }
  } else {
    $cd .= '/';
  }

  $thisFileName = end($uri);
  $thisFileName = explode(".", $thisFileName);
  $thisFileName = $thisFileName[0];
  $relative;
  if ($thisFileName=='index'||$thisFileName=='lockscreen'||$thisFileName=='login'){
    $relative = '';
  } else {
    $relative = '../../';
  }

  include($relative.'inc/conexion.php');
  include($relative.'inc/util.php');
  include($relative.'inc/constructor.php');

  // echo $relative.'inc/constructor.php';
  // exit();
  session_start();
  if (!isset($_SESSION['Id_Usuario'])&&!isset($_SESSION['Tipo_Usuario'])&&!isset($_SESSION['Codigo_Empleado'])) {
    header("Location: ".$cd."login.php", true);
    die();
  } else {
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MaterialAdminLTE 2 | Bloqueo de Pantalla</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo $cd;?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $cd;?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Sweet Alert CSS -->
  <link rel="stylesheet" href="<?php echo $cd;?>plugins/sweet-alert/sweetalert.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo $cd;?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $cd;?>dist/css/AdminLTE.min.css">
  <!-- Material Design -->
  <link rel="stylesheet" href="<?php echo $cd;?>dist/css/bootstrap-material-design.min.css">
  <link rel="stylesheet" href="<?php echo $cd;?>dist/css/ripples.min.css">
  <link rel="stylesheet" href="<?php echo $cd;?>dist/css/MaterialAdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $cd;?>dist/css/skins/all-md-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="<?php echo $cd;?>index.php">Material<b>Admin</b>LTE</a>
  </div>
  <!-- User name -->
  <div class="lockscreen-name"><?php echo $_SESSION['Nombre']." ".$_SESSION['Apellido'];?></div>
  <div class="lockscreen-name"><small id="usuario"><?php echo $_SESSION['Id_Usuario'];?></small></div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="<?php echo $cd;?>dist/img/user1-128x128.jpg" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials">
      <div class="input-group">
        <input type="password" id="pass" class="form-control" placeholder="Contraseña">

        <div class="input-group-btn">
          <button type="button" class="btn" id="btnEntrar"><i class="fa fa-arrow-right text-muted"></i></button>
        </div>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
    Ingrese su contraseña de acceso para renovar la sesión.
  </div>
  <div class="text-center">
    <a href="<?php echo $cd;?>login.php">O inicie sesión con un usuario diferente.</a>
  </div>
  <!-- <div class="lockscreen-footer text-center">
    Copyright &copy; 2014-2018 <a href="http://almsaeedstudio.com"><b>Almsaeed Studio</b></a>, <br> 
	<a href="https://fezvrasta.github.io"><b>Federico Zivolo</b></a> and <a href="https://ducthanhnguyen.github.io"><b>Thanh Nguyen</b></a>. All rights reserved
  </div> -->
</div>
<!-- /.center -->

<!-- jQuery 3 -->
<script src="<?php echo $cd;?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $cd;?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Material Design -->
<script src="<?php echo $cd;?>dist/js/material.min.js"></script>
<script src="<?php echo $cd;?>dist/js/ripples.min.js"></script>
<script>
    $.material.init();
</script>
<!-- bootstrap notify -->
<script src="plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
<!-- Sweet Alert -->
<script src="plugins/sweet-alert/sweetalert.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    function alertaIngresarDatos(){
      $.notify({
        title: "Error : ",
        message: "Por favor, complete los campos obligatorios",
        icon: 'fa fa-times' 
      },{
        type: "danger"
      });
    }

    function validar(usuario, pass){
      $.ajax({
        //Direccion destino
        url: "login_validar.php",
        // Variable con los datos necesarios
        data: "usuario=" + usuario + "&pass=" + pass,
        type: "POST",			
        dataType: "html",
        //cache: false,
        //success
        success: function (data) {
          // alert(data);
          if (data) {
            data = data.trim();
            // setTimeout(function () {
            //   setTimeout(function () {
                
              // }, 2000);
              // setTimeout(function () {
              if (data==="1") {
                // setTimeout(function () {
                  swal({
                    title: "<span class='text-green'>¡Correcto!</span>",
                    text: "Redirigiendo...",
                    type: "success",
                    html: true,
                    // timer: 2000,
                    showCancelButton: false,
                    showConfirmButton: false,
                    // confirmButtonText: "Aceptar",
                    closeOnConfirm: false
                  // }, function(isConfirm) {
                  //   if (isConfirm) {
                      // $(location).attr('href', 'index.php');
                  //   }
                  });
                  window.setTimeout('javascript:window.history.back();', 2000);
                // }, 2000);
              } 
              if (data==="0"){
                swal({
                  title: "<span class='text-yellow'>¡Advertencia!</span>",
                  text: "Sus credenciales de acceso han sido deshabilitadas.",
                  type: "warning",
                  html: true,
                  showCancelButton: false,
                  confirmButtonText: "Aceptar",
                  closeOnConfirm: true
                });
              }
              if (data==="-1") {
                swal({
                  title: "<span class='text-red'>¡Error!</span>",
                  text: "Las credenciales son inválidas, compruebe los datos ingresados.",
                  type: "error",
                  html: true,
                  showCancelButton: false,
                  confirmButtonText: "Aceptar",
                  closeOnConfirm: true
                });
              }
          //   }, 2000);
          // }, 4000);
          }
          if (!data) {
            swal({
              title: "¡Error!",
              text: "Ha ocurrido un problema, inténtelo más tarde.",
              type: "error",
              showCancelButton: false,
              confirmButtonText: "Aceptar",
              closeOnConfirm: true
            });
          }
        },
        error : function(xhr, status) {
            alert('Disculpe, existió un problema');
        },
        complete : function(xhr, status) {
          // alert('Petición realizada');
          // $.notify({
          // 		title: "Informacion : ",
          // 		message: "Petición realizada!",
          // 		icon: 'fa fa-check' 
          // 	},{
          // 		type: "info"
          // });
        }		
      });
    }

    $("#btnEntrar").click(function(){
      var usuario = $("#usuario").html().trim();
      var pass = $("#pass").val();
      if (usuario=='') {
        alertaIngresarDatos();
        return false;
      }

      if (pass=='') {
        $("#pass").attr('required',true);
        document.getElementById("pass").focus();
        alertaIngresarDatos();
        return false;
      } else {
        $("#pass").attr('required',false);
      }
      validar(usuario, pass);
    });
  });
</script>
</body>
</html>
<?php
  session_destroy();
  }
?>
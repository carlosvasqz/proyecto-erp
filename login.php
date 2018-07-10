<?php
  $uri = explode("/", $_SERVER['REQUEST_URI']);
  $thisFileName = end($uri);
  $thisFileName = explode(".", $thisFileName);
  $thisFileName = $thisFileName[0];
  $cd = null;
  if ($thisFileName=='index'){
    $cd = '';
  } else {
    $cd = '../../';
  }
  // $cd .= $_SERVER['SERVER_NAME'];
  if ($_SERVER['SERVER_NAME'] = 'localhost') {
    $cd = $_SERVER['SERVER_NAME'] . '/proyecto-erp/' . $cd;
  }
  session_start();
  if (!isset($_SESSION['Id_Usuario'])&&!isset($_SESSION['Tipo_Usuario'])&&!isset($_SESSION['Codigo_Empleado'])) {
    header("Location: ".$cd."login.php");
    die();
  } else {
    include ($cd.'inc/constructor.php');
    include ($cd.'inc/conexion.php');
    include ($cd.'inc/util.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MaterialAdminLTE 2 | Iniciar Sesión</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- Material Design -->
  <link rel="stylesheet" href="dist/css/bootstrap-material-design.min.css">
  <link rel="stylesheet" href="dist/css/ripples.min.css">
  <link rel="stylesheet" href="dist/css/MaterialAdminLTE.min.css">
  <!-- Sweet Alert CSS -->
  <link rel="stylesheet" href="plugins/sweet-alert/sweetalert.css">
  <!-- iCheck -->
  <!-- <link rel="stylesheet" href="plugins/iCheck/square/blue.css"> -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
  <link rel="stylesheet" href="dist/css/fonts.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#">Material<b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Ingresa tus credenciales para Iniciar Sesión</p>

    <!-- <form action="index2.php" method="post"> -->
      <div class="form-group has-feedback">
        <input type="text" class="form-control" id="usuario" placeholder="Usuario">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="pass" placeholder="Contraseña">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-7">
          <div class="checkbox">
            <!-- <label>
              <input type="checkbox"> Remember Me
            </label> -->
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-5">
          <button type="button" class="btn btn-primary btn-raised btn-block btn-flat" id="btnEntrar">Entrar</button>
        </div>
        <!-- /.col -->
      </div>
    <!-- </form> -->

    <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->

    <!-- <a href="#">I forgot my password</a><br> -->
    <!-- <a href="register.php" class="text-center">Register a new membership</a> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Material Design -->
<script src="dist/js/material.min.js"></script>
<script src="dist/js/ripples.min.js"></script>
<script>
    $.material.init();
</script>
<!-- bootstrap notify -->
<script src="plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
<!-- Sweet Alert -->
<script src="plugins/sweet-alert/sweetalert.min.js"></script>
<!-- iCheck -->
<!-- <script src="plugins/iCheck/icheck.min.js"></script> 
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });-->
<!-- </script> -->
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

    function overlay(){
      swal({
        title: "<div class='overlay'><i class='fa fa-refresh fa-spin fa-2x'></i></div>",
        text: "Comprobando las credenciales ingresadas.",
        html: true,
        showCancelButton: false,
        timer: 2000,
        showConfirmButton: false
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
                  window.setTimeout('location.href="index.php"', 2000);
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
      var usuario = $("#usuario").val();
      var pass = $("#pass").val();
      if (usuario=='') {
        $("#usuario").attr('required',true);
        document.getElementById("usuario").focus();
        alertaIngresarDatos();
        return false;
      } else {
        $("#usuario").attr('required',false);
      }

      if (pass=='') {
        $("#pass").attr('required',true);
        document.getElementById("pass").focus();
        alertaIngresarDatos();
        return false;
      } else {
        $("#pass").attr('required',false);
      }
      // setTimeout(overlay(), 2000);
      validar(usuario, pass);
    });
  });
</script>
</body>
</html>
<?php
  }
?>
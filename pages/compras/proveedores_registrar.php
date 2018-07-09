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
  session_start();
  if (!isset($_SESSION['Id_Usuario'])&&!isset($_SESSION['Tipo_Usuario'])&&!isset($_SESSION['Codigo_Empleado'])) {  
    header("Location: ".$cd."403.php");
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
  <title>MaterialAdminLTE 2 | Registrar Proveedor</title>
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
<body class="skin-blue sidebar-mini fixed">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo $cd;?>index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">M<b>A</b>L</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Material<b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $cd;?>dist/img/user-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['Nombre']." ".$_SESSION['Apellido'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $cd;?>dist/img/user-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo $_SESSION['Id_Usuario']." - ".$_SESSION['Tipo_Usuario'] ;?>
                  <small>Miembro desde <?php echo anioDeFecha($_SESSION['Fecha_Ingreso']);?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="<?php echo $cd;?>pages/configuraciones/perfil.php">Perfil</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="<?php echo $cd;?>lockscreen.php">Bloquear</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="<?php echo $cd;?>logout.php">Salir</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <!-- <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat"><i class="fa fa-user"></a>
                </div>
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat"><i class="fa fa-lock"></i></a>
                </div>
                <div class="pull-right">
                  <a href="<?php //echo $cd;?>logout.php" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></a>
                </div>
              </li> -->
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $cd;?>dist/img/user-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['Nombre']." ".$_SESSION['Apellido'];?></p>
          <a href="#"><i class="fa fa-user"></i> <?php echo $_SESSION['Codigo_Empleado'];?></a>          
        </div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php
        menu($_SESSION['Tipo_Usuario'], $thisFileName);
      ?>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Registrar Proveedor
        <small>Compras</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Compras</a></li>
        <li class="active">Registrar Proveedor</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
      <!-- columna izq -->
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Datos Administrativos</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal">
            <div class="box-body">
              <div class="form-group" id="form_codigo">
                <label for="codigo" class="col-sm-2 control-label">Codigo*</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Codigo" value="<?php echo nuevoCodigoProveedor(obtenerUltimoCodigoProveedor());?>" readonly>
                </div>
              </div>
              
              <div class="form-group" id="form_estado">
                <label for="estado"  class="col-sm-2 control-label">Estado*</label>

                <div class="col-sm-9">
                  <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="estado" value="1" checked>
                      Habilitado
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="estado" value="0">
                      Desabilitado
                    </label>
                  </div>
                </div>
              </div>
              <!-- <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"> Remember me
                    </label>
                  </div>
                </div>
              </div> -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <!-- <button type="submit" class="btn btn-default">Cancel</button>
              <button type="submit" class="btn btn-info pull-right">Sign in</button> -->
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Datos Personales</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
           <form class="form-horizontal">
            <div class="box-body">
              <div class="form-group" id="form_nombre">
                  <label for="nombre" class="col-sm-2 control-label">Nombre Proveedor</label>
                  <div class="col-sm-9">
                  <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese Nombre">

                </div>
                </div>
     
              <div class="form-group" id="form_rtn">
                <label for="rtn" class="col-sm-2 control-label">RTN*</label>

                <div class="col-sm-9">
                  <input type="text"  name="rtn" class="form-control" data-inputmask="&quot;mask&quot;: &quot;9999-9999-999999&quot;" data-mask id="rtn" placeholder="Ingrese el numero...">
                </div>
              </div>
             
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <!-- <button type="submit" class="btn btn-default">Cancel</button>
              <button type="submit" class="btn btn-info pull-right">Sign in</button> -->
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Datos de Contacto</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal">
            <div class="box-body">
              <div class="form-group" id="form_direccion">
                <label for="direccion" class="col-sm-2 control-label">Direccion*</label>

                <div class="col-sm-9">
                  <textarea class="form-control" name="direccion" rows="3" id="direccion" placeholder="Ingrese la direccion ..."></textarea>
                </div>
              </div>
              
              <div class="form-group" id="form_telefono">
                <label for="telefono" class="col-sm-2 control-label">Telefono*</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" data-inputmask="&quot;mask&quot;: &quot;(999) 9999-9999&quot;" data-mask id="telefono" name="telefono" placeholder="Ingrese el numero..">
                </div>
              </div>

              <div class="form-group" id="form_correo">
                <label for="correo" class="col-sm-2 control-label">Email*</label>

                <div class="col-sm-9">
                  <input type="email" name="correo" class="form-control" id="correo" placeholder="Ingrese el email..">
                </div>
              </div>
              <!-- <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"> Remember me
                    </label>
                  </div>
                </div>
              </div> -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <!-- <button type="submit" class="btn btn-default">Cancel</button>
              <button type="submit" class="btn btn-info pull-right">Sign in</button> -->
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
        <!-- Horizontal Form -->
        <div class="box box-info">
          <!-- <div class="box-header with-border"> -->
            <!-- <h3 class="box-title">Acciones</h3> -->
          <!-- </div> -->
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal">
            <div class="box-body">
              <div class="col-sm-4"></div>
              <div class="col-sm-4">
                <button type="button" id="btnCancelar" class="btn btn-default">Cancelar</button>
                <button type="button" id="btnRegistrar" class="btn btn-success pull-right">Registrar</button>
              </div>
              <div class="col-sm-4"></div>
            </div>
            <!-- /.box-body -->
          </form>
        </div>
      </div>
      <!--/.col (izq) -->
    </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->  

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2018 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>, <a href="https://fezvrasta.github.io">Federico Zivolo</a> and <a href="https://ducthanhnguyen.github.io">Thanh Nguyen</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

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
<!-- DataTables -->
<script src="<?php echo $cd;?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $cd;?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo $cd;?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap notify -->
<script src="<?php echo $cd;?>plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo $cd;?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo $cd;?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- InputMask -->
<script src="<?php echo $cd;?>plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo $cd;?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo $cd;?>plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $cd;?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo $cd;?>dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#lista-empleados').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });
    //Date picker
  
  })
  $(document).ready(function () {
    $('.sidebar-menu').tree();
    $('[data-mask]').inputmask()
    // $('#lista-empleados').DataTable();

    function alertaIngresarDatos(){
      $.notify({
        title: "Error : ",
        message: "Por favor, complete los campos obligatorios",
        icon: 'fa fa-times' 
      },{
        type: "danger"
      });
    }

    $("#btnCancelar").click(function(){
      $(location).attr('href', 'proveedores.php');
    });

    $("#btnRegistrar").click(function(){
      //Obtencion de valores en los inputs
     var codigo=$('#codigo').val();
     var estado=$('input[name="optionsRadios"]:checked').val();
var nombre=$('#nombre').val();
var rtn=$('#rtn').val();
var direccion=$('#direccion').val();
var telefono=$('#telefono').val();
var correo=$('#correo').val();

      
      // Validaciones
      if (codigo=='') {
        $("#codigo").attr('required',true);
        document.getElementById("codigo").focus();
        $("#form_codigo").removeClass('has-success');
        $("#form_codigo").removeClass('has-error');
        $("#form_codigo").addClass('has-error');
        alertaIngresarDatos();
        return false;
      } else {
        $("#codigo").attr('required',false);
        $("#form_codigo").removeClass('has-success');
        $("#form_codigo").removeClass('has-error');
        $("#form_codigo").addClass('has-success');
      }

      
      if (estado=='') {
        $("#estado").attr('required',true);
        document.getElementById("estado").focus();
        $("#form_estado").removeClass('has-success');
        $("#form_estado").removeClass('has-error');
        $("#form_estado").addClass('has-error');
        alertaIngresarDatos();
        return false;
      } else {
        $("#estado").attr('required',false);
        $("#form_estado").removeClass('has-success');
        $("#form_estado").removeClass('has-error');
        $("#form_estado").addClass('has-success');
      }
       if (nombre=='') {
        $("#nombre").attr('required',true);
        document.getElementById("nombre").focus();
        $("#form_nombre").removeClass('has-success');
        $("#form_nombre").removeClass('has-error');
        $("#form_nombre").addClass('has-error');
        alertaIngresarDatos();
        return false;
      } else {
        $("#nombre").attr('required',false);
        $("#form_nombre").removeClass('has-success');
        $("#form_nombre").removeClass('has-error');
        $("#form_nombre").addClass('has-success');
      }

      if (rtn=='') {
        $("#rtn").attr('required',true);
        document.getElementById("rtn").focus();
        $("#form_rtn").removeClass('has-success');
        $("#form_rtn").removeClass('has-error');
        $("#form_rtn").addClass('has-error');
        alertaIngresarDatos();
        return false;
      } else {
        $("#rtn").attr('required',false);
        $("#form_rtn").removeClass('has-success');
        $("#form_rtn").removeClass('has-error');
        $("#form_rtn").addClass('has-success');
      }

      if (direccion=='') {
        $("#direccion").attr('required',true);
        document.getElementById("direccion").focus();
        $("#form_direccion").removeClass('has-success');
        $("#form_direccion").removeClass('has-error');
        $("#form_direccion").addClass('has-error');
        alertaIngresarDatos();
        return false;
      } else {
        $("#direccion").attr('required',false);
        $("#form_direccion").removeClass('has-success');
        $("#form_direccion").removeClass('has-error');
        $("#form_direccion").addClass('has-success');
      }

      if (telefono=='') {
        $("#telefono").attr('required',true);
        document.getElementById("telefono").focus();
        $("#form_telefono").removeClass('has-success');
        $("#form_telefono").removeClass('has-error');
        $("#form_telefono").addClass('has-error');
        alertaIngresarDatos();
        return false;
      } else {
        $("#telefono").attr('required',false);
        $("#form_telefono").removeClass('has-success');
        $("#form_telefono").removeClass('has-error');
        $("#form_telefono").addClass('has-success');
      }

      if (correo=='') {
        $("#correo").attr('required',true);
        document.getElementById("correo").focus();
        $("#form_correo").removeClass('has-success');
        $("#form_correo").removeClass('has-error');
        $("#form_correo").addClass('has-error');
        alertaIngresarDatos();
        return false;
      } else {
        $("#correo").attr('required',false);
        $("#form_correo").removeClass('has-success');
        $("#form_correo").removeClass('has-error');
        $("#form_correo").addClass('has-success');
      }
      //Fin validaciones

      // Variable con todos los valores necesarios para la consulta
      var datos = 'codigo=' + codigo + '&estado=' + estado + '&nombre=' + nombre + '&rtn=' + rtn + '&direccion=' + direccion  + '&telefono=' + telefono + '&correo=' + correo;

      // alert(datos);
      $.ajax({
        //Direccion destino
        url: "guardar_proveedor.php",
        // Variable con los datos necesarios
        data: datos,
        type: "POST",     
        dataType: "html",
        //cache: false,
        //success
        success: function (data) {
          // alert(data);
          if (data) {
            $.notify({
              title: "Correcto : ",
              message: "¡El proveedor se registró exitosamente!",
              icon: 'fa fa-check' 
            },{
              type: "success"
            });
            window.setTimeout('location.href="proveedores.php"', 5);
          }
          if (!data) {
            $.notify({
              title: "Error : ",
              message: "¡El numero de RTN ingresado ya existe!",
              icon: 'fa fa-times' 
            },{
              type: "danger"
            });
            document.getElementById("rtn").focus();
            $("#form_rtn").removeClass('has-success');
            $("#form_rtn").removeClass('has-error');
            $("#form_rtn").addClass('has-error');
          }
          
        },
        error : function(xhr, status) {
          //  alert('Disculpe, existió un problema');
        },
        complete : function(xhr, status) {
          // alert('Petición realizada');
          // $.notify({
          //    title: "Informacion : ",
          //    message: "Petición realizada!",
          //    icon: 'fa fa-check' 
          //  },{
          //    type: "info"
          // });
        }   
      });

    });
  })
</script>
</body>
</html>
<?php
  }
?>

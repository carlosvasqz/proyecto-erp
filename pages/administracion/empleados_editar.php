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
    if(!isset($_POST['codigo_empleado'])){
      header("Location: ".$cd."500.php");
      die();
    } else {
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MaterialAdminLTE 2 | Editar Empleado</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo $cd;?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $cd;?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo $cd;?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $cd;?>dist/css/AdminLTE.min.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo $cd;?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
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
                  <small>Miembro desde <?php $foo = $_SESSION['Fecha_Ingreso']; $foo = fechaBDAEsp($foo); $foo = fechaFormato($foo); echo $foo;;?></small>
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
        menu($_SESSION['Tipo_Usuario'], $thisFileName, $cd);
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
        Editar Empleado
        <small>Administracion</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Administracion</a></li>
        <li class="active">Editar Empleado</li>
      </ol>
    </section>

    <?php
      $queryEmpleado=mysqli_query($db, "SELECT * FROM empleados WHERE Codigo_Empleado = '".$_POST['codigo_empleado']."'") or die(mysqli_error());
      $rowEmpleado=mysqli_fetch_array($queryEmpleado);
    ?>

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
                <label for="codigo_empleado" class="col-sm-2 control-label">Codigo*</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" id="codigo_empleado" placeholder="Codigo" value="<?php echo $rowEmpleado['Codigo_Empleado'];?>" disabled>
                </div>
              </div>
              <!-- Date -->
              <div class="form-group" id="form_fecha_ingreso">
                <label for="fecha_ingreso" class="col-sm-2 control-label">Fecha de Ingreso*</label>

                <div class="col-sm-9">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" class="form-control pull-right" id="fecha_ingreso" placeholder="Seleccione la fecha..." value="<?php echo fechaBDAIng($rowEmpleado['Fecha_Ingreso']);?>" readonly>
                  </div>
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group" id="form_estado">
                <label for="codigo_empleado" class="col-sm-2 control-label">Estado*</label>

                <div class="col-sm-9">
                  <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="estado" value="1" <?php if($rowEmpleado['Estado']==1){echo 'checked';} ?>>
                      Habilitado
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="estado" value="0" <?php if($rowEmpleado['Estado']==0){echo 'checked';} ?>>
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
              <div class="form-group" id="form_id_empleado">
                <label for="id_empleado" class="col-sm-2 control-label">Identidad*</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" data-inputmask="&quot;mask&quot;: &quot;9999-9999-99999&quot;" data-mask id="id_empleado" placeholder="Ingrese el numero..." value="<?php echo $rowEmpleado['ID'];?>" disabled>
                </div>
              </div>
              <div class="form-group" id="form_nombres">
                <label for="nombres_empleado" class="col-sm-2 control-label">Nombres*</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" id="nombres_empleado" placeholder="Ingrese los nombres.." value="<?php echo $rowEmpleado['Nombres'];?>">
                </div>
              </div>
              <div class="form-group" id="form_apellido_1">
                <label for="apellido_1" class="col-sm-2 control-label">Apellido Paterno*</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" id="apellido_1" placeholder="Ingrese el apellido.." value="<?php echo $rowEmpleado['Apellido_1'];?>">
                </div>
              </div>
              <div class="form-group" id="form_apellido_2">
                <label for="apellido_2" class="col-sm-2 control-label">Apellido Materno</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" id="apellido_2" placeholder="Ingrese el apellido.. " value="<?php echo $rowEmpleado['Apellido_2'];?>">
                </div>
              </div>
              <!-- Date -->
              <div class="form-group" id="form_fecha_nacimiento">
                <label for="fecha_nacimiento" class="col-sm-2 control-label">Nacimiento*</label>

                <div class="col-sm-9">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" class="form-control pull-right" id="fecha_nacimiento" value="<?php echo fechaBDAIng($rowEmpleado['Fecha_Nacimiento']);?>" readonly>
                  </div>
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group" id="form_genero">
                  <label class="col-sm-2 control-label">Genero*</label>
                  <div class="col-sm-9">
                    <select class="form-control" id="genero">
                      <option value="F" <?php if($rowEmpleado['Genero']=="F"){echo 'selected';} ?>>Femenino</option>
                      <option value="M" <?php if($rowEmpleado['Genero']=="M"){echo 'selected';} ?>>Masculino</option>
                    </select>
                  </div>
                </div>
              <!-- <div class="form-group" id="form_">
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
            <h3 class="box-title">Datos de Contacto</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal">
            <div class="box-body">
              <div class="form-group" id="form_direccion">
                <label for="direccion_empleado" class="col-sm-2 control-label">Direccion*</label>

                <div class="col-sm-9">
                  <textarea class="form-control" rows="3" id="direccion_empleado" placeholder="Ingrese la direccion ..."><?php echo $rowEmpleado['Direccion'];?></textarea>
                </div>
              </div>
              
              <div class="form-group" id="form_telefono">
                <label for="telefono" class="col-sm-2 control-label">Telefono*</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" data-inputmask="&quot;mask&quot;: &quot;(999) 9999-9999&quot;" data-mask id="telefono" placeholder="Ingrese el numero.." value="<?php echo $rowEmpleado['Telefono'];?>">
                </div>
              </div>

              <div class="form-group" id="form_correo">
                <label for="correo_empleado" class="col-sm-2 control-label">Email*</label>

                <div class="col-sm-9">
                  <input type="email" class="form-control" id="correo_empleado" placeholder="Ingrese el email.." value="<?php echo $rowEmpleado['Correo_Electronico'];?>">
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
                <button type="button" id="btnActualizar" class="btn btn-success pull-right">Actualizar</button>
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
    $('#fecha_nacimiento').datepicker({
      autoclose: true
    });
    $('#fecha_ingreso').datepicker({
      autoclose: true
    });
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
      window.setTimeout('location.href="empleados.php"', 1);
    });

    $("#btnActualizar").click(function(){
      //Obtencion de valores en los inputs
      var codigoEmpleado = $("#codigo_empleado").val();
      var fechaIngreso = $("#fecha_ingreso").val();
      var estado = $('input[name="optionsRadios"]:checked').val();
      var idEmpleado = $("#id_empleado").val();
      var nombres = $("#nombres_empleado").val();
      var apellido1 = $("#apellido_1").val();
      var apellido2 = $("#apellido_2").val();
      var fechaNacimiento = $("#fecha_nacimiento").val();
      var genero = $("#genero").val();
      var direccion = $("#direccion_empleado").val();
      var telefono = $("#telefono").val();
      var correo = $("#correo_empleado").val();
      
      // Validaciones
      if (codigoEmpleado=='') {
        $("#codigo_empleado").attr('required',true);
        document.getElementById("codigo_empleado").focus();
        $("#form_codigo").removeClass('has-success');
        $("#form_codigo").removeClass('has-error');
        $("#form_codigo").addClass('has-error');
        alertaIngresarDatos();
        return false;
      } else {
        $("#codigo_empleado").attr('required',false);
        $("#form_codigo").removeClass('has-success');
        $("#form_codigo").removeClass('has-error');
        $("#form_codigo").addClass('has-success');
      }

      if (fechaIngreso=='') {
        $("#fecha_ingreso").attr('required',true);
        document.getElementById("fecha_ingreso").focus();
        $("#form_fecha_ingreso").removeClass('has-success');
        $("#form_fecha_ingreso").removeClass('has-error');
        $("#form_fecha_ingreso").addClass('has-error');
        alertaIngresarDatos();
        return false;
      } else {
        $("#fecha_ingreso").attr('required',false);
        $("#form_fecha_ingreso").removeClass('has-success');
        $("#form_fecha_ingreso").removeClass('has-error');
        $("#form_fecha_ingreso").addClass('has-success');
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

      if (idEmpleado=='') {
        $("#id_empleado").attr('required',true);
        document.getElementById("id_empleado").focus();
        $("#form_id_empleado").removeClass('has-success');
        $("#form_id_empleado").removeClass('has-error');
        $("#form_id_empleado").addClass('has-error');
        alertaIngresarDatos();
        return false;
      } else {
        $("#id_empleado").attr('required',false);
        $("#form_id_empleado").removeClass('has-success');
        $("#form_id_empleado").removeClass('has-error');
        $("#form_id_empleado").addClass('has-success');
      }

      if (nombres=='') {
        $("#nombres_empleado").attr('required',true);
        document.getElementById("nombres_empleado").focus();
        $("#form_nombres").removeClass('has-success');
        $("#form_nombres").removeClass('has-error');
        $("#form_nombres").addClass('has-error');
        alertaIngresarDatos();
        return false;
      } else {
        $("#nombres_empleado").attr('required',false);
        $("#form_nombres").removeClass('has-success');
        $("#form_nombres").removeClass('has-error');
        $("#form_nombres").addClass('has-success');
      }

      if (apellido1=='') {
        $("#apellido_1").attr('required',true);
        document.getElementById("apellido_1").focus();
        $("#form_apellido_1").removeClass('has-success');
        $("#form_apellido_1").removeClass('has-error');
        $("#form_apellido_1").addClass('has-error');
        alertaIngresarDatos();
        return false;
      } else {
        $("#apellido_1").attr('required',false);
        $("#form_apellido_1").removeClass('has-success');
        $("#form_apellido_1").removeClass('has-error');
        $("#form_apellido_1").addClass('has-success');
      }

      if (apellido2=='') {
        // $("#apellido_2").attr('required',true);
        // document.getElementById("apellido_2").focus();
        // $("#form_apellido_2").removeClass('has-success');
        // $("#form_apellido_2").removeClass('has-error');
        // $("#form_apellido_2").addClass('has-error');
        // return false;
      } else {
        $("#apellido_2").attr('required',false);
        $("#form_apellido_2").removeClass('has-success');
        $("#form_apellido_2").removeClass('has-error');
        $("#form_apellido_2").addClass('has-success');
      }

      if (fechaNacimiento=='') {
        $("#fecha_nacimiento").attr('required',true);
        document.getElementById("fecha_nacimiento").focus();
        $("#form_fecha_nacimiento").removeClass('has-success');
        $("#form_fecha_nacimiento").removeClass('has-error');
        $("#form_fecha_nacimiento").addClass('has-error');
        alertaIngresarDatos();
        return false;
      } else {
        $("#fecha_nacimiento").attr('required',false);
        $("#form_fecha_nacimiento").removeClass('has-success');
        $("#form_fecha_nacimiento").removeClass('has-error');
        $("#form_fecha_nacimiento").addClass('has-success');
      }

      if (genero==null) {
        $("#genero").attr('required',true);
        document.getElementById("genero").focus();
        $("#form_genero").removeClass('has-success');
        $("#form_genero").removeClass('has-error');
        $("#form_genero").addClass('has-error');
        alertaIngresarDatos();
        return false;
      } else {
        $("#genero").attr('required',false);
        $("#form_genero").removeClass('has-success');
        $("#form_genero").removeClass('has-error');
        $("#form_genero").addClass('has-success');
      }

      if (direccion=='') {
        $("#direccion_empleado").attr('required',true);
        document.getElementById("direccion_empleado").focus();
        $("#form_direccion").removeClass('has-success');
        $("#form_direccion").removeClass('has-error');
        $("#form_direccion").addClass('has-error');
        alertaIngresarDatos();
        return false;
      } else {
        $("#direccion_empleado").attr('required',false);
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
        $("#correo_empleado").attr('required',true);
        document.getElementById("correo_empleado").focus();
        $("#form_correo").removeClass('has-success');
        $("#form_correo").removeClass('has-error');
        $("#form_correo").addClass('has-error');
        alertaIngresarDatos();
        return false;
      } else {
        $("#correo_empleado").attr('required',false);
        $("#form_correo").removeClass('has-success');
        $("#form_correo").removeClass('has-error');
        $("#form_correo").addClass('has-success');
      }
      //Fin validaciones

      // Variable con todos los valores necesarios para la consulta
		  var datos = 'codigo_empleado=' + codigoEmpleado + '&fecha_ingreso=' + fechaIngreso + '&estado=' + estado + '&id_empleado=' + idEmpleado + '&nombres_empleado=' + nombres + '&apellido_1=' + apellido1 +  '&apellido_2=' + apellido2 + '&fecha_nacimiento=' + fechaNacimiento + '&genero=' + genero + '&direccion_empleado=' + direccion + '&telefono=' + telefono + '&correo=' + correo;

      // alert(datos);
      $.ajax({
        //Direccion destino
        url: "empleados_actualizar.php",
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
              message: "¡El empleado se actualizó exitosamente!",
              icon: 'fa fa-check' 
            },{
              type: "success"
            });
            window.setTimeout('location.href="empleados.php"', 5);
          }
          if (!data) {
            $.notify({
              title: "Error : ",
              message: "¡El numero de Identidad ingresado NO existe!",
              icon: 'fa fa-times' 
            },{
              type: "danger"
            });
            document.getElementById("id_empleado").focus();
            $("#form_id_empleado").removeClass('has-success');
            $("#form_id_empleado").removeClass('has-error');
            $("#form_id_empleado").addClass('has-error');
          }
          
        },
        error : function(xhr, status) {
          //  alert('Disculpe, existió un problema');
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

    });
  })
</script>
</body>
</html>
<?php
    }
  }
?>
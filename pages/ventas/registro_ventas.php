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
    $hoy = getdate();
    $idVentaTmp = null;
    // $datosVentaTmp = null;
    $cliente = null;
    $subTotal = 0;
    $descuento = 0;
    $isv = 0;
    $total = 0;
    if (isset($_POST['codigo_venta_tmp'])) {
      $idVentaTmp = $_POST['codigo_venta_tmp'];
  
      $datosVentaTmp = obtenerDatosVentaTmp($idVentaTmp);
      // $detallesVentaTmp = obtenerDetallesVentaTmp($idVentaTmp);
      // usuario
      $fecha_venta = $datosVentaTmp['Fecha'];
      $fecha_venta_formato = fechaBDAEsp($datosVentaTmp['Fecha']);
      $fecha_venta_formato = fechaFullFormato($fecha_venta_formato);
      $cliente = $datosVentaTmp['Id_Cliente'];
      $subTotal = $datosVentaTmp['Sub_Total'];
      $descuento = $datosVentaTmp['Descuento'];
      $isv = $datosVentaTmp['Impuesto'];
      $total = $datosVentaTmp['Total'];	
  
    } else {
      // $idVentaTmp = "is not set";
      $fecha_venta = date("Y-m-d");
      $fecha_venta_formato = fechaFullFormato($hoy['mday']."/".$hoy['mon']."/".$hoy['year']);
      $subTotal = 0;
      $descuento = 0;
      $isv = 0;
      $total = 0;
    }
    $existencias;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MaterialAdminLTE 2 | Registrar Venta</title>
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
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo $cd;?>bower_components/select2/dist/css/select2.min.css">
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
  <style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>
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
                  <small>Miembro desde <?php $foo = $_SESSION['Fecha_Ingreso']; $foo = fechaBDAEsp($foo); $foo = fechaFormato($foo); echo $foo;?></small>
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
        Registrar Venta
        <small>Ventas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Ventas</a></li>
        <li class="active">Registro de Ventas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Datos Administrativos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form class="form-horizontal">
                <div class="form-group" id="form_codigo_venta">
                  <label for="codigo_venta" class="col-sm-2 control-label">Venta*</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="codigo_venta" placeholder="Codigo de venta" value="<?php echo obtenerUltimoCodigoVenta();?>" disabled>
                    <input type="hidden" id="codigo_venta_tmp" value="<?php if(is_null($idVentaTmp)){echo obtenerNuevoIdVentaTmp();}else{echo $idVentaTmp;}?>">
                  </div>
                </div>
                <!-- </form> -->
                <div class="form-group" id="form_usuario">
                  <label for="usuario" class="col-sm-2 control-label">Vendedor*</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="usuario" placeholder="Usuario" value="<?php echo $_SESSION['Nombre'] . " " .$_SESSION['Apellido'];?>" readonly>
                    <input type="hidden" id="codigo_usuario" value="<?php echo $_SESSION['Id_Usuario'];?>">
                  </div>
                </div>
                <div class="form-group" id="form_fecha">
                  <label for="fecha" class="col-sm-2 control-label">Fecha*</label>

                  <div class="col-sm-10">
                    <!-- <div class="input-group"> -->
                      <!-- <span class="input-group-addon"><i class="fa fa-calendar"></i></span> -->
                      <input type="text" class="form-control" id="fecha_formato" placeholder="Fecha" value="<?php echo $fecha_venta_formato;?>" readonly>
                      <input type="hidden" id="fecha" value="<?php echo $fecha_venta;?>">
                    <!-- </div> -->
                  </div>
                </div>
              </form>
                <!-- </form> -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-xs-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Datos del Cliente</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="" class="form-horizontal">
                <div class="form-group" id="form_codigo_cliente">
                  <label for="codigo_cliente" class="col-sm-2 control-label">Codigo*</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="codigo_cliente" placeholder="Codigo de cliente" value="" readonly>
                  </div>
                </div>
                <div class="form-group" id="form_nombre_cliente">
                  <label for="nombre_cliente" class="col-sm-2 control-label">Cliente*</label>

                  <div class="col-sm-10">
                    <select class="form-control select2" id="nombre_cliente" style="width: 100%;">
                      <option value="Seleccione" disabled selected>Seleccione...</option>
                      <?php
                        $queryCliente=mysqli_query($db, "SELECT * FROM clientes WHERE Estado=1;") or die(mysqli_error());
                        while($rowCliente=mysqli_fetch_array($queryCliente)){
                          if ($rowCliente['Id_Cliente']===$cliente) {
                            echo '<option value="'.$rowCliente['Id_Cliente'].'" selected>'.$rowCliente['Nombres'].' '.$rowCliente['Apellido'].'</option>';
                          } else {
                            echo '<option value="'.$rowCliente['Id_Cliente'].'">'.$rowCliente['Nombres'].' '.$rowCliente['Apellido'].'</option>';
                          }
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group" id="form_rtn_cliente">
                  <label for="rtn_cliente" class="col-sm-2 control-label">RTN*</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="rtn_cliente" placeholder="RTN" value="" readonly>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Detalles de la venta</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info" id="modalAgregar">
                  <i class="fa fa-plus"></i> <b>Agregar</b></button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover" id="tablaArticulos" name="">
                <thead>
                  <th>Num Detalle</th>
                  <th>Codigo Articulo</th>
                  <th>Descripcion</th>
                  <th>Cantidad</th>
                  <th>Precio Unitario</th>
                  <th>Total</th>
                  <th>Acciones</th>
                </thead>
                <tbody id="detalles">
                  <?php 
                    if (!is_null($idVentaTmp)){
                      $sqlExisteVenta = "SELECT COUNT(*) AS Existe FROM detalles_venta_tmp WHERE Id_Venta_Tmp = '$idVentaTmp'";
                      $queryExisteVenta=mysqli_query($db, $sqlExisteVenta) or die(mysqli_error());
                      $rowExiste=mysqli_fetch_array($queryExisteVenta);
                      if($rowExiste['Existe']>0){
                        $sqlVentaDetalles = "SELECT Num_Detalle_Tmp, Id_Articulo, Cantidad, Precio, Total_Detalle FROM detalles_venta_tmp WHERE Id_Venta_Tmp = '$idVentaTmp'";
                        $queryVentaDetalles=mysqli_query($db, $sqlVentaDetalles) or die(mysqli_error());
                        while($rowVentaDetalles=mysqli_fetch_array($queryVentaDetalles)){
                          $sqlDescripcionProducto = "SELECT Descripcion FROM articulos WHERE Id_Articulo = '".$rowVentaDetalles['Id_Articulo']."';";
                          $queryDescripcionProducto = mysqli_query($db, $sqlDescripcionProducto) or die(mysqli_error());
                          $rowDescripcionProducto = mysqli_fetch_array($queryDescripcionProducto);
                          echo '<tr id="'.$rowVentaDetalles['Id_Articulo'].'">';
                          echo '<td>'.$rowVentaDetalles['Num_Detalle_Tmp'].'</td>';
                          echo '<td>'.$rowVentaDetalles['Id_Articulo'].'</td>';
                          echo '<td>'.$rowDescripcionProducto['Descripcion'].'</td>';
                          echo '<td>'.$rowVentaDetalles['Cantidad'].'</td>';
                          echo '<td>'.$rowVentaDetalles['Precio'].'</td>';
                          echo '<td>'.$rowVentaDetalles['Total_Detalle'].'</td>';
                          echo '<td>
                            <button class="btn btn-primary btn-sm editarfila" title="Modificar cantidad">
                              <i class="fa fa-pencil"></i>
                            </button>
                            <button class="btn btn-primary btn-sm eliminarfila" title="Quitar de la lista">
                              <i class="fa fa-trash"></i>
                            </button>
                          </td>
                        </tr>
                        ';
                        }
                      } else {
                        echo '<tr>
                        <td>-----</td>
                        <td>-----</td>
                        <td>-----</td>
                        <td>-----</td>
                        <td>-----</td>
                        <td>-----</td>
                        <td>-----</td>
                      </tr>
                      ';
                      }
                    } else {
                      echo '<tr>
                        <td>-----</td>
                        <td>-----</td>
                        <td>-----</td>
                        <td>-----</td>
                        <td>-----</td>
                        <td>-----</td>
                        <td>-----</td>
                      </tr>
                      ';
                    }
                  ?>
                </tbody>
              </table>
              <div class="col-xs-9"></div>
              <div class="col-xs-3">
                <table class="table table-bordered table-hover table-striped" id="" name="">
                  <tbody>
                    <tr>
                      <td>
                        <!-- <div class="form-horizontal"> -->
                          <div class="form-group" id="form_usuario">
                            <label for="sub_total" class="col-sm-3 control-label"><b>SUB</b></label>

                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="sub_total" placeholder="Subtotal" value="<?php echo $subTotal; ?>" readonly>
                            </div>
                          </div>
                        <!-- </div> -->
                        <!-- <div class="form-horizontal"> -->
                          <!-- <div class="form-group" id="form_usuario">
                            <label for="descuento" class="col-sm-3 control-label"><b>DESC</b></label>

                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="descuento" placeholder="Descuento" value="<?php //echo $descuento; ?>" readonly>
                            </div>
                          </div> -->
                          <div class="form-group" id="form_usuario">
                            <label for="isv" class="col-sm-3 control-label"><b>ISV</b></label>

                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="isv" placeholder="ISV" value="<?php echo $isv; ?>" readonly>
                            </div>
                          </div>
                        <!-- </div> -->
                        <!-- <div class="form-horizontal"> -->
                          <div class="form-group" id="form_usuario">
                            <label for="total" class="col-sm-3 control-label"><b>TOTAL</b></label>

                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="total" placeholder="Total" value="<?php echo $total; ?>" readonly>
                            </div>
                          </div>
                        <!-- </div> -->
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <!-- modal default -->
          <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Agregar articulo</h4>
                </div>
                <div class="modal-body">
                <!-- seleccion del articulo -->
                  <form action="" class="form-horizontal">
                    <div class="form-group" id="form_articulo">
                      <label for="articulo" class="col-sm-2 control-label">Articulo*</label>

                      
                      <div class="col-sm-10">
                        <select class="form-control select2" id="articulo" style="width: 100%;">
                          <option value="Seleccione" selected>Seleccione...</option>
                          <?php
                            $queryArticulo=mysqli_query($db, "SELECT * FROM articulos WHERE Estado=1 AND Existencias>0;") or die(mysqli_error());
                            while($rowArticulo=mysqli_fetch_array($queryArticulo)){
                              global $existencias;
                              $existencias = $rowArticulo['Existencias'];
                              echo '<option value="'.$rowArticulo['Id_Articulo'].'">'.$rowArticulo['Id_Articulo'].' | '.$rowArticulo['Descripcion'].'</option>';
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group" id="form_precio">
                      <label for="precio" class="col-sm-2 control-label">Precio*</label>

                      <div class="col-sm-10">
                        <div class="input-group">
                          <span class="input-group-addon" id="current"><b>Lps.</b></span>
                          <input type="number" class="form-control" id="precio" placeholder="Precio" value="0" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="form-group" id="form_cantidad">
                      <label for="cantidad" class="col-sm-2 control-label">Cantidad*</label>

                      <div class="col-sm-10">
                        <div class="input-group">
                          <input type="number" min="1" max="1" step=0 class="form-control" id="cantidad" placeholder="Cantidad" value="1">
                          <span class="input-group-addon" id="existencias"><i>MAX</i></span>
                        </div>
                      </div>
                    </div>
                  </form>
                <!-- fin seleccion del articulo -->
                </div>
                <div class="modal-footer">
                  <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
                  <button type="button" class="btn btn-primary" id="btnAgregar">Agregar</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->
          <!-- modal default -->
          <div class="modal fade" id="modal-cantidad">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Cambiar cantidad</h4>
                </div>
                <div class="modal-body">
                <!-- seleccion del articulo -->
                  <form action="" class="form-horizontal">
                    <input type="hidden" id="num_detalle" value="">
                    <input type="hidden" id="id_articulo" value="">
                    <input type="hidden" id="descripcion_articulo" value="">
                    <input type="hidden" id="precio_articulo" value="">
                    
                    <div class="form-group" id="form_cantidad_anterior">
                      <label for="cantidad_anterior" class="col-sm-2 control-label">Cantidad Anterior*</label>

                      <div class="col-sm-10">
                        <input type="number" min="1" step=0 class="form-control" id="cantidad_anterior" placeholder="Cantidad Anterior" value="">
                      </div>
                    </div>

                    <div class="form-group" id="form_cantidad_nueva">
                      <label for="cantidad_nueva" class="col-sm-2 control-label">Cantidad Nueva*</label>

                      <div class="col-sm-10">
                        <input type="number" min="1" step=0 class="form-control" id="cantidad_nueva" placeholder="Cantidad" value="">
                      </div>
                    </div>
                  </form>
                <!-- fin seleccion del articulo -->
                </div>
                <div class="modal-footer">
                  <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
                  <button type="button" class="btn btn-primary" id="btnCambiar">Cambiar</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->
          <div class="box box-info">
            <!-- <div class="box-header with-border"> -->
              <!-- <h3 class="box-title">Acciones</h3> -->
            <!-- </div> -->
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <div class="col-sm-5"></div>
                <div class="col-sm-2">
                  <!-- <button type="button" id="btnCancelar" class="btn btn-default">Cancelar</button> -->
                  <button type="button" id="btnRegistrar" class="btn btn-success pull-right">Registrar</button>
                </div>
                <div class="col-sm-5"></div>
              </div>
              <!-- /.box-body -->
            </form>
          </div>
        </div>
      </div>
      <!-- /.row -->
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
<!-- Select2 -->
<script src="<?php echo $cd;?>bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- bootstrap notify -->
<script src="<?php echo $cd;?>plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
<!-- DataTables -->
<!-- <script src="<?php echo $cd;?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="<?php echo $cd;?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> -->
<script src="<?php echo $cd;?>plugins/dataTables/jquery.dataTables.min.js"></script>
<script src="<?php echo $cd;?>plugins/dataTables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo $cd;?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo $cd;?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- Sweet Alert -->
<script src="<?php echo $cd;?>plugins/sweet-alert/sweetalert.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $cd;?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo $cd;?>dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#lista').DataTable({
      'paging'      : false,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    });
    $('.select2').select2();
  });

  $(document).ready(function () {
    $('.sidebar-menu').tree();
    // $('#lista-empleados').DataTable();

    function actualizarTabla(tmp_num_venta){
      $.ajax({	
        type: "POST",
        url: "registro_ventas_obtener_detalles_tmp.php",
        data: "tmp_num_venta="+tmp_num_venta,
        dataType: "json",
      })
      .done(function( data, textStatus, jqXHR ){
        console.log(data);
        if (data.length>0) {
          var fila = '';
          $.each(data, function(keyrow, row) {
            fila += '<tr>';
            $.each(row, function(keycol, col) {
              if (keycol!=="Id_Venta") {
                // alert("keycol = " + keycol + " | col = " + col );
                fila +='<td>'+col+'</td>';
              }
            });
              fila += '<td>';
                fila += '<button class="btn btn-primary btn-sm editarfila" title="Modificar cantidad">';
                  fila += '<i class="fa fa-pencil"></i>';
                fila += '</button>';
                fila += '<button class="btn btn-primary btn-sm eliminarfila" title="Quitar de la lista">';
                  fila += '<i class="fa fa-trash"></i>';
                fila += '</button>';
              fila += '</td>';
            fila += '</tr>';
          });
          console.log(fila);
          $("#detalles").html("");
          $("#detalles").html(fila);
        } else {
          $("#detalles").html("");
        }
      })
      .fail(function( data, textStatus, jqXHR ){
        console.log(data);
        alert(".fail");
      });
    }

    function contarDetalles(tmp_num_venta){
      // alert(tmp_num_venta);
      $.ajax({	
        type: "POST",
        url: "registro_ventas_obtener_detalles_tmp.php",
        data: "tmp_num_venta="+tmp_num_venta,
        dataType: "json",
      })
      .done(function( data, textStatus, jqXHR ){
        console.log(data);
        // alert("Estoy aqui");
        console.log(data);
        // return false;
        // alert(data.length);
        if (data.length>0) {
          $.each(data, function(keyrow, row) {
            // alert(tmp_num_venta + " " + row.Num_Detalle + " " + keyrow+1 );
            $.post(
              "registro_ventas_contar_detalles_tmp.php",
              {
                tmp_num_venta: tmp_num_venta,
                tmp_num_detalle: row.Num_Detalle,
                index: keyrow+1
              },
              function (data){
                // alert(data);
                if (data.trim()=="Detalles contados") {
                  actualizarTabla(tmp_num_venta);
                }
              }
            );
          });
        } else {
          actualizarTabla(tmp_num_venta);
        }
      })
      .fail(function( data, textStatus, jqXHR ){
        console.log(data);
        alert(".fail");
      });
    }

    function actualizarExistencias(data, Fecha){
			$.each(data, function(keyrow, row) {
				console.log(row);
				$.post(
					"registro_ventas_actualizar_existencias.php",
					{
						id_articulo: row.Id_Articulo,
						cantidad: row.Cantidad,
            fecha: Fecha
					},
					function (respuesta){
						console.log(respuesta.trim());
						// alert(respuesta.trim());
					}
				);

			});
		}

    function pasarVentaTmpARealizado(id_venta_tmp){
      var Id_Venta = $('#codigo_venta').val();
      Id_Venta = Id_Venta.split(".");
      Id_Venta = Id_Venta[1];
			guardarVentaTemporal();
			// alert("datos obtenidos");
			$.ajax({
					type: "POST",
					url: "registro_ventas_obtener_venta_tmp.php",
					data: "tmp_num_venta="+id_venta_tmp,
					dataType: "json",
				})
				.done(function( data, textStatus, jqXHR ){
          console.log("Probando pasar venta_tmp ");
	        		console.log(data);

	        		$.post(
	        			"registro_ventas_guardar.php",
	        			{
	        				Id_Venta: Id_Venta,
                  Id_Venta_Tmp: data.Id_Venta_Tmp,
	        				Id_Cliente: data.Id_Cliente,
	        				Id_Usuario: data.Id_Usuario,
	        				Fecha: data.Fecha,
	        				Sub_Total: data.Sub_Total,
	        				Impuesto: data.Impuesto,
	        				Total: data.Total       				
	        			},
	        			function (respuesta){
                  console.log(respuesta);
	        				if (respuesta.trim()=="Venta ya existe") {
	        					$.notify({
                      title: "Error : ",
                      message: "La venta ya existe",
                      icon: 'fa fa-times' 
                    },{
                      type: "danger"
                    });
	        					redirigir();
	        				} else {
	        					pasarDetallesFactTmpARealizado(id_venta_tmp, data.Fecha);
	        				}
	        			}
	        		);

				})
				.fail(function( data, textStatus, jqXHR ){
					console.log(data);
					console.log(textStatus);
					console.log(jqXHR);
					alert(".fail pasarVentaTmpARealizado();");
	        	});

		}

		function pasarDetallesFactTmpARealizado(id_venta_tmp, Fecha){
			var Id_Venta = $('#codigo_venta').val();
      Id_Venta = Id_Venta.split(".");
      Id_Venta = Id_Venta[1];

			$.ajax({	
				type: "POST",
				url: "registro_ventas_obtener_detalles_tmp.php",
				data: "tmp_num_venta="+id_venta_tmp,
				dataType: "json",
			})
			.done(function( data, textStatus, jqXHR ){
        console.log(data);

				$.each(data, function(keyrow, row) {
          console.log("Prueba insersion en detalles_venta");
					console.log(row);
					$.post(
						"registro_ventas_guardar_detalles.php",
						{
							Num_Detalle: row.Num_Detalle,
							Id_Venta: Id_Venta,
							Id_Articulo: row.Id_Articulo,
							Cantidad: row.Cantidad,
							Precio: row.Precio,
							Total_Detalle: row.Total_Detalle
						},
						function (respuesta){
              console.log(respuesta);
							// alert(respuesta.trim());
							eliminarFacturaTmp(id_venta_tmp);
							actualizarExistencias(data, Fecha);
						}
					);

				});

			})
			.fail(function( data, textStatus, jqXHR ){
				console.log(data);
				alert(".fail pasarDetallesFactTmpARealizado();");
        	});
		}

		function eliminarFacturaTmp(id_venta_tmp) {
			$.post(
				"registro_ventas_eliminar_venta_tmp.php",
				{
					id_venta_tmp: id_venta_tmp
				},
				function (data){
          console.log(data);
					// alert(data);
					if (data.trim()=="Eliminado") {
						console.log(data.trim());
					}
				}
			);
		}

		function redirigir(){
			$(location).attr('href', 'registro_ventas.php');
		}

    function guardarVentaTemporal(){
      var codigo_venta_tmp = $("#codigo_venta_tmp").val();
      var codigo_usuario = $("#codigo_usuario").val();
      var fecha = $("#fecha").val();
      var codigo_cliente = $("#nombre_cliente").val();
      $.post(
        "registro_ventas_registro_temporal.php",
        {
          codigo_venta_tmp : codigo_venta_tmp,
          codigo_usuario : codigo_usuario,
          fecha : fecha,
          codigo_cliente : codigo_cliente,
        }, function(data){
          // alert(data);
          console.log(data);
        }
      );
    }

    $('#nombre_cliente').change(function(){
      var idCliente = $(this).val();
      if (idCliente=="Seleccione") {
        $('#codigo_cliente').val("");
        $('#rtn_cliente').val("");
      } else {
        $.ajax({
          //Direccion destino
          url: "registro_ventas_datos_cliente.php",
          // Variable con los datos necesarios
          data: "id_cliente=" + idCliente,
          type: "POST",			
          dataType: "json"
        })
        .done(function( data, textStatus, jqXHR ){
        		console.log(data);
        		$('#codigo_cliente').val(data.Codigo_Cliente);
        		$('#rtn_cliente').val(data.RTN);
            guardarVentaTemporal();
        })
        .fail(function( data, textStatus, jqXHR ){
          console.log(data);
          alert(".fail");
        });
      }
    });

    $('#articulo').change(function(){
      var idArticulo = $(this).val();
      if (idArticulo=="Seleccione") {
        $('#precio').val(0);
        // $('#articulo').val("");
        $('#existencias').html("(Max)");
      } else {
        $.ajax({
          //Direccion destino
          url: "registro_ventas_existencias_articulo.php",
          // Variable con los datos necesarios
          data: "id_articulo=" + idArticulo,
          type: "POST",			
          dataType: "json"
        })
        .done(function( data, textStatus, jqXHR ){
        		console.log(data);
        		$('#cantidad').attr('max', data.Existencias);
        		$('#cantidad').val(1);
        		$('#precio').val(data.Precio);
        		$('#existencias').html("<i>(" + data.Existencias + " Max)</i>");
        })
        .fail(function( data, textStatus, jqXHR ){
          console.log(data);
          alert(".fail");
        });
      }
    });

    $('#modalAgregar').click(function(){
      var idCliente = $('#nombre_cliente').val();
      if (idCliente==null){ 
        $.notify({
          title: "Error : ",
          message: "Por favor, seleccione el cliente",
          icon: 'fa fa-times' 
        },{
          type: "danger"
        });
      } else {
        $("#articulo").val("Seleccione");
        $("#precio").val("0");
        $("#cantidad").val("1");
        $('#articulo').focus();
        $('#modal-default').modal('show');
      }
    });

    $("#tablaArticulos").on('click', '.editarfila', function () {
      var num_detalle=$(this).parents("tr").find("td").eq(0).html();
			var id_articulo=$(this).parents("tr").find("td").eq(1).html();
			var descripcion=$(this).parents("tr").find("td").eq(2).html();
			var cantidad=parseFloat($(this).parents("tr").find("td").eq(3).html());
			var precio=parseFloat($(this).parents("tr").find("td").eq(4).html());			

			$("#num_detalle").val(num_detalle).value;
			$("#id_articulo").val(id_articulo).value;
			$("#descripcion_articulo").val(descripcion).value;
			$("#precio_articulo").val(precio).value;
			$("#cantidad_anterior").val(cantidad).value;
      $("#existencias_cantidad").html("")
			$("#cantidad_nueva").val("").value;

			$("#modal-cantidad").modal("show");
			document.getElementById("cantidad_nueva").focus();
    });

    $("#tablaArticulos").on('click', '.eliminarfila', function () {
      var codigoVentaTmp = $('#codigo_venta_tmp').val();
      var num_detalle=$(this).parents("tr").find("td").eq(0).html();
      var id_articulo=$(this).parents("tr").find("td").eq(1).html();
      var descripcion=$(this).parents("tr").find("td").eq(2).html();
      var cantidad=parseFloat($(this).parents("tr").find("td").eq(3).html());
      var precio=parseFloat($(this).parents("tr").find("td").eq(4).html());			
      swal({
        title: "¿Esta seguro?",
        text: "Esta accion descartará el elemento seleccionado",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
    }, function () {
        // alert(" num_detalle = " + num_detalle + " id_articulo = " + id_articulo  + " descripcion = " + descripcion  + " precio = " + precio  + " cantidad = " + cantidad);
        var totalArticulo=precio*cantidad;
        var subtotal=parseFloat(document.getElementById("sub_total").value);
        var isv=parseFloat(document.getElementById("isv").value);
        var total=parseFloat(document.getElementById("total").value);

        subtotal -= totalArticulo;
        isv -= (totalArticulo * 0.15);
        total = (subtotal + isv);

        $.ajax({
          //Direccion destino
          url: "registro_ventas_eliminar_detalle_tmp.php",
          // Variable con los datos necesarios
          data: {
            tmp_codigo: codigoVentaTmp,
            tmp_subtotal: subtotal,
            tmp_isv: isv,
            tmp_total: total,
            tmp_num_detalle: num_detalle,
            tmp_id_articulo: id_articulo,
            tmp_cantidad_nueva: cantidad,
            tmp_precio: precio,
            tmp_total_articulo: totalArticulo
          },
          type: "POST",     
          dataType: "html",
          //cache: false,  
          //success
          success: function (data) {
             //alert(data);
             console.log(data);
            // setTimeout(function () {
              if (data.trim()=="Venta No Existe") {
                $.notify({
                  title: "Error : ",
                  message: "La Venta a actualizar no existe",
                  icon: 'fa fa-times' 
                },{
                  type: "danger"
                });
              }

              if (data.trim()=="Detalle No Existe") {
                $.notify({
                  title: "Error : ",
                  message: "El detalle a eliminar no existe.",
                  icon: 'fa fa-times' 
                },{
                  type: "danger"
                });
              }

              if (data.trim()=="Actualizada"){
                  swal({
                    title: "¡Realizado!",
                    text: "La acción se ha completado con éxito.",
                    type: "success",
                    showCancelButton: false,
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: true
                  }, function(isConfirm) {
                    if (isConfirm) {
                      // $("#result").html(data);
                      // alert(codigoVentaTmp);
                      contarDetalles(codigoVentaTmp);
                      // $('#filaDetalles').append(fila);
                      $('#sub_total').val(subtotal.toFixed(2));
                      $('#isv').val(isv.toFixed(2));
                      $('#total').val(total.toFixed(2));
                    }
                  });
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
            // }, 2000);
          },
          error : function(xhr, status) {
            console.log(xhr);
            console.log(status);
            alert('Disculpe, existió un problema');
          },
          complete : function(xhr, status) {
          }   
        });
      });
		});

    $('#btnAgregar').click(function(){
      var codigoVentaTmp = $('#codigo_venta_tmp').val();
      var idArticuloSeleccionado = $('#articulo').val();
      var cantidadVenta = parseInt($('#cantidad').val());
      var existenciasMax = parseInt($('#cantidad').attr('max'));
      if (idArticuloSeleccionado=='Seleccione'||cantidadVenta==0) {
        // $('#modal-default').modal('hide');
        $('#articulo').attr('required','required');
        document.getElementById("articulo").focus();
        return false;
      } else if (cantidadVenta<1||cantidadVenta>existenciasMax) {
        $('#articulo').attr('required',false);
        $('#cantidad').attr('required','required');
        document.getElementById("cantidad").focus();
        return false;
      } else {
        $('#cantidad').attr('required',false);
        var subtotal=parseFloat($("#sub_total").val());
        var descuento=parseFloat($("#descuento").val());
        var isv=parseFloat($("#isv").val());
        var total=parseFloat($("#total").val());
        var precioFinal = parseFloat($('#precio').val());

        var totalArticulo=precioFinal*cantidadVenta;
        subtotal += totalArticulo;
				isv += (totalArticulo * 0.15);
				total = (subtotal + isv);
				if (total<=0) {
					total=0;
				}
        
        $.post(
          'registro_ventas_registro_detalles_temporal.php',
          {
            tmp_codigo: codigoVentaTmp,
            tmp_subtotal: subtotal,
            tmp_descuento : descuento,
            tmp_isv: isv,
            tmp_total: total,
            tmp_id_articulo: idArticuloSeleccionado,
            tmp_cantidad: cantidadVenta,
            tmp_precio: precioFinal,
            tmp_total_articulo: totalArticulo
          }, function(data){
            // alert(data);
            console.log(data);
            if (data.trim()=="Existe") {
              $('#articulo').attr('required','required');
              document.getElementById("articulo").focus();
              $.notify({
                title: "Error : ",
                message: "El articulo ya se ha agregado",
                icon: 'fa fa-times' 
              },{
                type: "danger"
              });
            } else if (data.trim()=="Guardada") {
              $("#articulo").val("Seleccione");
              $("#precio").val("0");
              $("#cantidad").val("1");
              $('#articulo').focus();
              $('#modal-default').modal('hide');
              // $("#result").html(data);
              actualizarTabla(codigoVentaTmp);
              // $('#filaDetalles').append(fila);
              $('#sub_total').val(subtotal.toFixed(2));
              $('#isv').val(isv.toFixed(2));
              $('#total').val(total.toFixed(2));
            }
          }
        );
      }
    });

    $('#btnCambiar').click(function(){
      var num_detalle = $('#num_detalle').val();
      var id_articulo = $('#id_articulo').val();
      var descripcion_articulo = $('#descripcion_articulo').val();
      var precio_articulo = parseFloat($('#precio_articulo').val());
      var cantidad_anterior = parseFloat($('#cantidad_anterior').val());
      var cantidad_nueva = parseFloat($('#cantidad_nueva').val());

      // alert(" num_detalle = " + num_detalle + " id_articulo = " + id_articulo  + " descripcion_articulo = " + descripcion_articulo  + " precio_articulo = " + precio_articulo  + " cantidad_anterior = " + cantidad_anterior  + " cantidad_nueva = " + cantidad_nueva);

      if ($('#cantidad_nueva').val()==""||cantidad_nueva<=0) {
        $('#cantidad_nueva').attr('required', 'required');
        document.getElementById("cantidad_nueva").focus();
      } else {
        var codigo_venta_tmp = $('#codigo_venta_tmp').val();
        // alert(codigo_venta_tmp);
        var totalArticulo_previo = precio_articulo*cantidad_anterior;
        var totalArticulo = precio_articulo*cantidad_nueva;
        // alert("totalArticulo_previo = " + totalArticulo_previo);
        // alert("totalArticulo = " + totalArticulo);
        var subtotal=parseFloat(document.getElementById("sub_total").value);
				var isv=parseFloat(document.getElementById("isv").value);
				var total=parseFloat(document.getElementById("total").value);

        // alert("subtotal = " + subtotal + " isv = " + isv + " total = " + total);
				subtotal -= totalArticulo_previo;
				subtotal += totalArticulo;
				isv -= (totalArticulo_previo * 0.15);
				isv += (totalArticulo * 0.15);
				total = (subtotal + isv);
				if (total<=0) {
					total=0;
				}
        // alert("subtotal = " + subtotal + " isv = " + isv + " total = " + total);
        var url = "registro_ventas_cambiar_cantidad.php" ;
        $.post(
          url,
          {
            tmp_codigo: codigo_venta_tmp,
            tmp_subtotal: subtotal,
            tmp_isv: isv,
            tmp_total: total,
            tmp_num_detalle: num_detalle,
            tmp_id_articulo: id_articulo,
            tmp_cantidad_nueva: cantidad_nueva,
            tmp_precio: precio_articulo,
            tmp_total_articulo: totalArticulo
					}, function(data){
            // alert(data);
            console.log(data);
            // return false;
            if (data.trim()=="No existe") {
							// alert(data);
							// redirigir(); 
              return false;
            } else if (data.trim()=="Insuficiente") {
              $('#cantidad_nueva').attr('required','required');
							document.getElementById("cantidad_nueva").focus();
							// alert(data);
              return false;
            } else if (data.trim()=="Guardada") {
              $("#num_detalle").val("").value;
              $("#id_articulo").val("").value;
              $("#descripcion_articulo").val("").value;
              $("#precio_articulo").val("").value;
              $("#cantidad_nueva").val("").value;
              $("#cantidad_anterior").val("").value;
              $('#modal-cantidad').modal('hide');
              // $("#result").html(data);
              actualizarTabla(codigo_venta_tmp);
              // $('#filaDetalles').append(fila);
              $('#sub_total').val(subtotal.toFixed(2));
              $('#isv').val(isv.toFixed(2));
              $('#total').val(total.toFixed(2));
              // alert("La cantidad ha sido modificada");
            }
	        }
	      );
      }
    })

    $("#btnRegistrar").click(function(){
      var detallesTabla = $("#detalles").html();
			if (detallesTabla.trim()=="") {
				$.notify({
          title: "Error : ",
          message: "No ha seleccionado articulos para la venta.",
          icon: 'fa fa-times' 
        },{
          type: "danger"
        });
			} else {
				// alert("Procesando venta...");
				var codigo_venta_tmp = document.getElementById("codigo_venta_tmp").value;

				pasarVentaTmpARealizado(codigo_venta_tmp);	
			}
		});

  });
</script>
</body>
</html>
<?php
  }
?>
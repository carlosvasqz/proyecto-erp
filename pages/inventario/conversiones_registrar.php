<?php
  include ('../../inc/constructor.php');
  include ('../../inc/conexion.php');
  include ('../../inc/util.php');
 include ('../../class/database.php');
$objData = new Database();

if (isset($_GET['opcion'])) {
  $sth1 = $objData->prepare('SELECT * FROM `articulos` WHERE Id_Articulo = :Id_Articulo');
  $sth1->bindParam(':Id_Articulo', $_GET['opcion']);
  $sth1->execute();

  $result1 = $sth1->fetchAll();
}

$sth = $objData->prepare('SELECT * FROM articulos');
$sth->execute();

$result = $sth->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MaterialAdminLTE 2 | Registrar Empleado</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Material Design -->
  <link rel="stylesheet" href="../../dist/css/bootstrap-material-design.min.css">
  <link rel="stylesheet" href="../../dist/css/ripples.min.css">
  <link rel="stylesheet" href="../../dist/css/MaterialAdminLTE.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/all-md-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
  .custom-combobox {
    position: relative;
    display: inline-block;
  }
  .custom-combobox-toggle {
    position: absolute;
    top: 0;
    bottom: 0;
    margin-left: -1px;
    padding: 0;
  }
  .custom-combobox-input {
    margin: 0;
    padding: 5px 10px;
  }
  </style>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- Logo 
<script>
  $( function() {
    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            classes: {
              "ui-tooltip": "ui-state-highlight"
            }
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .attr( "title", "Mostrar Todos los Articulos" )
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .on( "mousedown", function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .on( "click", function() {
            input.trigger( "focus" );
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", value + " Ese Articulo no Existe" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
 
    $( "#Id_Articulo" ).combobox();
    $( "#toggle" ).on( "click", function() {
      $( "#Id_Articulo" ).toggle();
    });
  } );
  </script> -->

  <script>
    function evaluacion(){
var cantidad_inicial=document.getElementById('cantidad_inicial').value;
  var cantidad=document.getElementById('cantidad').value;
  var resultado=document.getElementById('cantidad_final').value;
if (cantidad_inicial=='') {
    var num1=0; 
  }
  if (cantidad_inicial!='') {
    var num1=parseFloat(cantidad_inicial);
  }
if (cantidad=='') {
    var num2=0; 
  }
  if (cantidad!='') {
    var num2=parseFloat(cantidad);
  }

  var resultado=(num1+num2);
     document.frmdatos.cantidad_final.value=resultado;
}


  </script>
</head>
<script type="text/javascript">
  function buscar(){
    //alert("Mensaje de Prueba");
    var opcion= document.getElementById('Id_Articulo').value;
    window.location.href = 'http://localhost/proyecto-erp/pages/inventario/conversiones_registrar.php?opcion='+opcion;
  }
</script>
<body class="skin-blue sidebar-mini fixed">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../../index.php" class="logo">
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
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="../../dist/img/user-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
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
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../../dist/img/user-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Thanh Nguyen</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../../dist/img/user-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  Thanh Nguyen - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
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
          <img src="../../dist/img/user-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Thanh Nguyen</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
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
        menu();
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
        Registrar Conversión
        <small>Inventario</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Inventario</a></li>
        <li class="active">Registrar Conversión</li>
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
           <form  class="form-horizontal">
            <div class="box-body">
              <div class="form-group" id="form_codigo">
                <label for="codigo_conversiones" class="col-sm-2 control-label">Codigo*</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" id="codigo_conversiones" placeholder="Codigo" value="<?php echo nuevoCodigoConversiones(obtenerUltimoCodigoConversiones());?>" readonly>
                </div>
              </div>
              <!-- Date -->
              <div class="form-group" id="form_tipo">
                <label for="codigo_conversiones" class="col-sm-2 control-label">Tipo*</label>

                <div class="col-sm-9">
                  <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios"  id="tipo"  value="1" checked  onkeyup="evaluacion()" >
                      Entradas a Inventario
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="optionsRadios" id="tipo" value="0" onkeyup="evaluacion()">
                      Salidas del Inventario
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
            <h3 class="box-title">Datos de Artículo</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form  name="frmdatos" class="form-horizontal">
            <div class="box-body">
              <div class="form-group" id="form_articulo">
                <label for="Id_Articulo" class="col-sm-2 control-label">Código Artículo*</label>

                <div class="col-sm-9">
                  <select class="form-control" name="Id_Articulo" id="Id_Articulo" onchange="return buscar();">
                    <?php
                    if ($result1) {?>
                   <option value="<?php echo $result1[0]['Id_Articulo'];?>">
                   <?php echo $result1[0]['Id_Articulo'];?>
                  </option>
                   <?php 
                   }?>
                   <option value="">--Buscar Codigo--</option>
                   <?php
                    foreach ($result as $key => $value) {?>
                <option value="<?php echo $value['Id_Articulo'];?>"><?php echo $value['Id_Articulo'];?></option>
                <?php 
              }
              ?>
              </select>
              </div>
              </div>
              <div class="form-group" id="form_descripcion">
              
                <label for="descripcion" class="col-sm-2 control-label">Descripción*</label>
                <?php
              if (isset($result1)) {?>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="descripcion" readonly value="<?php echo $result1[0]['Descripcion']?>" />
                   <?php }else{?>
                    <div class="col-sm-9">
                   <input type="text" class="form-control" id="descripcion" readonly value="" placeholder="Descripcion del Producto ..." />
                   </div>
                   <?php
                    }
                     ?>
                </div>
              </div>

              <div class="form-group" id="form_cantidadi">
              
                <label for="cantidad_inicial" class="col-sm-2 control-label">Cantidad Actual*</label>
                <?php
              if (isset($result1)) {?>

                <div class="col-sm-9">
                  <input type="text" class="form-control" id="cantidad_inicial" name="cantidad_inicial"  readonly value="<?php echo $result1[0]['Existencias']?>" onkeyup="evaluacion()" />
                   <?php }else{?>
                     <div class="col-sm-9">
                   <input type="text" class="form-control"  id="cantidad_inicial" readonly value="" placeholder="Existencia Actual ..." />
                   </div>
                   <?php
                    }
                     ?>
                </div>
                </div>

            <div class="box-body">
              <div class="form-group" id="form_cantidad">
                <label for="cantidad" class="col-sm-2 control-label">Cantidad a Convertir*</label>

                <div class="col-sm-9">
                  <input class="form-control" rows="3" id="cantidad" name="cantidad" onkeyup="evaluacion()" ></input>
                </div>
              </div>

                <div class="form-group" id="form_cantidadf">
                <label for="cantidad_final" class="col-sm-2 control-label">Cantidad Final*</label>

                <div class="col-sm-9">
                  <input class="form-control" rows="4" name="cantidad_final" id="cantidad_final" readonly ></input>
                </div>
              </div>

              
              <div class="form-group" id="form_justificacion">
                <label for="justificacion" class="col-sm-2 control-label">Justicación*</label>

                <div class="col-sm-9">
                  <textarea class="form-control" rows="4" id="justificacion" placeholder="Justifique la Conversión ..."></textarea>
                </div>
              </div>
</div>
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
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Material Design -->
<script src="../../dist/js/material.min.js"></script>
<script src="../../dist/js/ripples.min.js"></script>
<script>
    $.material.init();
</script>
<!-- DataTables -->
<script src="../../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- bootstrap datepicker -->
<script src="../../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap notify -->
<script src="../../plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
<!-- SlimScroll -->
<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- InputMask -->
<script src="../../plugins/input-mask/jquery.inputmask.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>

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
      $(location).attr('href', 'conversiones.php');
    });

    $("#btnRegistrar").click(function(){
      //Obtencion de valores en los inputs
      var codigo_conversiones = $("#codigo_conversiones").val();
      var tipo = $('input[name="optionsRadios"]:checked').val();
      var Id_Articulo = $("#Id_Articulo").val();
      var descripcion = $("#descripcion").val();
      var cantidad_inicial = $("#cantidad_inicial").val();
      var cantidad_final = $("#cantidad_final").val();
      var justificacion = $("#justificacion").val();
      
      // Validaciones
      if (codigo_conversiones=='') {
        $("#codigo_conversiones").attr('required',true);
        document.getElementById("codigo_conversiones").focus();
        $("#form_codigo").removeClass('has-success');
        $("#form_codigo").removeClass('has-error');
        $("#form_codigo").addClass('has-error');
        alertaIngresarDatos();
        return false;
      } else {
        $("#codigo_conversiones").attr('required',false);
        $("#form_codigo").removeClass('has-success');
        $("#form_codigo").removeClass('has-error');
        $("#form_codigo").addClass('has-success');
      }

      if (tipo=='') {
        $("#tipo").attr('required',true);
        document.getElementById("tipo").focus();
        $("#form_tipo").removeClass('has-success');
        $("#form_tipo").removeClass('has-error');
        $("#form_tipo").addClass('has-error');
        alertaIngresarDatos();
        return false;
      } else {
        $("#tipo").attr('required',false);
        $("#form_tipo").removeClass('has-success');
        $("#form_tipo").removeClass('has-error');
        $("#form_tipo").addClass('has-success');
      }

      if (Id_Articulo=='') {
        $("#Id_Articulo").attr('required',true);
        document.getElementById("Id_Articulo").focus();
        $("#form_articulo").removeClass('has-success');
        $("#form_articulo").removeClass('has-error');
        $("#form_articulo").addClass('has-error');
        alertaIngresarDatos();
        return false;
      } else {
        $("#Id_Articulo").attr('required',false);
        $("#form_articulo").removeClass('has-success');
        $("#form_articulo").removeClass('has-error');
        $("#form_articulo").addClass('has-success');
      }

      if (descripcion=='') {
        $("#descripcion").attr('required',true);
        document.getElementById("descripcion").focus();
        $("#form_descripcion").removeClass('has-success');
        $("#form_descripcion").removeClass('has-error');
        $("#form_descripcion").addClass('has-error');
        alertaIngresarDatos();
        return false;
      } else {
        $("#descripcion").attr('required',false);
        $("#form_descripcion").removeClass('has-success');
        $("#form_descripcion").removeClass('has-error');
        $("#form_descripcion").addClass('has-success');
      }

      if (cantidad_inicial=='') {
        $("#cantidad_inicial").attr('required',true);
        document.getElementById("cantidad_inicial").focus();
        $("#form_cantidadi").removeClass('has-success');
        $("#form_cantidadi").removeClass('has-error');
        $("#form_cantidadi").addClass('has-error');
        alertaIngresarDatos();
        return false;
      } else {
        $("#cantidad_inicial").attr('required',false);
        $("#form_cantidadi").removeClass('has-success');
        $("#form_cantidadi").removeClass('has-error');
        $("#form_cantidadi").addClass('has-success');
      }

      if (cantidad_final=='') {
        $("#cantidad_final").attr('required',true);
        document.getElementById("cantidad_final").focus();
        $("#form_cantidadf").removeClass('has-success');
        $("#form_cantidadf").removeClass('has-error');
        $("#form_cantidadf").addClass('has-error');
        alertaIngresarDatos();
        return false;
      } else {
        $("#cantidad_final").attr('required',false);
        $("#form_cantidadf").removeClass('has-success');
        $("#form_cantidadf").removeClass('has-error');
        $("#form_cantidadf").addClass('has-success');
      }

      if (justificacion=='') {
        $("#justificacion").attr('required',true);
        document.getElementById("justificacion").focus();
        $("#form_justificacion").removeClass('has-success');
        $("#form_justificacion").removeClass('has-error');
        $("#form_justificacion").addClass('has-error');
        alertaIngresarDatos();
        return false;
      } else {
        $("#justificacion").attr('required',false);
        $("#form_justificacion").removeClass('has-success');
        $("#form_justificacion").removeClass('has-error');
        $("#form_justificacion").addClass('has-success');
      }
      //Fin validaciones

      // Variable con todos los valores necesarios para la consulta
      var datos = 'codigo_conversiones=' + codigo_conversiones + '&tipo=' + tipo + '&Id_Articulo=' + Id_Articulo + '&cantidad_inicial=' + cantidad_inicial +  '&cantidad_final=' + cantidad_final + '&justificacion=' + justificacion;

     //alert(datos);
      $.ajax({
        //Direccion destino
        url: "conversiones_guardar.php",
        // Variable con los datos necesarios
        data: datos,
        type: "POST",     
        dataType: "html",
        //cache: false,
        //success
        success: function (data) {
          //alert(data);
          if (data) {
            $.notify({
              title: "Correcto : ",
              message: "¡La Transacción se registró exitosamente!",
              icon: 'fa fa-check' 
            },{
              type: "success"
            });
            window.setTimeout('location.href="conversiones.php"', 5);
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
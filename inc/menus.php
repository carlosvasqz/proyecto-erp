<?php
    //session_start();

    function cargarAdmin(){
      $admin = array(
        'empleados' => '',
        'empleados_registrar' => '',
        'empleados_editar' => '',
        'tipos_usuarios' => '',
        'tipos_usuarios_registrar' => '',
        'tipos_usuarios_editar' => '',
        'usuarios' => ''
      );
      return $admin;
    }

    function cargarCompras(){
      $compras = array(
        'cotizaciones_compra' => '',
        'ordenes_compra' => '',
        'proveedores' => '',
        'proveedores_registrar' => '',
        'proveedores_editar' => ''
      );
      return $compras;
    }

    function cargarConf(){
      $conf = array(
        'perfil' => ''
      );
      return $conf;
    }

    function cargarCont(){
      $cont = array(
        'cierres_diarios' => '',
        'reportes' => ''
      );
      return $cont;
    }

    function cargarInv(){
      $inv = array(
        'articulos' => '',
        'categorias' => '',
        'categorias_registrar' => '',
        'categorias_editar' => '',
        'conversiones' => ''
      );
      return $inv;
    }

    function cargarVentas(){
      $ventas = array(
        'clientes' => '',
        'clientes_registrar' => '',
        'clientes_editar' => '',
        'cotizaciones_venta' => '',
        'registrar_cliente' => '',
        'registro_ventas' => ''
      );
      return $ventas;
    }

    function cargarClavesTree(){
      // valor a contener "active "
      $modulos = array(
        // administracion
        'administracion' => '',
        // compras
        'compras' => '',
        // configuraciones
        'configuraciones' => '',
        // contabilidad
        'contabilidad' => '',
        // inventario
        'inventario' => '',
        // ventas
        'ventas' => ''
      );
      return $modulos;
    }
    
    function cargarClavesLi(){
      // valor a contener " class = 'active'"
      $li = array(
        // principal
        'index' => '',
        // administracion
        'empleados' => '',
        'empleados_registrar' => '',
        'empleados_editar' => '',
        'tipos_usuarios' => '',
        'tipos_usuarios_registrar' => '',
        'tipos_usuarios_editar' => '',
        'usuarios' => '',
        // compras
        'cotizaciones_compra' => '',
        'ordenes_compra' => '',
        'proveedores' => '',
        'proveedores_registrar' => '',
        'proveedores_editar' => '',
        'registro_compras' => '',
        // configuraciones
        'perfil' => '',
        // contabilidad
        'cierres_diarios' => '',
        'reportes' => '',
        // inventario
        'articulos' => '',
        'categorias' => '',
        'categorias_registrar' => '',
        'categorias_editar' => '',
        'conversiones' => '',
        'conversiones_registrar' => '',
        // ventas
        'clientes' => '',
        'clientes_registrar' => '',
        'clientes_editar' => '',
        'cotizaciones_venta' => '',
        'registrar_cliente' => '',
        'registro_ventas' => ''
      );
      return $li;
    }

    function menuRoot($cd, $fileName) {
      $modulos = cargarClavesTree();
      $admin = cargarAdmin();
      $compras = cargarCompras();
      $conf = cargarConf();
      $cont = cargarCont();
      $inv = cargarInv();
      $ventas = cargarVentas();
      $li = cargarClavesLi();
      $li[$fileName] = ' class = "active"';
      if (array_key_exists($fileName, $admin)) {
        $modulos['administracion'] = "active ";
      }
      if (array_key_exists($fileName, $compras)) {
        $modulos['compras'] = "active ";
      }
      if (array_key_exists($fileName, $conf)) {
        $modulos['configuraciones'] = "active ";
      }
      if (array_key_exists($fileName, $cont)) {
        $modulos['contabilidad'] = "active ";
      }
      if (array_key_exists($fileName, $inv)) {
        $modulos['inventario'] = "active ";
      }
      if (array_key_exists($fileName, $ventas)) {
        $modulos['ventas'] = "active ";
      }
      echo '
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVEGACION PRINCIPAL</li>
        <li'.$li['index'].'>
          <a href="'.$cd.'index.php">
            <i class="fa fa-dashboard"></i> <span>Panel Principal</span>
          </a>
        </li>
        <li class="'.$modulos['administracion'].'treeview">
          <a href="#">
            <i class="fa fa-suitcase"></i> <span>Administración</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li'.$li['empleados'].'><a href="'.$cd.'pages/administracion/empleados.php"><i class="fa fa-male"></i> Empleados</a></li> 
            <li'.$li['usuarios'].'><a href="'.$cd.'pages/administracion/usuarios.php"><i class="fa fa-users"></i> Usuarios</a></li>
            <li'.$li['tipos_usuarios'].'><a href="'.$cd.'pages/administracion/tipos_usuarios.php"><i class="fa fa-check-circle"></i> Tipos de Usuarios</a></li>
            <!-- <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Nivel Uno
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Nivel Dos</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Nivel Dos
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Nivel Tres</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Nivel Tres</a></li>
                  </ul>
                </li>
              </ul>
            </li> -->
          </ul>
        </li>
        <li class="'.$modulos['compras'].'treeview">
          <a href="#">
            <i class="fa fa-cart-arrow-down"></i> <span>Compras</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li'.$li['registro_compras'].'><a href="'.$cd.'pages/compras/registro_compras.php"><i class="fa fa-clipboard"></i> Registro de Compras</a></li> 
            <li'.$li['proveedores'].'><a href="'.$cd.'pages/compras/proveedores.php"><i class="fa fa-truck"></i> Proveedores</a></li>
            <li'.$li['cotizaciones_compra'].'><a href="'.$cd.'pages/compras/cotizaciones_compra.php"><i class="fa fa-file-text-o"></i> Cotizaciones de Compra</a></li>
            <li'.$li['ordenes_compra'].'><a href="'.$cd.'pages/compras/ordenes_compra.php"><i class="fa fa-file-text"></i> Ordenes de Compra</a></li>
            <!-- <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Nivel Uno
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Nivel Dos</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Nivel Dos
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Nivel Tres</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Nivel Tres</a></li>
                  </ul>
                </li>
              </ul>
            </li> -->
          </ul>
        </li>
        <li class="'.$modulos['ventas'].'treeview">
          <a href="#">
            <i class="fa fa-money"></i> <span>Ventas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li'.$li['registro_ventas'].'><a href="'.$cd.'pages/ventas/registro_ventas.php"><i class="fa fa-cart-plus"></i> Registro de Ventas</a></li> 
            <li'.$li['clientes'].'><a href="'.$cd.'pages/ventas/clientes.php"><i class="fa fa-users"></i> Clientes</a></li>
            <li'.$li['cotizaciones_venta'].'><a href="'.$cd.'pages/ventas/cotizaciones_venta.php"><i class="fa fa-file-text-o"></i> Cotizaciones de Venta</a></li>
            <!-- <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Nivel Uno
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Nivel Dos</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Nivel Dos
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Nivel Tres</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Nivel Tres</a></li>
                  </ul>
                </li>
              </ul>
            </li> -->
          </ul>
        </li>
        <li class="'.$modulos['inventario'].'treeview">
          <a href="#">
            <i class="fa fa-cubes"></i> <span> Inventario</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li'.$li['categorias'].'><a href="'.$cd.'pages/inventario/categorias.php"><i class="fa fa-tags"></i> Categorías</a></li> 
            <li'.$li['articulos'].'><a href="'.$cd.'pages/inventario/articulos.php"><i class="fa fa-cube"></i> Artículos</a></li>
            <li'.$li['conversiones'].'><a href="'.$cd.'/pages/inventario/conversiones.php"><i class="fa fa-random"></i> Conversiones</a></li>
            <!-- <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Nivel Uno
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Nivel Dos</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Nivel Dos
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Nivel Tres</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Nivel Tres</a></li>
                  </ul>
                </li>
              </ul>
            </li> -->
          </ul>
        </li>
        <li class="'.$modulos['contabilidad'].'treeview">
          <a href="#">
            <i class="fa fa-usd"></i> <span> Contabilidad</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li'.$li['cierres_diarios'].'><a href="'.$cd.'pages/contabilidad/cierres_diarios.php"><i class="fa fa-calendar-times-o"></i> Cierres Diarios</a></li> 
            <li'.$li['reportes'].'><a href="'.$cd.'pages/contabilidad/reportes.php"><i class="fa fa-print"></i> Reportes</a></li>
            <!-- <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Nivel Uno
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Nivel Dos</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Nivel Dos
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Nivel Tres</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Nivel Tres</a></li>
                  </ul>
                </li>
              </ul>
            </li> -->
          </ul>
        </li>
        <li class="'.$modulos['configuraciones'].'treeview">
          <a href="#">
            <i class="fa fa-gears"></i> <span> Configuraciones</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li'.$li['perfil'].'><a href="'.$cd.'pages/configuraciones/perfil.php"><i class="fa fa-user"></i> Perfil</a></li> 
            <!-- <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Nivel Uno
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Nivel Dos</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Nivel Dos
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Nivel Tres</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Nivel Tres</a></li>
                  </ul>
                </li>
              </ul>
            </li> -->
          </ul>
        </li>
        <li class="header">ETIQUETAS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Importante</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Advertencia</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Informacion</span></a></li>
      </ul>
      ';
      unset($tree, $admin, $compras, $conf, $cont, $inv, $ventas, $li);
    }
?>
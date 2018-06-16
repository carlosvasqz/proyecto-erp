<?php
    //session_start();
    function menuRoot() {
?>

<ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVEGACION PRINCIPAL</li>
        <li class="active">
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Panel Principal</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Administración</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/administracion/empleados.php"><i class="fa fa-circle-o"></i> Empleados</a></li> 
            <li><a href="pages/administracion/usuarios.php"><i class="fa fa-circle-o"></i> Usuarios</a></li>
            <li><a href="pages/administracion/tipos_usuarios.php"><i class="fa fa-circle-o"></i> Tipos de Usuarios</a></li>
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
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Compras</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/compras/registro_compras.php"><i class="fa fa-circle-o"></i> Registro de Compras</a></li> 
            <li><a href="pages/compras/proveedores.php"><i class="fa fa-circle-o"></i> Proveedores</a></li>
            <li><a href="pages/compras/cotizaciones_compra.php"><i class="fa fa-circle-o"></i> Cotizaciones de Compra</a></li>
            <li><a href="pages/compras/ordenes_compra.php"><i class="fa fa-circle-o"></i> Ordenes de Compra</a></li>
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
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Ventas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/ventas/registro_ventas.php"><i class="fa fa-circle-o"></i> Registro de Ventas</a></li> 
            <li><a href="pages/ventas/clientes.php"><i class="fa fa-circle-o"></i> Clientes</a></li>
            <li><a href="pages/ventas/cotizaciones_venta.php"><i class="fa fa-circle-o"></i> Cotizaciones de Venta</a></li>
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
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Inventario</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/inventario/categorias.php"><i class="fa fa-circle-o"></i> Categorías</a></li> 
            <li><a href="pages/inventario/articulos.php"><i class="fa fa-circle-o"></i> Artículos</a></li>
            <li><a href="pages/inventario/conversiones.php"><i class="fa fa-circle-o"></i> Conversiones</a></li>
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
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span> Contabilidad</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/contabilidad/cierres_diarios.php"><i class="fa fa-circle-o"></i> Cierres Diarios</a></li> 
            <li><a href="pages/contabilidad/reportes.php"><i class="fa fa-circle-o"></i> Reportes</a></li>
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
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span> Configuraciones</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/configuraciones/perfil.php"><i class="fa fa-circle-o"></i> Perfil</a></li> 
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

<?php
    }
?>
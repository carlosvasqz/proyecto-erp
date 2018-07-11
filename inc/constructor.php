<?php
	include ('menus.php');

	$principales = array('index', 'lockscreen');

	function atras($fileName){
		// if(in_array($fileName, $principales)){}
			$cd = null;
		if ($fileName=='index'){
			$cd = '';
		} else {
			$cd = '../../';
		}
		if ($_SERVER['SERVER_NAME'] = 'localhost') {
			$cd = $_SERVER['SERVER_NAME'] . '/proyecto-erp/' . $cd;
		}
		return $cd;
	}

	function menu($tipoUsuario, $fileName)	{
		$cd = atras($fileName);
		switch ($tipoUsuario) {
			case 'Superusuario':
				menuRoot($cd, $fileName);
				break;
			case 'Administracion':
				menuAdmin($cd, $fileName);
				break;
			case 'Compras':
				menuCompras($cd, $fileName);
				break;
			case 'Contabilidad':
				menuCont($cd, $fileName);
				break;
			case 'Inventario':
				menuInv($cd, $fileName);
				break;
			case 'Ventas':
				menuVentas($cd, $fileName);
				break;
			default:
				# code...
				break;
		}
	}

?>
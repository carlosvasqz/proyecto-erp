<?php
	include ('menus.php');

	$principales = array('index', 'lockscreen');

	function atras($fileName){
		// if(in_array($fileName, $principales)){}
		if ($fileName=='index'){
			return '';
		} else {
			return '../../';
		}
	}

	function menu($tipoUsuario, $fileName, $cd)	{
		// $cd = atras($filename);
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
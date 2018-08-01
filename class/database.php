<?php 
class Database extends PDO{

	// public function __construct(){
	// 	try{
	// 		parent::__construct('mysql:host=localhost;dbname=proyecto_erp','root','');
	// 		parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// 	}catch (Exception $ex){
	// 		echo $ex . '<br>';
	// 		die('Error al conectar a la base de datos.');
	// 	}
	// }

	public function __construct() {
		$mysql_db='proyecto_erp';
		$mysql_host='localhost';
		$dsn = 'mysql:dbname=' . $mysql_db . ';host=' . $mysql_host;
		$user = 'root';
		$pw = '';
		try {
			parent::__construct($dsn, $user, $pw);
			$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e) {
			echo '<b>Connection failed:</b> ' . $e->getMessage();;
		}
	}

}
?>
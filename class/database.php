<?php 
class Database extends PDO{

	public function __construct(){
		try{
			parent::__construct('mysql:host=localhost;dbname=proyecto_erp','root','');
			parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch (Exception $ex){
			echo $ex . '<br>';
			die('Error al conectar a la base de datos.');
		}
	}
 }
/* 
public function __construct() {
    $dsn = 'mysql:dbname=' . MYSQL_DB . ';host=' . MYSQL_HOST;
    $user = MYSQL_USER;
    $pw = MYSQL_PW;
    try {
        parent::__construct($dsn, $user, $pw);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();;
    }
}
*/
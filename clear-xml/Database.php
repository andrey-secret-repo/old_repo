<?php 

class Database{
	protected $data;
	public $isConn;
	//конфиги для подключения к базе; подключение к базе
	public function __construct($username = "mysql", $password = "mysql", $host = "127.0.0.1", $dbname = "my_db", $options = []){
		try {
			$this->data = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, $options);
			$this->data->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->data->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			$this->isConn = true;
		} catch (PDOException $e) {
			$this->isConn = false;
		}
	}
	//выбрать все записи
	public function getAllRows(){
		if($this->isConn){
			$stmt = $this->data->prepare("SELECT * FROM user");
			$stmt->execute();
			return $stmt->fetchAll();
		}else{
			die('error');
		}
	}
	//функция добавить
	public function insertRow($params = []){
		if($this->isConn){
			$stmt = $this->data->prepare("INSERT INTO user SET name = ?, surname = ?,  age = ?");
			$stmt->execute($params);
			return TRUE;
		}else{
			die('error');
		}
	}
}
$user = new Database();
?>
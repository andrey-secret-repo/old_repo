<?php 

class Database{
	protected $data;
	//конфиги для подключения к базе; подключение к базе
	public function __construct($username = "id4778906_mysql", $password = "mysql", $host = "localhost", $dbname = "id4778906_my_db", $options = []){
		$this->data = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, $options);
		$this->data->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->data->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	}
	//выбрать все записи
	public function getAllRows(){
		$stmt = $this->data->prepare("SELECT * FROM forxml");
		$stmt->execute();
		return $stmt->fetchAll();
	}
	//функция добавить
	public function insertRow($params = []){
		$stmt = $this->data->prepare("INSERT INTO forxml SET name = ?, surname = ?,  email = ?, language = ?, ip_address = ?");
		$stmt->execute($params);
		return TRUE;
	}
}
$user = new Database();
?>
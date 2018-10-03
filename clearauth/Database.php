<?php 

class Database{
	public $isConn;
	protected $data;
	//конфиги для подключения к базе; подключение к базе
	public function __construct($username = "mysql", $password = "mysql", $host = "127.0.0.1", $dbname = "my_db", $options = []){
		$this->isConn = TRUE;
		$this->data = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, $options);
		$this->data->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->data->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	}
	//Отключение от бд
	public function Disconnect(){
		$this->data = NULL;
		$this->isConn = FALSE;
	}
	//Выбрать одну запись,
	public function getRow($params = []){
		$stmt = $this->data->prepare("SELECT * FROM user WHERE id = ?");
		$stmt->execute($params);
		return $stmt->fetch();
	}
	//выбрать все записи
	public function getAllRows(){
		$stmt = $this->data->prepare("SELECT * FROM user");
		$stmt->execute();
		return $stmt->fetchAll();
	}
	//выбрать несколько записей
	public function getCountRows($count){
		$stmt = $this->data->prepare("SELECT * FROM user LIMIT ?");
		$stmt->bindValue(1, $count, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}
	//функция добавить
	public function insertRow($params = []){
		$stmt = $this->data->prepare("INSERT INTO user SET name = ?, surname = ?, patronymic = ?, age = ?, login = ?, password = ?, address = ?, email = ?, photo = ?");
		$stmt->execute($params);
		return TRUE;
	}
	public function checkUser($params = []){
		$stmt = $this->data->prepare("SELECT COUNT(*) as count FROM user WHERE login = ? AND password = ?");
		$stmt->execute($params);
		$res = $stmt->fetch();
		$rest = $res['count'];
		return ($rest == 1)? true : false;
	}
	public function checkLogin($params = []){
		$stmt = $this->data->prepare("SELECT COUNT(*) as count FROM user WHERE login = ? ");
		$stmt->execute($params);
		$res = $stmt->fetch();
		$rest = $res['count'];
		return ($rest > 0)? true : false;
	}
	public function getUserId($params = []){
		if($this->checkUser($params)){
			$stmt = $this->data->prepare("SELECT id FROM user WHERE login = ? AND password = ?");
			$stmt->execute($params);
			$res = $stmt->fetch();
			return $res['id'];	
		}else{
			return false;
		}
	}
}
$user = new Database();
?>
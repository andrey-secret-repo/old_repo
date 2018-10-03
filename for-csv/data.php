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
}
$user = new Database();
?>
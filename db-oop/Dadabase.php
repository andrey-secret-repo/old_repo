<?php 

class Database{
    public $isConn;
    protected $data;
    // connect to db
    public function __construct($username = "mysql", $password = "mysql", $host = "127.0.0.1", $dbname = "my_db", $options = []){
        $this->isConn = TRUE;
        try {
            $this->data = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, $options);
            $this->data->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->data->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    // disconnect from db
    public function Disconnect(){
        $this->data = NULL;
        $this->isConn = FALSE;
    }
    // get row
    public function getRow($query, $params = []){
        try {
            $stmt = $this->data->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    // get rows
    public function getRows($query, $params = []){
        try {
            $stmt = $this->data->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    // insert row
    public function insertRow($query, $params = []){
        try {
            $stmt = $this->data->prepare($query);
            $stmt->execute($params);
            return TRUE;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    // update row
    public function updateRow($query, $params = []){
        $this->insertRow($query, $params);
    }
    // delete row
    public function deleteRow($query, $params = []){
        $this->insertRow($query, $params);
    }
}

?>
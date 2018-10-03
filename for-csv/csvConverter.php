<?php 
include 'data.php';
class csvConverter extends Database{
	//разбор данных из csv в массив
	public function getArrFromCsv($file){
		$fp = fopen($file, 'r');
		$arr = [];
		while ($line = fgetcsv($fp, filesize($file), ";")) { 
			$arr[] = $line; 
		}
		fclose($fp);
		return $arr;
	}
	//превращение данных из массива в csv
	public function getCsvFromArr($arr, $name){
		$fp = fopen($name.'.csv', 'a+');
		foreach ($arr as $value) {
			fwrite($fp,'"' .implode($value, '";"').'"' . PHP_EOL);
		}
		fclose($fp);
	}
	//запись данных в базу данных
	public function csvToDb($file){
		$fp = fopen($file, 'r');
		while (!feof($fp)) {
			$param = [];
			$str = fgetcsv($fp, filesize($file), ';');
			foreach ($str as $value) {
				$param[] = $value;
			}
			$stm = $this->data->prepare('INSERT INTO user SET login = ?, password = ?, name = ?, surname = ?, patronymic = ?, age = ?, photo = ?, email = ?, address = ?');
			$stm->execute($param);
			print_r($param);
			echo "<hr>";
		}
		fclose($fp);
	}
	//выгрузка данных из бд в csv файл
	public function DbToCsv($filename){
		$fp = fopen($filename.'.csv', 'a+');
		$stmt = $this->data->query('SELECT * FROM user');
		while ($row = $stmt->fetch()) {
			fwrite($fp,'"' .implode($row, '";"').'"' . PHP_EOL);
		}
		fclose($fp);
	}
}
$convert = new csvConverter();
?>
<?php 
include 'Database.php';
class XMLconvert extends Database{
	public function getXmlFile($filename){
		$all = $this->getAllRows();
		$a = new SimpleXMLElement('<users/>');
		foreach ($all as $value) {
			$user = $a->addChild('user');
			foreach ($value as $key => $value) {
				$user->$key = $value;
			}
		}
		if( $a->asXML($filename.".xml")){
			return true;
		}else{
			return false;
		}
	}
	public function insertXml($filename){
		$a = file_get_contents($filename);
		$dom = new DOMDocument();
		$dom->loadXML($a);
		$s = simplexml_import_dom($dom);
		for ($i=0; $i < count($s->user); $i++) {
			$arr = [];
			foreach ($s->user[$i] as $value) {
				$arr[] = $value;
			}
			$this->insertRow($arr);
			unset($arr);
		}
		return true;
	}
}

$convert = new XMLconvert();





?>
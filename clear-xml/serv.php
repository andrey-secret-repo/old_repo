<?php 
include "XMLclass.php";
if(isset($_POST['name']) && !empty($_POST['name'])){
	$name = strip_tags(trim($_POST['name']));
	if($convert->getXmlFile($name)){
		$answer = ['status' => 'ok', 'msg' => $name.'.xml'];
		echo json_encode($answer);
	}else{
		$answer = ['status' => 'error', 'msg' => 'Ошибка'];
		echo json_encode($answer);	
	}
}
if(isset($_POST['insert'])){
	if($convert->insertXml('file.xml')){
		$answer = ['status' => 'ok_insert', 'msg' => 'Данные загружены'];
		echo json_encode($answer);		
	}

}

 ?>
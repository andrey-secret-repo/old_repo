<?php 
if(isset($_FILES['photo']) && isset($_POST)){
	
	$file = $_FILES['photo'];
	$arrFileType = [ 'image/jpeg' =>'.jpg',  'image/png' => '.png' ];
	$destination = $_SERVER['DOCUMENT_ROOT'].'/';
	$newFilename = $destination.md5(microtime().rand());
	$fileType = $file['type'];
	if(array_key_exists($fileType, $arrFileType)){
		$newFilename .= $arrFileType[$fileType];
	}elseif(!empty($file['name'])){
		echo ' Файл недопустимого формата'."<hr>";
	}
	if (!move_uploaded_file($file['tmp_name'], $newFilename)) {
		die('Не удалось осуществить сохранение файла');
	}
}
?>


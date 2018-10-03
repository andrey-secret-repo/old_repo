<?php 
include 'Database.php';
if(isset($_FILES['photo']) && isset($_POST)){
	$file = $_FILES['photo'];
	$arrFileType = [ 'image/jpeg' =>'.jpg',  'image/png' => '.png' ];
	$destination = $_SERVER['DOCUMENT_ROOT'].'/img/';
	$newFilename = $destination.md5(microtime().rand());
	$fileType = $file['type'];
	if(array_key_exists($fileType, $arrFileType)){
		$newFilename .= $arrFileType[$fileType];
	}elseif(!empty($file['name'])){
		die('Файл недопустимого формата'."<hr>");
	}
	$data = array_map('trim', $_POST);
	$data = array_map('strip_tags', $data);
	$name = $data['name'];
	$surname = $data['surname'];
	$patronymic = $data['patronymic'];
	$age = $data['age'];
	$email = $data['email'];
	$login = $data['login'];
	$password = md5($login.$data['password']);
	$address = $data['address'];
	$photo = $newFilename;
	if($user->checkLogin([$login])){
		$user->insertRow([$name, $surname, $patronymic, $age, $login, $password, $address, $email, $photo]);
		echo "Вы успешно зарегестрированы";
	}else{
		echo 'Такой логин уже существует';
	}
	if (!move_uploaded_file($file['tmp_name'], $newFilename)) {
		die('Не удалось осуществить сохранение файла');
	}
}
?>


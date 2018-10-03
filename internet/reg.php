<?php 
include 'Database.php';
if(isset($_FILES['photo']) && isset($_POST)){
	$file = $_FILES['photo'];
	$arrFileType = [ 'image/jpeg' =>'.jpg',  'image/png' => '.png' ];
	$destination = $_SERVER['DOCUMENT_ROOT'].'/for-auth/img/';
	$newFilename = $destination.md5(microtime().rand());
	$fileType = $file['type'];
	if(array_key_exists($fileType, $arrFileType)){
		$newFilename .= $arrFileType[$fileType];
	}elseif(!empty($file['name'])){
		die(' Файл недопустимого формата'."<hr>");
	}

	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$patronymic = $_POST['patronymic'];
	$age = $_POST['age'];
	$email = $_POST['email'];
	$login = $_POST['login'];
	$password = md5($login.$_POST['password']);
	$address = $_POST['address'];
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


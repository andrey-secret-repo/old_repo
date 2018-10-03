<?php 
session_start();
include 'Database.php';
if(isset($_POST['name'])){
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
	if($user->checkLogin([$login])){
		$user->insertRow([$name, $surname, $patronymic, $age, $login, $password, $address, $email]);
		$_SESSION['id'] = $user->getUserId([$login, $password]);
        $answer  = ['status'=> 'ok', 'messsage'=> 'вы зарегестрированы. Войдите в систему'];
        echo json_encode($answer);
	}else{
        $answer  = ['status'=> 'error', 'messsage'=> 'Такой логин уже занят'];
        echo json_encode($answer);
	}
}

if(isset($_FILES['photo'])){
	$file = $_FILES['photo'];
	$arrFileType = [ 'image/jpeg' =>'.jpg',  'image/png' => '.png' ];
	$destination = $_SERVER['DOCUMENT_ROOT'].'/for-auth/img/';
	$newFilename = $destination.md5(microtime().rand());
	$fileType = $file['type'];
	if(array_key_exists($fileType, $arrFileType)){
		$newFilename .= $arrFileType[$fileType];
	}elseif(!empty($file['name'])){
        $answer  = ['status'=> 'error', 'messsage'=> 'Файл недопустимого формата'];
        echo json_encode($answer);
		die();
	}
	if (!move_uploaded_file($file['tmp_name'], $newFilename)) {
        $answer  = ['status'=> 'error', 'messsage'=> 'Не удалось осуществить сохранение файла'];
        echo json_encode($answer);
		die();
	}
    $answer  = ['status'=> 'ok', 'messsage'=> 'Фото загружено'];
    echo json_encode($answer);
	$id = $_SESSION['id'];
	$user->updatePhoto([$newFilename, $id]);
}

?>


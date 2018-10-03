<?php  
session_start();
include 'Database.php';

if(!empty($_POST['login']) && !empty($_POST['password'])){
	$data = array_map('trim', $_POST);
	$data = array_map('strip_tags', $data);

    $login = $data['login'];
    $pass = md5($login.$data['password']);

    if($user->checkUser([$login, $pass])){
        $_SESSION['id'] = $user->getUserId([$login, $pass]);
        $data['password'] = $pass;
        $json = json_encode($data);
        $file = fopen('login-pass.json', 'a+');
        fwrite($file, $json.PHP_EOL);
        fclose($file);
        $answer  = ['status'=> 'ok', 'messsage'=> 'вы авторизированы'];
        echo json_encode($answer);
    }else{
        $answer  = ['status'=> 'error', 'messsage'=> 'неверный пароль или логин'];
        echo json_encode($answer);
    }
}else{
    $answer  = ['status'=> 'error', 'messsage'=> 'Заполните все поля'];
    echo json_encode($answer);
}
?>

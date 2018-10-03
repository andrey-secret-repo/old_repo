<?php  
session_start();
include 'Database.php';
$login = $_POST['login'];
$pass = md5($login.$_POST['password']);
if($user->checkUser([$login, $pass])){
	$_SESSION['id'] = $user->getUserId([$login, $pass]);
	echo true;
}else{
	echo false;
}
?>

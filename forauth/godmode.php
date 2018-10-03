<?php session_start();


 if($_SESSION['id'] == '00'){
 	echo "admin";
 }else{
 	header('Location: index.php');
 }








?>

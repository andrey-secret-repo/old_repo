<?php 
include 'Database.php';
if(isset($_POST['zapr'])){
	$userInfo = $user->getAllRows();
	echo json_encode($userInfo);
}



 ?>
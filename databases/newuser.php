<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php ini_set("display_errors", 1); ?>
	<?php include "Dadabase.php"; ?>
	<?php $db = new Database(); ?>

	<table>
		<form action="" method="POST">
			<tr>
				<th>Name</th>
				<th>surname</th>
				<th>Age</th>
				<th>изменить</th>
			</tr>
			<tr>
				<td><input name="name" type="text"></td>
				<td><input name="surname" type="text"></td>
				<td><input name="age" type="text"></td>
				<td><input name="send" type="submit" value="Добавить"></td>
			</tr>
		</form>
	</table>
	<a href="/">На главную</a>
	
	<?php 
	if(isset($_POST['send'])){
		$data = array_map('trim', $_POST);
		$data = array_map('strip_tags', $data);
		$name = $data['name'];
		$age = $data['age'];
		$surname = $data['surname'];
		$db->insertRow([$name, $age, $surname]);
	}
	?>
	<?php $db->Disconnect() ?>
</body>
</html>

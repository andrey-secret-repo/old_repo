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
	<?php 
	$db = new Database();
	$id = $_GET['id'];
	$getRow = $db->getRow([$id]);
	?>
	<table>
		<form action="" method="POST">
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>surname</th>
				<th>Age</th>
				<th>изменить</th>
			</tr>
			<tr>
				<td><input type="text" value="<?php echo $getRow['id']; ?>"></td>

				<td><input name="name" type="text" value="<?php echo $getRow['name']; ?>"></td>

				<td><input name="surname" type="text" value="<?php echo $getRow['surname']; ?>"></td>

				<td><input name="age" type="text" value="<?php echo $getRow['age']; ?>"></td>

				<td><input name="send" type="submit" value="Изменить"></td>
			</tr>
		</form>
	</table>
	<a href="/">На главную</a>
	<a href="/update.php?id=<?php echo $id?>">Обновить</a>
	<?php 
	if(isset($_POST['send'])){
		$data = array_map('trim', $_POST);
		$data = array_map('strip_tags', $data);
		$newName = $data['name'];
		$newAge = $data['age'];
		$newSurname = $data['surname'];
		$db->updateRow([$newName, $newAge, $newSurname, $id]);
	}
	$db->Disconnect();
	?>
</body>
</html>

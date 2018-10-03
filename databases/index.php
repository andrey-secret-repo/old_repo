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
	if(isset($_GET['limit'])  && is_numeric($_GET['limit'])){
		$count = (int)$_GET['limit'];
		$getRows = $db->getCountRows($count);
	}else{
		$getRows = $db->getAllRows();
	}
	?>
	<form action="" method="GET">
		<span>показать на странице</span>
		<select name="limit" id="">
			<option value="all">Все</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
		</select>
		<input type="submit"  value="показать">
	</form>

	<table>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>surname</th>
			<th>Age</th>
			<th>редактировать</th>
			<th>удалить</th>
		</tr>
		<?php  foreach ($getRows as $value): ?>
			<tr>
				<td><?php echo $value['id']; ?></td>
				<td><?php echo $value['name']; ?></td>
				<td><?php echo $value['surname']; ?></td>
				<td><?php echo $value['age']; ?></td>
				<td><a href="/update.php?id=<?php echo $value['id']?>">Редактировать</a></td>
				<td><a href="/delete.php?id=<?php echo $value['id']?>">Удалить</a></td>
			</tr>
		<?php endforeach; ?>
	</table>
	<?php $db->Disconnect() ?>
	<a href="/newuser.php">Добавить нового пользователя</a>
</body>
</html>
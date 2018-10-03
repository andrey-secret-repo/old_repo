<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<?php
$host = '127.0.0.1';
$db = 'my_db';
$charset = 'utf8';
$user = 'mysql';
$pass = 'mysql';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE =>  PDO::FETCH_ASSOC
];
$pdo = new PDO($dsn, $user, $pass, $opt);
$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM user WHERE id = ?');
$stmt->execute([$id]);
?>




 <table>
 	<form action="">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Age</th>
        <th>surname</th>
        <th>изменить</th>
    </tr>
    <?php  while($row = $stmt->fetch()):?>
     <tr>
     	<td><input type="text" value="<?php echo $row['id']; ?>"></td>
     	<td><input type="text" value="<?php echo $row['name']; ?>"></td>
     	<td><input type="text" value="<?php echo $row['age']; ?>"></td>
     	<td><input type="text" value="<?php echo $row['surname']; ?>"></td>
     	<td><input type="submit" value="Изменить"></td>
     </tr>
 	<?php endwhile; ?>
 	<a href="/db.php">На главную</a>	
 	</form>
	<?php 
	



	 ?>
 </table>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
    <?php ini_set("display_errors", 1); ?> 
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
    $stmt = $pdo->prepare('SELECT * FROM user');
    $stmt->execute();
     ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>surname</th>
            <th>редактировать</th>
            <th>удалить</th>
        </tr>
        <?php  //foreach ($stmt as $value): ?>
        <?php  while($row = $stmt->fetch()):?>
         <tr>
             <td><?php echo $row['id']; ?></td>
             <td><?php echo $row['name']; ?></td>
             <td><?php echo $row['age']; ?></td>
             <td><?php echo $row['surname']; ?></td>
             <td><a href="/update.php?id=<?php echo $row['id']?>">Редактировать</a></td>
             <td><a href="/delete.php?id=<?php echo $row['id']?>">Удалить</a></td>
         </tr>
     <?php endwhile; ?>
    </table>
</body>
</html>
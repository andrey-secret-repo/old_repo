<?php session_start(); ?>
<?php include 'Database.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<?php if(isset($_SESSION['id'])): ?>
		<a href="/">Главная</a>
	<?php else: ?>
		<div class="container">
			<div class="content">
				<form action="reg.php" method="POST" method="POST" enctype="multipart/form-data" target="reg" > 
					<input type="text" required name="name" placeholder="Имя" >
					<input type="text" required name="surname" placeholder="Фамилия" >
					<input type="text" required name="patronymic" placeholder="Отчество" >
					<input type="text" required name="age" placeholder="Возраст" >
					<input type="email" required name="email" placeholder="Email"> 
					<input type="text" required name="login" placeholder="Логин" >
					<input type="password" required name="password" placeholder="Пароль" >
					<input type="text" required name="address" placeholder="Адресс" >
					<label for="photo">Выберети фото</label>
					<input type="file" required name="photo" id="photo">
					<input type="submit" value="Регистрация">
				</form>
				<a href="/">Главная</a>
				<iframe id="reg" required name="reg"></iframe>
			</div>
		</div>
	<?php endif; ?>
</body>
</html>
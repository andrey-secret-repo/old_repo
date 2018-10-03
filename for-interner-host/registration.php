<?php session_start(); ?>
<?php include 'Database.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/style.css">
	<script src="js/jquery.js"></script>
</head>
<body>
	<?php if(isset($_SESSION['id'])): ?>
		<a href="/for-auth/profile.php">Профиль</a>
	<?php else: ?>
		<div class="container">
			<div class="content">
				<form method="POST" class="form" onsubmit="return false"> 
					<input type="text" required name="name" placeholder="Имя" value="Леонид" >
					<input type="text" required name="surname" placeholder="Фамилия" value="Леонидовенко" >
					<input type="text" required name="patronymic" placeholder="Отчество" value="Леонидович" >
					<input type="text" required name="age" placeholder="Возраст" value="96" >
					<input type="email" required name="email" placeholder="Email" value="leon@mail.com"> 
					<input type="text" required name="login" placeholder="Логин" value="login" >
					<input type="password" required name="password" placeholder="Пароль" >
					<input type="text" required name="address" placeholder="Адресс"  value="Адресс ">
					<input type="submit" value="Регистрация">
				</form>
				<a href="/for-auth/">Главная</a>
				<div class="msg"></div>
			</div>
		</div>
	<?php endif; ?>
	<script>
		$(function(){
			$('form').submit(function(){
				var datas = $('.form').serialize();
				$.ajax({
					type: 'POST',
					url: "reg.php",
					data: datas,
					dataType: 'json',
					success: function( result ){
						if(result.status == 'ok'){
							$('.msg').text(result.messsage);
							setTimeout(function () {
								window.location.replace("profile.php");
							}, 700)
						}else{
							$('.msg').text(result.messsage);
						}
					}
				});
			})
		})
	</script>
</body>
</html>
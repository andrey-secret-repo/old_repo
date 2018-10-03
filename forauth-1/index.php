<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="js/jquery.js"></script>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<?php if(!isset($_SESSION['id'])): ?>
		<div class="back">
			<form class="form" method="POST" onsubmit="return false">
				<input type="text" name="login" placeholder="Login" required="">
				<input type="password" name="password" placeholder="Password" required="">
				<input type="submit" value="Войти">
				<div class="msg"></div>
				<a href="registration.php">Регистрация</a>
			</form>	
		</div>
	<?php else:?>
		<a href="profile.php">Ваш профиль</a>
	<?php endif; ?>
	<script>
		$(function(){
			$('.form').submit(function(){
				var datas = $('.form').serialize();
				$.ajax({
					type: 'POST',
					url: "auth.php",
					data: datas,
					dataType: 'json',
					success: function( result ){
						if(result.status == 'ok'){
							$('.msg').text(result.messsage);
							setTimeout(function () {
								window.location.replace("profile.php");
							}, 600)
						}else{
							$('.msg').css("color", "red");
							$('.msg').text(result.messsage);
						}
					}
				});
			})
		})
	</script>
</body>
</html>
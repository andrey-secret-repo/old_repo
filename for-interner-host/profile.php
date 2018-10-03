<?php session_start(); ?>
<?php include 'Database.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/style.css">
	<script src="js/jquery.js"></script>
	<script src="js/active.js"></script>
</head>
<body>
	<?php if(isset($_SESSION['id'])): ?>
		<?php $userInfo = $user->getRow([$_SESSION['id']]); ?>
		<div class="container">
			<div class="head">
				<nav id="menu">
					<ul>
						<li><a href="/for-auth/profile.php">Профиль</a></li>
						<li><a href="/for-auth/users.php">Пользователи</a></li>
						<li><a href="/for-auth/logout.php">Выход</a></li>
					</ul>
				</nav>
			</div>
			<div class="content">
				<div class="photo">
					<?php if($userInfo['photo'] == null): ?>
						<form id="form" method="POST" class="form" enctype="multipart/form-data" onsubmit="return false" >
							<label for="file">Загрузите ваше фото</label>
							<input type="file" id="file" name="photo" required >
							<input type="submit">
							<div class="msg"></div>
						</form>
					<?php else: ?>
						<img src="img/<?php echo basename($userInfo['photo'])?>" alt="">
						<form id="form" method="POST" class="form" enctype="multipart/form-data" onsubmit="return false" >
							<label for="file">Обновить фото</label>
							<input type="file" id="file" name="photo" required >
							<input type="submit">
							<div class="msg"></div>
						</form>
					<?php endif ?>
				</div>
				<div class="bio">
					<div class="fullname">
						<h3><?php echo $userInfo['surname']." ".$userInfo['name']." ".$userInfo['patronymic']?></h3>
					</div>
					<div class="email">
						<h3><?php echo $userInfo['email']?></h3>
					</div>
					<div class="address">
						<h3><?php echo $userInfo['address']?></h3>
					</div>
					<div class="file">
						<a href="login-pass.json" download="">Скачать JSON, в который при каждой удачной авторизации пишется логин и пароль</a>
						<hr>
						<a href="login-pass.json" target="_blank" >Ну или посмотреть в новой вкладке</a>

					</div>
				</div>
			</div>
		</div>
	<?php else: ?>
		<h1>ДОСТУП ЗАКРЫТ</h1>
		<a href="/for-auth/">Главная</a>
	<?php endif; ?>
	<script>
		$(function(){
			$('.form').submit(function(){
			    var formData = new FormData($("#form")[0]);
			    $.ajax({
			    	type: 'POST',
			    	url: "reg.php",
			    	data: formData,
			    	dataType: 'json',
			    	processData: false,
			    	contentType: false,
			    	success: function( result ){
			    		if(result.status == 'ok'){
			    			$('.msg').text(result.messsage);
							location.reload();
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
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
		<?php $userInfo = $user->getAllRows(); ?>
		<div class="container">
			<div class="head">
				<nav id="menu">
					<ul>
						<li><a href="profile.php">Профиль</a></li>
						<li><a href="users.php">Пользователи</a></li>
						<li><a href="logout.php">Выход</a></li>
					</ul>
				</nav>
			</div>
			<div class="content listuser">
				<?php foreach ($userInfo as $value): ?>
					<div class="card">
						<div class="photo">
							<a href="user-id.php/?id=<?php echo $value['id']?>">
								<img src="img/<?php echo basename($value['photo'])?>" alt="">
							</a>
						</div>
						<div class="bio">
							<div class="fullname">
								<h3><?php echo $value['surname']." ".$value['name']." ".$value['patronymic']?></h3>
							</div>
							<div class="email">
								<h3><?php echo $value['email']?></h3>
							</div>
							<div class="address">
								<h3><?php echo $value['address']?></h3>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php else: ?>
		<h1>ДОСТУП ЗАКРЫТ</h1>
		<a href="/">Главная</a>
	<?php endif; ?>
</body>
</html>
<?php session_start(); ?>
<?php include 'Database.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="js/jquery.js"></script>
	<link rel="stylesheet" href="../css/style.css">
	<script src="js/active.js"></script>
</head>
<body>

	<?php if(isset($_SESSION['id']) && !$user->checkId($_GET['id'])): ?>
		<?php $userInfo = $user->getRow([$_GET['id']]); ?>
		<div class="container">
			<div class="head">
				<nav id="menu">
					<ul>
						<li><a href="../profile.php">Профиль</a></li>
						<li><a href="../users.php">Пользователи</a></li>
						<li><a href="../logout.php">Выход</a></li>
					</ul>
				</nav>
			</div>
			<div class="content">
				<div class="photo">
					<img src="../img/<?php echo basename($userInfo['photo'])?>" alt="">
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
				</div>
			</div>
		</div>
	<?php else: ?>
		<h1>ДОСТУП ЗАКРЫТ</h1>
		<a href="/for-auth/">Главная</a>
	<?php endif; ?>
</body>
</html>
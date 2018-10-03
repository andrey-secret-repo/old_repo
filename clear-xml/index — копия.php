<?php include 'Database.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<style>
		table, tr, td, th{
			border-collapse: collapse;
			border: 1px solid;
			padding: 5px;
		}
		table{
			float: left;
		}
		form {
			width: 400px;
			height: 150px;
			border-radius: 25px;
			box-sizing: border-box;
			padding: 20px 25px;
			float: left;
			margin: 50px;
			box-shadow: 0 0 25px -2px #000;
		}
		form h3{
			margin: 0;
		}
		form input[type=text]{
			width: 350px;
			height: 40px;
			outline: none;
			box-sizing: border-box;
			padding: 10px;
			margin: 10px 0;
		}
		.msg a {
			margin: 5px;
		}
	</style>
</head>
<body>
	<?php $all = $user->getAllRows(); ?>
		<table>
			<tr>
				<th>id</th>
				<th>login</th>
				<th>password</th>
				<th>name</th>
				<th>surname</th>
				<th>patronymic</th>
				<th>age</th>
				<th>photo</th>
				<th>email</th>
				<th>address</th>
			</tr>
			<?php foreach ($all as $value):?>
				<tr>
					<td><?php echo $value['id'] ?></td>
					<td><?php echo $value['login'] ?></td>
					<td><?php echo $value['password'] ?></td>
					<td><?php echo $value['name'] ?></td>
					<td><?php echo $value['surname'] ?></td>
					<td><?php echo $value['patronymic'] ?></td>
					<td><?php echo $value['age'] ?></td>
					<td><?php echo $value['photo'] ?></td>
					<td><?php echo $value['email'] ?></td>
					<td><?php echo $value['address'] ?></td>
				</tr>
			<?php endforeach ?>
		</table>
		<form action="" onsubmit="return false">
			<h3>Скачать XML таблицы</h3>
			<input type="text" placeholder="Введите имя сохраняемого файла" name="name">
			<input type="submit" >
		<div class="msg"></div>
		</form>

		<form action="" onsubmit="return false">
			<h3>Загрузить XML в таблицу</h3>
			<h4>файл лежит на сервере</h4>
			<a href="file.xml" target="_blank">посмотреть файл</a>
			<input type="submit" >
			<div class="msg"></div>
		</form>


	<script>
		$(function(){
			$('form').submit(function(){
				var datas = $('form').serialize();
				$.ajax({
					type: 'POST',
					url: "serv.php",
					data: datas,
					dataType: 'json',
					success: function( result ){
						if(result.status == 'ok'){
							$('.msg').html('<a href="'+result.msg+'">Посмотреть</a>');
							$('.msg').append('<a href="'+result.msg+'" download="">Скачать</a>');
						}else{
							$('.msg').css("color", "red");
							$('.msg').text(result.msg);
						}
					}
				});
			})
		})
	</script>
</body>
</html>
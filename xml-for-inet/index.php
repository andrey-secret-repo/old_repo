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
		.msg1 a {
			margin: 5px 10px;
		}
	</style>
</head>
<body>
	<?php $all = $user->getAllRows(); ?>
		<table>
			<tr>
				<th>id</th>
				<th>name</th>
				<th>surname</th>
				<th>email</th>
				<th>language</th>
				<th>ip_address</th>
			</tr>
			<?php foreach ($all as $value):?>
				<tr>
					<td><?php echo $value['id'] ?></td>
					<td><?php echo $value['name'] ?></td>
					<td><?php echo $value['surname'] ?></td>
					<td><?php echo $value['email'] ?></td>
					<td><?php echo $value['language'] ?></td>
					<td><?php echo $value['ip_address'] ?></td>
				</tr>
			<?php endforeach ?>
		</table>
		<form class="form1" onsubmit="return false">
			<h3>Скачать/Просмотреть XML таблицы</h3>
			<input type="text" placeholder="Введите имя сохраняемого файла" name="name">
			<input type="submit" name="download">
		<div class="msg1"></div>
		</form>

		<form class="form2" onsubmit="return false">
			<h3>Загрузить XML в таблицу</h3>
			<h4>файл лежит на сервере</h4>
			<a href="file.xml" target="_blank">посмотреть файл</a>
			<input type="hidden" name="insert" value="1">
			<input type="submit" >
			<div class="msg2"></div>
		</form>


	<script>
		$(function(){
			$('.form1').submit(function(){
				var datas = $('.form1').serialize();
				$.ajax({
					type: 'POST',
					url: "serv.php",
					data: datas,
					dataType: 'json',
					success: function( result ){
						if(result.status == 'ok'){
							$('.msg1').html('<a href="'+result.msg+'" target="_blank">Посмотреть</a>');
							$('.msg1').append('<a href="'+result.msg+'" download="">Скачать</a>');
						}else{
							$('.msg1').css("color", "red");
							$('.msg1').text(result.msg);
						}
					}
				});
			})
		})
		$(function(){
			$('.form2').submit(function(){
				var datas = $('.form2').serialize();
				$.ajax({
					type: 'POST',
					url: "serv.php",
					data: datas,
					dataType: 'json',
					success: function( result ){
						if(result.status == 'ok_insert'){
							$('.msg2').text(result.msg);
							setTimeout(function () {
								location.reload();
							}, 600)
						}else{
							$('.msg2').css("color", "red");
							$('.msg2').text(result.msg);
						}
					}
				});
			})
		})
	</script>
</body>
</html>
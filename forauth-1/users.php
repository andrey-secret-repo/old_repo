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
			<div class="card">
				<div class="bio">
					<div class="email">
					</div>
					<div class="address">
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(function(){
			$.ajax({
				type: 'POST',
				url: "serv2.php",
				data: 'zapr',
				dataType: 'json',
				success: function( result ){
					console.log(result);
					for (i = 0; i < result.length ; i++) {
						$('.content').append(
							'<div class="card">'+
								'<div class="photo">'+ 
									'<img src="'+result[i]['photo']+'" />'+ 
								'</div>'+
								'<div class="bio">'+
									'<div class="fullname">'+
										'<h3>'+result[i]['name'] + ' ' +result[i]['surname'] + ' ' + result[i]['patronymic']+'</h3>'+
									'</div>'+
									'<div class="email">'+
										'<h3>'+ result[i]['email'] + '</h3>'+
									'</div>'+
									'<div class="address">'+
										'<h3>'+ result[i]['address'] + '</h3>'+
									'</div>'+
								'</div>'+
							'</div>'
							)
					}
				}
			});
		})
	</script>
</body>
</html>

<html lang="ru">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	</head>
<body>
	<nav class="navbar navbar-expand-lg ">
		<div class="container-fluid">
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul style="width: 100%" class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active" href="index.html">О нас</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="services.php">Услуги</a>
					</li>
					<li class="nav-item">
						<a class="nav-link " href="enter.php">Подать заявку</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
<?php
	function Enter()
	{
		if(isset($_POST['Entry']))
		{
			session_start();
			$_SESSION['login'] = $_POST['login'];
			include "connection.php";
			$result = mysqli_query($link,"SELECT login, password FROM tb_registration WHERE login = '".$_POST['login']."' AND password = '".$_POST['password']."'");
	
			$row = mysqli_fetch_assoc($result);
			
			if (empty($row) == FALSE) 
			{
				header("Location: indexAutho.html");
			}
			else if(($_SESSION['login'] == 'admin') and ($_SESSION['password'] == 1234))
			{
				header("Location: applications.php");
			}
			else
			{
				return "Введено неверное имя пользователя или пароль";
			}

			///////////////////////////////////
			//header("Location: addInfo.php");
		}
	}
	echo Enter();
	
	
	function Registration()
	{
		if(isset($_POST['Registration']))
		{
			header("Location: registration.php");
		}
	}
	echo Registration();
?>

<form method = 'POST' style="margin-top: 10%; margin-left: 40%">
	<p>Перед подачей заявки необходимо авторизироваться.</p>
	<p>
	   Логин <br><input style="margin-bottom: 10px" type = "text" name = "login" required> <br> 
	   Пароль<br><input type = "password" name = "password" required> <br>
	</p>
	<a class="btn btn-light" href="index.html" style="margin-right: 2rem; border-color: gray">Отмена</a>
	<input class="btn btn-info" type="submit" name="Entry" value="Войти">
	<a class="btn btn-info" href="registration.php">Зарегистрироваться</a>
</form>
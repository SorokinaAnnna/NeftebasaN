
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
	function Registration()
	{

		if(isset($_POST['Registration']))
		{

			include "connection.php";
			$result = mysqli_query($link,"SELECT last_name, name, patronymic_name FROM tb_registration 
																	  WHERE last_name = '".$_POST['last_name']."' 
																	  AND name = '".$_POST['name']."'
																	  AND patronymic_name = '".$_POST['patronymic_name']."'");
			$row = mysqli_fetch_assoc($result);
																	  
			
			if (empty($row) == FALSE) //проверяем введенное ФИО на наличие в БД
			{
				header('HTTP/1.1 400');
				return "Человек с таким ФИО уже существует в нашей системе";
			}
			
			else //добавляем
			{
				$result = mysqli_query($link,"SELECT phone_number FROM tb_registration 
																	  WHERE phone_number = '".$_POST['phone']."'");
				$row = mysqli_fetch_assoc($result);
				if (empty($row) == FALSE) //проверяем введенное ФИО на наличие в БД
				{
					return "Данный номер телефона уже существует в нашей системе";
				}
				else
				{
					$result = mysqli_query($link,"SELECT login FROM tb_registration 
																	  WHERE login = '".$_POST['login']."'");
					$row = mysqli_fetch_assoc($result);
					if (empty($row) == FALSE) //проверяем введенное ФИО на наличие в БД
					{
						return "Такой логин уже занят";
					}
					else
					{
						$result = mysqli_query($link, "INSERT INTO tb_registration(last_name, name, patronymic_name, phone_number, login, password) VALUES ('".$_POST['last_name']."', '".$_POST['name']."', '".$_POST['patronymic_name']."', '".$_POST['phone']."', '".$_POST['login']."', '".$_POST['password']."')");
					}
				
				}
				return "Пользователь добавлен";
			}
			mysqli_close($link);
		}
	}
	echo Registration();
	/*function Enter()
	{
		if(isset($_POST['Entry']))
		{
			session_start();
			$_SESSION['login'] = $_POST['login'];
			$_SESSION['password'] = $_POST['password'];
			if (isset ($_COOKIE[session_name()]))
			{
				session_start();
			}
			//функция реализует удаление куки и сессии
			function DelSession()
			{
				setcookie (session_name(),"",time()-1, "/");
				session_destroy();
			}
			//при нажатии кнопки "Выход" происходит вызов функции, удаляющей куки и сессии
			if(isset($_POST['button']))
			{
				DelSession();
				header("Location: index.php"); //запрашиваем с сервера документ, который нужно показать
			}
			//Если логин и пароль совпадают с логином и паролем администатора, то происходит показ контента для администатора
			if(($_SESSION['login'] == 'customer1') and ($_SESSION['password'] == 1234))
			{
				header("Location: indexAutho.html");
			}
			else echo "Введено неверное имя пользователя или пароль";
				}
	}
	Enter();*/
	
?>

<form method = 'POST' style="margin-top: 10%; margin-left: 40%">
		<table style="margin-bottom: 30px">
			<tr >
				<td>Фамилия </td>
				<td><input style=" margin-left: 10px" type = "text" name = "last_name" id="last_name" required> </td>
			</tr>
			<tr>
				<td>Имя </td>
				<td><input style=" margin-left: 10px" type = "text" name = "name" id="name" required> </td>
			</tr>
			<tr>
				<td>Отчество </td>
				<td><input style=" margin-left: 10px" type = "text" name = "patronymic_name" id="patronymic_name" required></td>
			</tr>
			<tr>
				<td>Номер телефона: +7 </td>
				<td><input style=" margin-left: 10px" type = "number" name = "phone" id="phone" required></td>
			</tr>
			<tr>
				<td>Логин</td>
				<td><input style=" margin-left: 10px" type = "text" name = "login" id="login" required></td>
			</tr>
			<tr >
				<td>Пароль</td>
				<td><input style=" margin-left: 10px" type = "password" name = "password" id="password" required></td>
            </tr>
         </table>
		
	<a class="btn btn-light" href="enter.php" style="margin-right: 2rem; border-color: gray">Отмена</a>
	<input class="btn btn-info" type="submit" name="Registration" value="Зарегистрироваться">
</form>
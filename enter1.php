<?php
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
	
?>
<form method = 'post'>
	<button style="margin-left: 100px" name='button' action="index.php">Выход</button>
<form>
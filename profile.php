<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Личный кабинет</title>
    <link rel="stylesheet" href="styles.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
</head>
<body>

<nav class="navbar navbar-expand-lg ">
		<div class="container-fluid">
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul style="width: 100%" class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active" href="indexAutho.html">О нас</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="services1.php">Услуги</a>
					</li>
					<li class="nav-item">
						<a class="nav-link " href="addInfo.php">Подать заявку</a>
					</li>
					<li style='margin-left: 60%; border: 1px solid #198754; border-radius: 10px; background-color:#198754; padding-left: 2px; padding-right: 2px;' class="nav-item">
						<a style="color:white;" class="nav-link" href="profile.php">Личный кабинет</a>
					</li>
					
					<li style='margin-left: 2rem; border: 1px solid #cfe2ff; border-radius: 10px; background-color: #cfe2ff; padding-left: 2px; padding-right: 2px;' class="nav-item">
						<a style="color:black;" class="nav-link" href="enter.php">Выйти</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
<!--ДОБАВИТЬ ПОЛЕ ЛОГИН В ТАБЛИЦУ С ЗАЯВКАМИ-->
<div  >
    <section class="about-us">
        <h2>Мои заявки</h2>
        <?
			echo PrintData();
		?>
    </section>

    <section class="contact">
        <h2>Контакты</h2>
        <p>Мы находимся по адресу: ул. Примерная, д. 123, г. Образец</p>
        <p>Контактный телефон: +7 (XXX) XXX-XX-XX</p>
        <p>Email: info@neftebaza.ru</p>
        <p>График работы: понедельник - пятница, с 8:00 до 17:00</p>
    </section>
</div>

<footer>
    <p>© 2024 Наша нефтебаза. Все права защищены.</p>
</footer>

</body>
</html>
<?php
//функция для вывода данных с двух таблиц в одну
function PrintData()
	{
		if (isset ($_COOKIE[session_name()]))
				{
					session_start();
				}
		include "connection.php";
		
		$result = mysqli_query($link,"SELECT login_name FROM tb_application WHERE login_name = '".$_SESSION['login']."'");
		$row = mysqli_fetch_assoc($result);
		if(empty($row) == false)
			{		
				$q = "SELECT tb_application.name_AZS, tb_application.INN, tb_application.address_AZS, tb_application.bank,  tb_application.last_name, tb_application.name, tb_application.patronymic_name, tb_application.phone_number, tb_application.job, tb_oil.oil_name, tb_application.number_oil 
												FROM `tb_application` 
												INNER JOIN `tb_oil` 
												ON tb_application.id_oil = tb_oil.id
												WHERE tb_application.login_name = '".$_SESSION['login']."'";
				
				
				$result1 = mysqli_query($link, $q);
				
				echo "<table  align=center class='table table-hover'>";

				echo "<tr class='table-primary text-dark'>";
				echo "<th>Название АЗС</th>
				<th>ИНН</th>
				<th>Адрес АЗС</th>
				<th>Банковские реквизиты</th>
				<th>Фамилия заказчика</th>
				<th>Имя заказчика</th>
				<th>Отчество заказчика</th>
				<th>Номер телефона (+7)</th>
				<th>Должность заказчика</th>
				<th>Выбранное топливо</th>
				<th>Количество заказанного топлива(в литрах)</th>
				<th>Статус заказа</th>";
				echo "</tr>";
				
				while ($line = mysqli_fetch_assoc($result1)) 
				{
					echo "<tr>";
					
					foreach ($line as $key) 
					{
						echo "<td>$key</td>";
					}
					echo "<td style='color: blue' class=\"output\">";
				echo "</td>";
					echo "</tr>";
				}
				
				
				echo "</table>";
				
				mysqli_close($link);
			}
		else
		{
			echo "Вы не отправили ни одной заявки!";
		}
	}
?>
<script>
				const your_Array = [
				  "Заявка принята ",
				  "Заявка на рассмотрении",
				  "Продукты отправлены",
				  "Продукты доставлены",
				  "Продукты приняты",
				];
				const INTERVAL = 5000;  // in milliseconds
				your_Array.forEach((item, index) => {
					setTimeout(() => {
						document.getElementsByClassName("output")[0].innerText = item;
					}, INTERVAL * index);
				});
				</script>
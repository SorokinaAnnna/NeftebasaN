<!--Создать две таблицы в БД: Автор (id, ФИО автора), Книга (id, id_автора, Название книги, Количество страниц, Издательство, год издания). Реализовать сайт из 3-х страниц: главная, Добавление информации, Просмотр сведений. Главная содержит общую информацию (вывод из БД). 
Добавление информации содержит формы для добавления информации об авторах и книгах с сохранением в БД. 
Просмотр сведений содержит таблицу с данными из 2 таблиц с возможностью фильтрации по автору и году издания, сортировка данных по авторам, названию книги, году издания). -->
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
					<li style='margin-left: 90%; border: 1px solid #cfe2ff; border-radius: 10px; background-color: #cfe2ff; padding-left: 2px; padding-right: 2px;' class="nav-item">
						<a style="color:black;" class="nav-link" href="enter.php">Выйти</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
<?php
//функция необходима для вывода информации из БД в виде таблиц
function PrintData()
	{
		include "connection.php"; //устанавливаем подключение к БД
		
		$result = mysqli_query($link, "SELECT tb_application.name_AZS, tb_application.INN, tb_application.address, tb_application.bank_details, tb_application.phone_number, tb_oil.oil_name, tb_application.count_oil 
										FROM `tb_application` 
										INNER JOIN `tb_oil` 
										ON tb_application.id_oil = tb_oil.id"); //формируем запрос к базе данных
										
		echo "<table style='width:90%' align=center class='table table-hover'>";

		echo "<tr class='table-primary text-dark' align=center>";
		echo "<th>Название АЗС</th>
		<th>ИНН</th>
		<th>Адрес АЗС</th>
		<th>Банковские реквизиты</th>
		<th>Номер телефона</th>
		<th>Выбранное топливо</th>
		<th>Количество заказанного топлива(в литрах)</th>";
		echo "</tr>";
		
		while ($line = mysqli_fetch_assoc($result)) //выводим полученные данные, которые преобразовали в ассоциативный массив
		{
			echo "<tr>";
			
			foreach ($line as $key) 
			{
				echo "<td align=center>$key</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
		
		mysqli_close($link);
		
	}
	PrintData(); //вызываем функцию
?>
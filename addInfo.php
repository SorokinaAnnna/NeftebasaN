<!--Создать две таблицы в БД: Автор (id, ФИО автора), Книга (id, id_автора, Название книги, Количество страниц, Издательство, год издания). Реализовать сайт из 3-х страниц: главная, Добавление информации, Просмотр сведений. Главная содержит общую информацию (вывод из БД). 
Добавление информации содержит формы для добавления информации об авторах и книгах с сохранением в БД. 
Просмотр сведений содержит таблицу с данными из 2 таблиц с возможностью фильтрации по автору и году издания, сортировка данных по авторам, названию книги, году издания). -->
<?

	//функция для добавления новой книги
	function NewApplication()
	{
		if (isset($_POST["sender"]))
		{
			include "connection.php";
				if (isset ($_COOKIE[session_name()]))
				{
					session_start();
				}
				$result = mysqli_query($link,"SELECT id FROM tb_oil WHERE id = '".$_POST['oils']."'");
				$row = mysqli_fetch_assoc($result);
				
				if (empty($row) == true) 
				{
					return "Выберите топливо";
				}
				else 
				{
					/*$rrr = mysqli_query($link,"SELECT oil_price FROM tb_oil WHERE id = '".$_POST['oils']."'");
					
					$r = mysqli_fetch_assoc($rrr);
					$pr  = $r['oil_price']*$_POST['countOil'];
					echo $pr;*/
					
					$result = mysqli_query($link,"INSERT INTO `tb_application`(
																id_oil, 
																number_oil,
																name_AZS,
																summa,																
																INN, 
																address_AZS, 
																bank, 
																phone_number, 
																job, 
																last_name, 
																name, 
																patronymic_name,
																login_name) 
													VALUES (
													'".$_POST['oils']."', 
													'".$_POST['number_oil']."',
													'".$_POST['name_AZS']."',
													0,
													'".$_POST['INN']."',
													'".$_POST['address_AZS']."',
													'".$_POST['bank']."',
													'".$_POST['phone_number']."', 
													'".$_POST['job']."', 
													'".$_POST['last_name']."', 
													'".$_POST['name']."', 
													'".$_POST['patronymic_name']."',
													'".$_SESSION['login']."')");
					$text = 'All_application.csv';
					
					$current = file_get_contents($text);
					$current .= "{$_POST['oils']};{$_POST['number_oil']}; {$_POST['name_AZS']};{$_POST['INN']};{$_POST['address_AZS']};{$_POST['bank']}; {$_POST['phone_number']}; {$_POST['job']};{$_POST['last_name']};{$_POST['name']};{$_POST['patronymic_name']}\n";
					file_put_contents($text, $current, FILE_APPEND);							
					return "Заявка отправлена";
					
				}
				/*$file = fopen("appl.txt", "a+");
					fwrite($file, $_POST['AZSName'].$_POST['inn'].$_POST['address'].$_POST['bank_details']); //объединяем строки с помощью точки(в php это так делается)
					fclose($file);
			
			header("Location: profile.php");*/
			mysqli_close($link);
		}
	}
	echo NewApplication();
	/*function Price()
	{
		include "connection.php";
		
			$result = mysqli_query($link,"SELECT * FROM tb_oil WHERE id = '".$_POST['oils']."'");
			$row = mysqli_fetch_assoc($result);
			if (empty($row) == true) 
			{
				return "Выберите топливо";
			}
			else 
			{
				$sum = $row["oil_price"]*$_POST["countOil"];
				
				/*$result = mysqli_query($link,"INSERT INTO tb_application(name_AZS, id_oil, number_oil, summa, INN, address_AZS, bank, phone_number) 
				VALUES ('".$_POST['AZSName']."','".$_POST['oils']."', '".$_POST['countOil']."', '".$_POST['summa']."', '".$_POST['inn']."','".$_POST['address']."','".$_POST['bank_details']."','".$_POST['phone']."')");
				return $sum;

				
			}
	}*/
	/*function Agree()
	{
		if{isset($_POST["sender"]))
		{
			".modal{
				display: block;
			}"
		}
		else if(isset($_POST["cancel"]))
		{
			".modal{
				display: none;
			}"
		}
	}
	Agree();*/
	
?>
<html lang="ru">
	<head>
		<meta charset="UTF-8">
		<title>Заявка на поставку топлива</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <style>
		body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 700px;
            margin: 0 50;
        }
        .form-group {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        label {
            flex: -1;
            margin-right: 20px;
            text-align: right;
        }
        input[type="text"] {
            flex: 8;
            padding: 8px;
            background: transparent;
            border: none;
            border-bottom: 1px solid #000000;
            box-sizing: border-box;
            width: 100%;
        }
		input[type="number"] {
            flex: 8;
            padding: 8px;
            background: transparent;
            border: none;
            border-bottom: 1px solid #000000;
            box-sizing: border-box;
            width: 100%;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: auto;
            display: block;
        }
        .table-container {
            margin-top: 20px;
        }
        table {
            width: 165%;
            border-collapse: collapse;
			margin-bottom: 20px;
        }
        .custom-table {
            width: 60%;
            border-collapse: collapse;
        }
        .custom-table2{
            width: 60%;
            border-collapse: collapse;
            transform: translate(39.5em, -29em);  
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }
        tr {
            text-align: left;
        }
        d {
            width: 100%;
        }
		.modal{
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			width: 300px;
			height: 200px;
			background-color: #fff;
			border: 1px solid #000;
			opacity: 1;
			z-index: 9999;
		}
		
				
		
    </style>
	</head>
<body>
	<nav class="navbar navbar-expand-lg ">
		<div class="container-fluid">
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul style="width: 100%" class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link " href="index.html">О нас</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="services.php">Услуги</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="addInfo.php">Подать заявку</a>
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
	<div class="container">
        <h2>Заявка на поставку топлива</h2>
		<!--<dialog id="myDialog">
				<p>Подтвердить отправку?</p>
				<button class="btn btn-light" type="button" name="cancel" onclick="window.myDialog.close()">Отмена</button>
				<form method="post">
					<button class="btn btn-info" type="submit" name="agree_application" onclick="window.myDialog.close()">Подтвердить</button>
				</form>
			</dialog>-->
        <form method="POST">
			
            <div class="form-group">
                <label for="senderr">Грузоотправитель:</label>
                <input style="color:black; border: 0px; font-weight:bold" type="text" id="senderr" name="senderr" value = "ООО Нефтебаза 'Н'" disabled>
            </div>
            <div class="table-container">
                <table>
                    <tr>
                        <th colspan="8" style="text-align: left;">ТОВАРНЫЙ РАЗДЕЛ </th>
                    </tr>
                <tbody>
                    <tr>
                        <td>Наименование продукции</td>
                        <td>Количество</td>
						<td>Единица измерения</td>
                    </tr>
                    <tr class="second-row">
                        <td>
							<select style= "padding: 10px" name="oils" required>
								<option value="0">Выберите топливо</option> 
									<? 
										include "connection.php";
										$result = mysqli_query($link, "SELECT * FROM tb_oil");
										while($row = mysqli_fetch_assoc($result))
											{
												echo "<option value='".$row['id']."'>".$row['oil_name']." ".$row['oil_price']." - руб/литр </option>";
											}
											mysqli_close($link);
									?>
							</select>
						</td>
                        <td><input type="number" id="number_oil" name="number_oil" ></td>
                        <td>Литры</td>
                        
                    </tr>
                </tbody>
				</table>
			</div>
			<p style="color:blue">*Итоговая сумма заказа появится в окне подтверждения после нажатия кнопки отправки заявки</p>
            <div class="form-group">
                <label for="name_AZS">Название АЗС:</label>
                <input type="text" id="name_AZS" name="name_AZS" pattern="^[А-Яа-яЁё\s]+$" placeholder="Введите название" required>
            </div>
            <div class="form-group">
                <label for="INN">ИНН:</label>
                <input type="number" id="INN" name="INN" placeholder="11111111111" required>
            </div>
            <div class="form-group">
                <label for="address_AZS">Адрес АЗС:</label>
                <input type="text" id="address_AZS" name="address_AZS" placeholder="улица Гагарина 56" required>
            </div>
            <div class="form-group">
                <label for="bank">Банковские реквизиты:</label>
                <input type="number" id="bank" name="bank" placeholder="Введите банковские реквизиты" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Контактный номер телефона:</label>
                <p style="margin:0;">+7</p><input type="number" id="phone_number" name="phone_number" placeholder="9008009090" required>
            </div>
            
			<div class="form-group">
					<label for="job">Должность:</label>
					<input type="text" id="job" name="job" placeholder="Введите должность" required>
			</div>		
			<div class="form-group">		
					<label for="last_name">Фамилия:</label>
					<input type="text" id="last_name" name="last_name" placeholder="Иванов" required>
            </div>
			<div class="form-group">		
					<label for="name">Имя:</label>
					<input type="text" id="name" name="name" placeholder="Иван" required>
            </div>
			<div class="form-group">		
					<label for="patronymic_name">Отчество:</label>
					<input type="text" id="patronymic_name" name="patronymic_name" placeholder="Иванович" required>
            </div>
			<input class="btn btn-info" type="submit" name="sender" style="margin-bottom: 2rem"  value = "Отправить заявку">
        </form>
    </div>
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
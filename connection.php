<?
	$host = "127.0.0.1";
	$username = "root";
	$password = "";
	$dbName = "db_Neftebaze";

	$link = mysqli_connect($host, $username, $password, $dbName);
	mysqli_query($link,'SET NAMES utf8');
?>
<?php
class DBFactory
{
	public static function getMysqlConnexionWithPDO()
	{
		try
		{
			$db = new PDO('mysql:host=localhost;dbname=salmy_db', 'root', '');
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (PDOException $e)
		{
			/*if(!isset($_SESSION['user']))
				session_start();
			$_SESSION['error'] =  "Erreur de connexion à la base de données";
			header('Location: ../error.php');*/
			echo "error";
		}
		
		return $db;
	}

	public static function getMysqlConnexionWithMySQLi()
	{
		try
		{
			return new MySQLi('localhost', 'root', '', 'salmy_db');
		}
		catch (mysqli_sql_exception $e)
		{
			/*if(!isset($_SESSION['user']))
				session_start();
			$_SESSION['error'] =  "Erreur de connexion à la base de données";
			header('Location: ../error.php');*/
			echo 'error';
		}
	}
}
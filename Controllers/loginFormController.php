<?php
require "../Models/autoload.php";
$db = DBFactory::getMysqlConnexionWithPDO();

if(isset($_GET['pseudo']) && isset($_GET['psswd']))
{
	$pseudo = htmlspecialchars($_GET['pseudo']);
	$psswd = htmlspecialchars($_GET['psswd']);

	$clientManager = new clientManager_PDO($db);

	$client = $clientManager->getUnique($pseudo);

	if($client == null)
	{
		echo 'NOT_EXISTS';
	}
	else
	{
		if(sha1($psswd) == $client->psswdClient())
		{
			session_start();
			$_SESSION['client'] = serialize($client);
			echo 'OK';
		}
		else
		{
			echo 'ERROR_PSSWD';
		}
	}
}
?>
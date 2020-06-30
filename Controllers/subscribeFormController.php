<?php
require "../Models/autoload.php";
$db = DBFactory::getMysqlConnexionWithPDO();

if(isset($_GET['nom']) && isset($_GET['motDePass']) && isset($_GET['mdp-conf']))
{
	$nom = htmlspecialchars($_GET['nom']);
	$motDePass = htmlspecialchars($_GET['motDePass']);
	$mdpConf = htmlspecialchars($_GET['mdp-conf']);

	$clientManager = new clientManager_PDO($db);

	$client = new Client(
		[
			'nameClient' => $nom,
			'psswdClient' => sha1($motDePass)
		]
	);

	if($clientManager->getUnique($nom) != null)
	{
		echo 'EXISTS';
	}
	else
	{
		try
		{
			$clientManager->subscribe($client);
			echo "SUBSCRIBED";
		}
		catch (PDOException $e)
		{
			echo "ERROR_SUBSCRIBE";
		}
	}
}
?>
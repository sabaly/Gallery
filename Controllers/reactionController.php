<?php
session_start();

if(!isset($_SESSION['client']))
{	
	echo 'NOT_CONNECTED';
	return false;
}
require "../Models/autoload.php";
$db = DBFactory::getMysqlConnexionWithPDO();

$reactManager = new reactionManager_PDO($db);

if(isset($_GET['type']) && isset($_GET['article']))
{
	$react = new Reaction (
		[
			'idArticle' => $_GET['article'],
			'type' => $_GET['type']
		]
	);

	$client = unserialize($_SESSION['client']);
	$react->setIdClient($client->idClient());

	$reaction = $reactManager->getUnique($_GET['article'], $client->idClient(),  $_GET['type']);

	if($reaction == null)
	{
		try
		{
			$reactManager->react($react);
			echo 'OK';
		}
		catch (PDOException $e)
		{
			echo 'ERROR_REACT';
		}
	}
	else
	{
		try
		{
			$reactManager->unReact($reaction->idReaction());
			echo 'OK';
		}
		catch (PDOException $e)
		{
			echo 'ERROR_UNREACT';
		}
	}
}

if(isset($_POST['article']))
{
	$client = unserialize($_SESSION['client']);

	$reacts = $reactManager->getArticleReacts($_POST['article'], $client->idClient());

	echo json_encode($reacts);
}
?>
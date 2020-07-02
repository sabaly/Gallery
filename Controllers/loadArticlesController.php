<?php
require "../Models/autoload.php";
$db = DBFactory::getMysqlConnexionWithPDO();
$articleManager = new articleManager_PDO($db);

if(isset($_POST['id']))
{
	$articles = $articleManager->listArticlesOfCategorie($_POST['id']);

	echo json_encode($articles);
}

//returns article to show
if(isset($_POST['showArt']))
{
	$article = $articleManager->getUnique($_POST['showArt']);

	echo json_encode($article);
}
?>
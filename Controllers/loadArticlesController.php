<?php
require "../Models/autoload.php";
$db = DBFactory::getMysqlConnexionWithPDO();

if(isset($_POST['id']))
{
	//managers
	//$categorieManager = new categorieManager_PDO($db);
	$articleManager = new articleManager_PDO($db);

	$articles = $articleManager->listArticlesOfCategorie($_POST['id']);

	$data = array();
	foreach ($articles as $article)
	{
		$data[$article->idArticle()] = json_encode($article);
	}

	echo json_encode($data);
}
?>
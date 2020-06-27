<?php

	require "../Models/autoload.php";

	$db = DBFactory::getMysqlConnexionWithPDO();
	$articleManager = new articleManager_PDO($db);

	$articles = $articleManager->listArticlesOfCategorie(3);

	foreach ($articles as $art) {
		var_dump(json_encode($art));
		echo '<br><br>';
	}

?>

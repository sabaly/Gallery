<?php
	require "../Models/autoload.php";
	$db = DBFactory::getMysqlConnexionWithPDO();

	//For categorie form
	if(isset($_POST['nameCategorie']))
	{
		$categorieManager = new categorieManager_PDO($db);

		$categorie = new Categorie
		(
			[
				'nameCategorie' => htmlspecialchars($_POST['nameCategorie'])
			]
		);

		if(isset($_POST['describeCategorie']))
			$categorie->setDescribeCategorie(htmlspecialchars($_POST['describeCategorie']));

		$categorieManager->addCategorie($categorie);

		echo 'OK';
	}

	if(isset($_POST['idCategorie']) && isset($_FILES['image']))
	{
		$articleManager = new articleManager_PDO($db);

		$article = new article
		(
			[
				'idCategorie' => $_POST['idCategorie'],
				'image' => $_FILES['image']['name']
			]
		);

		move_uploaded_file($_FILES['image']['tmp_name'], '../assets/img/'.$_FILES['image']['name']);

		if(isset($_POST['details']))
			$article->setDetails(htmlspecialchars($_POST['details']));

		try
		{
			$articleManager->addArticle($article);
			echo 'OK';
		}
		catch (PDOException $e) 
		{
			echo 'CREATION_ARTICLE_ERROR';
		}
	}

?>
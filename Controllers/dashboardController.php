<?php
	require "../Models/autoload.php";
	$db = DBFactory::getMysqlConnexionWithPDO();
	$categorieManager = new categorieManager_PDO($db);
	
	//For categorie form
	if(isset($_POST['nameCategorie']))
	{
		$categorie = new Categorie
		(
			[
				'nameCategorie' => htmlspecialchars($_POST['nameCategorie'])
			]
		);

		if(isset($_POST['describeCategorie']))
			$categorie->setDescribeCategorie(htmlspecialchars($_POST['describeCategorie']));

		if(isset($_POST['idCategorie']))
			$categorie->setIdCategorie($_POST['idCategorie']);

		if($categorie->isNew())
		{
			$categorieManager->addCategorie($categorie);
			echo 'ADDED';
		}
		else
		{
			
			$categorieManager->updateCategorie($categorie);
			echo "UPDATED";
		}

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

	if(isset($_GET['upd']))
	{
		$categorie = $categorieManager->getUnique($_GET['upd']);

		echo json_encode($categorie);
	}

	if(isset($_GET['del']))
	{
		$categorieManager->deleteCategorie($_GET['del']);
		echo 'DELETED';
	}

?>
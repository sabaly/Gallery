<?php
	require "../Models/autoload.php";
	$db = DBFactory::getMysqlConnexionWithPDO();
	$categorieManager = new categorieManager_PDO($db);
	
	/*
		When categorie form is submit
		- For adding a new categorie
		- Or updating a categorie
	*/
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

	/*
		Wen  articles Form is submit
		- For creating a new article
		- or updating an article 
	*/
	$articleManager = new articleManager_PDO($db);

	if(isset($_POST['idCategorie']))
	{

		$article = new Article
		(
			[
				'idCategorie' => $_POST['idCategorie'],
			]
		);

		if(isset($_FILES['image']) && !empty($_FILES['image']['name']))
		{
			$article->setImage($_FILES['image']['name']);

			move_uploaded_file($_FILES['image']['tmp_name'], '../assets/img/'.$_FILES['image']['name']);
		}
		else if(isset($_POST['idArticle']))
		{
			$article->setIdArticle($_POST['idArticle']);

	
			$article_tmp = $articleManager->getUnique($_POST['idArticle']);

			if(is_bool($article_tmp))
			{
				return false;
			}
			else
			{
				$article->setImage($article_tmp->image());
			}
		}

		

		if(isset($_POST['details']))
			$article->setDetails(htmlspecialchars($_POST['details']));

		try
		{
			if($article->isNew())
			{
				$articleManager->addArticle($article);
				echo 'ADDED';
			}
			else
			{
				$articleManager->updateArticle($article);
				echo 'UPDATED';
			}
		}
		catch (PDOException $e) 
		{
			echo 'SETTING_ARTICLE_ERROR';
		}
	}

	/*
		Return the categorie to update
	*/
	if(isset($_GET['updCat']))
	{
		$categorie = $categorieManager->getUnique($_GET['updCat']);

		echo json_encode($categorie);
	}

	//Delete the categorie
	if(isset($_GET['delCat']))
	{
		
		$categorieManager->deleteCategorie($_GET['delCat']);
		echo 'DELETED';
		
	}


	/*
		Return the article to update
	*/
	if(isset($_POST['updArt']))
	{
		$article = $articleManager->getUnique($_POST['updArt']);

		echo json_encode($article);
	}

	//Delete the categorie
	if(isset($_GET['delArt']))
	{
		$articleManager->deleteArticle($_GET['delArt']);
		echo 'DELETED';
	}

	//returns article to show
	if(isset($_POST['showArt']))
	{
		$article = $articleManager->getUnique($_POST['showArt']);

		echo json_encode($article);
	}

?>
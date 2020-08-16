<?php
/**
 * 
 */

class articleManager_PDO extends articleManager
{
	protected $db;
	
	public function __construct(PDO $db)
	{
		$this->db = $db;
	}

	/**
	* @see articleManager::addArticle()
	*/
	public function addArticle(Article $article)
	{
		$request = $this->db->prepare('INSERT INTO article(idCategorie, image, details, dateAjout, dateModif)
			VALUES (:id, :image, :details, NOW(), NOW());');
		$request->bindValue(':id', $article->idCategorie());
		$request->bindValue(':image', $article->image());
		$request->bindValue(':details', $article->details());

		$request->execute();
	}

	/**
	* @see articleManager::updateArticle()
	*/
	public function updateArticle(Article $article)
	{
		$request = $this->db->prepare('UPDATE article SET idCategorie = :idCat, image = :image, details = :details, dateModif = NOW() WHERE idArticle = :id');
		$request->bindValue(':idCat', $article->idCategorie());
		$request->bindValue(':image', $article->image());
		$request->bindValue(':details', $article->details());
		$request->bindValue(':id', $article->idArticle());

		$request->execute();
	}

	/**
	* @see articleManager::deleteArticle()
	*/
	public function deleteArticle($id)
	{
		$this->db->exec('DELETE FROM article WHERE idArticle = '.(int) $id);
	}

	/**
	* @see articleManager::listArticlesOfCategorie()
	*/
	public function listArticlesOfCategorie($idCategorie)
	{
		$sql = 'SELECT idArticle, idCategorie, image, details, dateAjout, dateModif FROM article WHERE idCategorie ='. (int) $idCategorie;

		$request = $this->db->query($sql);
		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Article');
		$listArticlesOfCategorie = $request->fetchAll();

		
		foreach ($listArticlesOfCategorie as $article)
		{
			$article->setDateAjout(new DateTime($article->dateAjout()));
			$article->setDateModif(new DateTime($article->dateModif()));
		}

		$request->closeCursor();

		return $listArticlesOfCategorie;
	}

	/**
	* @see articleManager::listArticles()
	*/
	public function listArticles($begin = -1, $end = -1)
	{
		$sql = 'SELECT idArticle, idCategorie, image, details, dateAjout, dateModif FROM article';

		//On vérifie l'intégrité des paramètres fournis.
		if ($begin != -1 || $end != -1)
		{
			$sql .= ' LIMIT '.(int) $end.' OFFSET '.(int) $begin;
		}

		$request = $this->db->query($sql);
		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Article');
		$listArticle = $request->fetchAll();

		
		foreach ($listArticle as $article)
		{
			$article->setDateAjout(new DateTime($article->dateAjout()));
			$article->setDateModif(new DateTime($article->dateModif()));
		}

		$request->closeCursor();

		return $listArticle;
	}

	/**
	* @see articleManager::getUnique()
	*/

	public function getUnique($id)
	{
		$sql = 'SELECT idArticle, idCategorie, image, details, dateAjout, dateModif FROM article WHERE idArticle = :id';
		$request = $this->db->prepare($sql);
		$request->bindValue(':id', (int) $id);
		$request->execute();

		$request->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Article');
		$article = $request->fetch();

		
		$article->setDateAjout(new DateTime($article->dateAjout()));
		$article->setDateModif(new DateTime($article->dateModif()));
		
		if(is_bool($article))
			return false;

		$request->closeCursor();

		return $article;
	}
}